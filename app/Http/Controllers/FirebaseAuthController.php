<?php

namespace App\Http\Controllers;
use Revolution\Google\Sheets\Facades\Sheets;
use App\Services\GoogleSheetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as GuzzleClient;
use Kreait\Firebase\Factory;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Database;
use App\Services\GoogleDriveService;
use Google_Client;
use Google_Service_Drive;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;
use Spatie\PdfToText\Pdf;




class FirebaseAuthController extends Controller
{
    //
    protected $auth;
    protected $database;
    protected $googleDriveService;  
    
    public function __construct(GoogleDriveService $googleDriveService)
    {
        $this->googleDriveService = $googleDriveService;

        $path = base_path('storage/firebase/firebase.json');
        if (!file_exists($path)) {
            die("This file path {$path} does not exist");
        }

        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount($path)
            ->withDatabaseUri('https://final-laravel-project-default-rtdb.firebaseio.com/');

        $this->auth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }
    
    public function registerForm(){
        return view('auth.form');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|max:255',
            'Check-Box' => 'required',
        ]);
        try{
            $name=$request->name;
            $email=$request->email;
            $password=$request->password;

            $this->auth->createUser([
                'displayName' => $name,
                'email' => $email,
                'password' => $password,
            ]);
            return redirect()->back()->with('message','User Register Successfully');
        }catch(\Throwable $e){
            return redirect()->back()->with('message', 'Error: ' . $e->getMessage());   
        }
    }
    public function loginForm(){
        return view('auth.login');
    }

        public function login(Request $request){
            $request->validate([
                'email' => 'required|max:255',
                'password' => 'required',
            ]);
            try{
                $email=$request->email;
                $password=$request->password;
                $user = $this->auth->signInWithEmailAndPassword($email,$password);
                if($user){
                    session(['firebase_user' => $user->firebaseUserId()]);
                    return redirect('/dashboard');
                }
            }catch(\Throwable $e){
                return redirect()->back()->with('message', 'Error: ' . $e->getMessage());   
            }
        }

    
    public function logout(Request $request){
        Auth::logout();
        $user = Auth::user();
        if($user && $user->firebase_uid){
            $this->auth->revokeRefreshTokens($user->firebase_uid);
        }
        session()->forget('firebase_user');
        return redirect('/login')->with('message','successfully logout');
    }

    public function createClass(Request $request)
{
    $request->validate([
        'className' => 'required|string|max:255',
    ]);

    try {
        $userId = session('firebase_user');
        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $classCode = $this->generateUniqueClassCode();

        // Create Google Drive folder
        $folderId = $this->googleDriveService->createFolder($classCode);

        // Save class data in Firebase
        $classData = [
            'name' => $request->className,
            'createdAt' => now()->toIso8601String(),
            'createdBy' => $userId,
            'classCode' => $classCode,
            'folderId' => $folderId,
        ];

        $this->database->getReference('classes')->push($classData);

        return redirect()->back()->with('message', 'Class Created Successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}



    public function getClasses()
    {
        try {
            $userId = session('firebase_user');
            if (!$userId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $classes = $this->database
                ->getReference('classes')
                ->orderByChild('createdBy')
                ->equalTo($userId)
                ->getValue();

            // return $classes;
            return view('dashboard',[
                'classes' => $classes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function generateUniqueClassCode()
    {
        $isUnique = false;
        $classCode = '';

        // Keep generating until we find a unique class code
        while (!$isUnique) {
            $classCode = Str::random(6); // Generate a random 6-character alphanumeric code
            $existingClass = $this->database
                ->getReference('classes')
                ->orderByChild('classCode')
                ->equalTo($classCode)
                ->getValue();

            if (empty($existingClass)) {
                // If no class with the same code is found, it's unique
                $isUnique = true;
            }
        }

        return $classCode;
    }

    public function deleteClass($id)
{
    try {
        $DataFolder=$this->database
        ->getReference('classes/' . $id)
        ->getValue();
        if ($DataFolder['folderId']) {
            $this->deleteFile($DataFolder['folderId']);
        }
        
        $this->database->getReference('classes/' . $id)->remove();
        return redirect()->back()->with('success', 'Class deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


public function uploadToFolder(Request $request, $folderId)
{
    $request->validate(['file' => 'required|file']);
    $this->googleDriveService->uploadFileToFolder($folderId, $request->file('file'));
    return redirect()->back()->with('message', 'File uploaded successfully');
}

private function deleteFile($folder)
{
    // dd($fileId);
    $this->googleDriveService->deleteFolderWithContents($folder);
}

public function viewFolder($folderId)
{
    // Fetch files and folders from Google Drive
    $items = $this->googleDriveService->listFilesInFolder($folderId);

    // Separate subfolders from files
    $subfolders = [];
    $files = [];

    foreach ($items as $item) {
        if ($item['mimeType'] === 'application/vnd.google-apps.folder') {
            $subfolders[] = [
                'id' => $item['id'],
                'name' => $item['name']
            ];
        } else {
            $files[] = $item; // You can structure this further if needed
        }
    }

    // Fetch all classes from Firebase
    $allClasses = $this->database->getReference('classes')->getValue();

    // Default class info
    $className = 'Unknown Class';
    $accessCode = 'N/A';

    // Match class using folderId
    foreach ($allClasses as $classId => $classData) {
        if (!empty($classData['folderId']) && $classData['folderId'] === $folderId) {
            $className = $classData['name'] ?? 'Unnamed Class';
            $accessCode = $classData['classCode'] ?? 'N/A';
            break;
        }
    }

    // Return Blade view with all variables
    return view('folder', [
        'files' => $files,
        'subfolders' => $subfolders,
        'folderId' => $folderId,
        'className' => $className,
        'accessCode' => $accessCode,
    ]);
}


public function listFilesInFolder($folderId)
{
    $client = $this->getClient();
    $service = new \Google_Service_Drive($client);

    $query = "'$folderId' in parents and trashed = false";
    $optParams = [
        'q' => $query,
        'fields' => 'files(id, name, mimeType)'
    ];

    $results = $service->files->listFiles($optParams);

    return $results->getFiles();
}



public function upload(Request $request)
{
    if (!$request->hasFile('file')) {
        return response()->json(['success' => false, 'message' => 'No file found.']);
    }
    $request->validate([
       'file' => 'required|max:30720'
       ]);
    $file = $request->file('file');
    $folderId = $request->input('folderId');

    try {
        $fileId = $this->googleDriveService->uploadFileToFolder($folderId, $file);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false]);

    }
}

public function delete(Request $request)
{
    $fileId = $request->input('fileId');
    try {
        $this->googleDriveService->deleteFile($fileId);
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        return response()->json(['success' => false]);

    }
}

public function userdetail(Request $request){
    try {
        $code = $request->folderCode;

        $allClasses = $this->database->getReference('classes')->getValue();
        $className = 'Unknown Class';
        $folderId = null;

        foreach ($allClasses as $classId => $classData) {
            if (!empty($classData['classCode']) && $classData['classCode'] === $code) {
                $className = $classData['name'] ?? 'Unnamed Class';
                $folderId = $classData['folderId'];
                break;
            }
        }

        $files = $this->googleDriveService->listFilesInFolder($folderId);

        $folders = [];
        $documents = [];

        foreach ($files as $file) {
            if ($file->mimeType === 'application/vnd.google-apps.folder') {
                $folders[] = $file;
            } else {
                $documents[] = $file;
            }
        }
        return view('userCode', [
            'folders' => $folders,
            'files' => $documents,
            'code' => $code,
            'className' => $className,
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with('error','Error: Invalid Code');

 }
}




public function showFolderContent($id, $code)
{
    try {
        $allClasses = $this->database->getReference('classes')->getValue();
        $className = 'Unknown Class';

        foreach ($allClasses as $classData) {
            if (!empty($classData['classCode']) && $classData['classCode'] === $code) {
                $className = $classData['name'] ?? 'Unnamed Class';
                break;
            }
        }

        $files = $this->googleDriveService->listFilesInFolder($id);

        $folders = [];
        $documents = [];

        foreach ($files as $file) {
            if ($file->mimeType === 'application/vnd.google-apps.folder') {
                $folders[] = $file;
            } else {
                $documents[] = $file;
            }
        }

        return view('userCode', [
            'folders' => $folders,
            'files' => $documents,
            'code' => $code,
            'className' => $className,
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


public function createSubfolder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'required|string',
    ]);

    try {
        $name = $request->input('name');
        $parentId = $request->input('parent_id');

        $id = app(GoogleDriveService::class)->createFolder($name, $parentId);

        return redirect()->back()->with('success', 'Subfolder created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error creating subfolder: ' . $e->getMessage());
    }
}

public function deleteSubfolder(Request $request)
{
    $request->validate([
        'folderId' => 'required|string',
    ]);

    try {
        $folderId = $request->input('folderId');
        app(GoogleDriveService::class)->deleteFileOrFolder($folderId);

        return redirect()->back()->with('success', 'Subfolder deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error deleting subfolder: ' . $e->getMessage());
    }
}


public function uploadResource(Request $request)
{
    $request->validate([
        'folder_id' => 'required|string',
        'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt,img'
    ]);

    try {
        $parentFolderId = $request->folder_id;

        // Get existing files and folders
        $items = $this->googleDriveService->listFilesInFolder($parentFolderId);

        // Check for existing 'Resource' folder
        $resourceFolderId = null;
        foreach ($items as $item) {
            if (
                $item['mimeType'] === 'application/vnd.google-apps.folder' &&
                $item['name'] === 'Resource'
            ) {
                $resourceFolderId = $item['id'];
                break;
            }
        }

        // Create folder if not found
        if (!$resourceFolderId) {
            $resourceFolderId = $this->createResourceFolder($parentFolderId);
        }

        // Upload file to the Resource folder
        $uploadedFile = $this->googleDriveService->uploadFile(
            $resourceFolderId,
            $request->file,
            $request->file->getClientOriginalName()
        );

        return redirect()->back()->with('success', 'File uploaded to Resource folder successfully.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error uploading file: ' . $e->getMessage());
    }
}


public function createResourceFolder($parentFolderId)
{
    return $this->googleDriveService->createFolder('Resource', $parentFolderId);
}

public function uploadAudio(Request $request) {
    $request->validate([
        'folder_id' => 'required|string',
        'file' => 'required|file|mimes:mp3,wav,m4a|max:40960'  // max 40MB
    ]);

    try {
        $uploadedFile = $this->googleDriveService->uploadFile(
            $request->folder_id,
            $request->file,
            $request->file->getClientOriginalName()
        );

        // Respond with JSON success for AJAX
        return response()->json([
            'success' => true,
            'message' => 'File uploaded to folder successfully.'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error uploading file: ' . $e->getMessage()
        ], 500);
    }
}


public function uploadQuiz(Request $request) {
    $request->validate([
        'folder_id' => 'required|string',
        'file' => 'required|file|mimes:json,csv,xlsx'
    ]);
    // Upload logic
}


public function show($fidclass,$folderId)
{
    // Fetch files from Google Drive
    $files = $this->googleDriveService->listFilesInFolder($folderId);

    // Fetch all classes from Firebase
    $allClasses = $this->database->getReference('classes')->getValue();

    // Default class name
    $className = app(GoogleDriveService::class)->folderName($folderId);;

    $sheetId = '1O8q4P1gZtCfin2izOdT2AqDvDiuK72VS0-Zq4q0JSHE';
    $sheetName = 'Sheet1';
    $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet={$sheetName}";

    $csv = Http::get($url)->body();
    $lines = array_map('str_getcsv', explode("\n", $csv));
    $headers = array_shift($lines);
    $questions = [];
    foreach ($lines as $line) {
        if (count($line) < 8) continue;
        list($userId, $fid, $q, $a, $b, $c, $d, $ans) = $line;
        if ($fid == $folderId) {
            $questions[] = [
                'question' => $q,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'answer' => $ans,
            ];
        }
    }


    // Return view with data
    return view('subfolderdetail', [
        'questions' => $questions,
        'files' => $files,
        'folderId' => $folderId,
        'className' => $className,
        'fidclass' => $fidclass,
    ]);
}


public function showResources($folderId)
{
    // Directly fetch files from the given Resource folder
    $files = $this->googleDriveService->listFilesInFolder($folderId);

    return view('resourcedetail', [
        'files' => $files,
        'folderId' => $folderId,
    ]);
}


public function deleteFiles(Request $request)
{
    $fileId = $request->file_id;
    try {
        $this->googleDriveService->deleteFile($fileId);
        return redirect()->back()->with('success', 'File Delete successfully.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error:'.$e->getMessage());

    }
}

public function uploadQuizManual(Request $request, GoogleSheetService $sheetService)
{
    $questions = $request->questions; // array of quiz questions

    $userId = session('firebase_user'); // or your user UID
    $folderId = $request->folder_id;

    foreach ($questions as $q) {
        $row = [
            $userId,
            $folderId,
            $q['question'],
            $q['a'],
            $q['b'],
            $q['c'],
            $q['d'],
            $q['answer'],
        ];

        $sheetService->appendRow($row);
    }

    return back()->with('success', 'Quiz submitted and saved to Google Sheet!');
}


public function showquiz(Request $request)
{
    
    $folderids=explode('/',$request->folderid);
    $folderId= $folderids[4];
    // Load questions from Google Sheet (via Sheet1 as CSV or API)
    $sheetId = '1O8q4P1gZtCfin2izOdT2AqDvDiuK72VS0-Zq4q0JSHE';
    $sheetName = 'Sheet1';
    $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet={$sheetName}";
    $csv = Http::get($url)->body();
    $lines = array_map('str_getcsv', explode("\n", $csv));
    $headers = array_shift($lines);
    $questions = [];
    foreach ($lines as $line) {
        if (count($line) < 8) continue;
        list($userId, $fid, $q, $a, $b, $c, $d, $ans) = $line;
        if ($fid == $folderId) {
            $questions[] = [
                'question' => $q,
                'a' => $a,
                'b' => $b,
                'c' => $c,
                'd' => $d,
                'answer' => $ans,
            ];
        }
    }
    return view('quiz', [
        'folderId' => $folderId,
        'questions' => $questions,
    ]);
}

public function submit(Request $request ,GoogleSheetService $sheetService)
{
    $name = $request->name;
    $roll = $request->roll;
    $folderId = $request->folderId;
    $ip = $request->ip();
    $answers = $request->answers;
    $correct = $request->correct_answers;
    $score = 0;
    foreach ($answers as $key => $ans) {
        if ($ans == $correct[$key]) {
            $score++;
        }
    }
    $result = "$score/" . count($correct);
    // GOOGLE SHEET - Read Existing Data
    $sheetId = '1O8q4P1gZtCfin2izOdT2AqDvDiuK72VS0-Zq4q0JSHE';
    $sheetName = 'Sheet2';
    $csvUrl = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet={$sheetName}";
    $csvData = Http::get($csvUrl)->body();
    $lines = array_map('str_getcsv', explode("\n", $csvData));
    $headers = array_shift($lines);

    foreach ($lines as $line) {
        if (count($line) < 5) continue;
        if ($line[0] === $folderId && $line[1] === $roll || $line[0] === $folderId && $line[4] === $ip) {
            return back()->withErrors(['error' => 'This Roll Number Or Devices is used already. <br> Please Try from another Device.']);
        }
    }

    $data = [
        $folderId,    // A
        $roll,        // B
        $name,        // C
        $result,      // D
        $ip           // E
    ];  
    
    
    $sheetService->appendRow2($data);
    
    
    return redirect()->back()->with('success', "Quiz submitted successfully! <br> Your Score: {$result}");
 
}
public function score($folderId){
    $sheetId = '1O8q4P1gZtCfin2izOdT2AqDvDiuK72VS0-Zq4q0JSHE';
    $sheetName = 'Sheet2';
    $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet={$sheetName}";

    $csv = Http::get($url)->body();
    $lines = array_map('str_getcsv', explode("\n", $csv));
    $headers = array_shift($lines);
    $users = [];
    foreach ($lines as $line) {
        if (count($line) < 5) continue;
        list($fid, $roll, $name, $result,$ip) = $line;
        if ($fid == $folderId) {
            $users[] = [
                'roll' => $roll,
                'name' => $name,
                'result' => $result,
                'ip' => $ip,
            ];
        }
    }
    return view('quizscore',[
        'users' => $users,
    ]);
}


public function contant(Request $request,GoogleSheetService $sheetService){
    $data = [
       $request->name,
       $request->email,
       $request->message,
    ];  
    $sheetService->appendRow3($data);
    
    
    return redirect()->back()->with('success', "Message Will Send Successfully");
}


    public function stream($fileId, Request $request)
    {
        try {
            $googleClient = new Google_Client();
            $googleClient->setAuthConfig(storage_path('app/google/credentials.json'));
            $googleClient->addScope(Google_Service_Drive::DRIVE_READONLY);
            // It's good practice to manage token persistence if you're dealing with user-specific drives
            // For service accounts, setAuthConfig is usually enough.

            $drive = new Google_Service_Drive($googleClient);

            // Get file metadata (including size)
            $fileMeta = $drive->files->get($fileId, ['fields' => 'id, name, mimeType, size, webContentLink, exportLinks']);
            $fileName = $fileMeta->name;
            $mimeType = $fileMeta->mimeType;
            $fileSize = (int)$fileMeta->size; // Ensure size is an integer

            // Determine the actual download URL
            // For native Google Drive files, webContentLink is often the direct download link.
            // For Google Docs/Sheets/Slides, you need to use exportLinks.
            $downloadUrl = null;
            if (strpos($mimeType, 'google-apps') !== false) {
                // Example for exporting Google Docs as PDF, adjust as needed
                if (isset($fileMeta->exportLinks[$mimeType])) { // Prefer direct export if mime matches
                     $downloadUrl = $fileMeta->exportLinks[$mimeType];
                } elseif ($mimeType === 'application/vnd.google-apps.document') {
                    $downloadUrl = $fileMeta->exportLinks['application/pdf'] ?? null; // Fallback to PDF for docs
                    $mimeType = 'application/pdf'; // Adjust mime type if exporting to a different format
                } // Add more conditions for other Google Apps types if needed
            } else {
                // For regular files like audio, video, images, non-Google Docs PDFs
                $downloadUrl = "https://www.googleapis.com/drive/v3/files/{$fileId}?alt=media";
            }

            if (!$downloadUrl) {
                Log::error("Could not determine download URL for file ID: {$fileId} with mimeType: {$mimeType}");
                return response("Error: Could not determine download URL for the file.", 500);
            }


            // Get the authorized Guzzle HTTP client from the Google Client
            // This client will have the necessary authentication headers
            $authedHttpClient = $googleClient->authorize();

            $rangeHeader = $request->header('Range');
            $start = 0;
            $end = $fileSize - 1;
            $isPartial = false;

            if ($rangeHeader) {
                if (preg_match('/bytes=(\d+)-(\d*)/', $rangeHeader, $matches)) {
                    $start = (int)$matches[1];
                    if (!empty($matches[2])) {
                        $end = (int)$matches[2];
                    }
                    $isPartial = true;
                }
            }

            // Adjust end if it's out of bounds or for "bytes=start-"
            if ($end >= $fileSize) {
                $end = $fileSize - 1;
            }

            $length = $end - $start + 1;

            if ($isPartial && ($start > $end || $start >= $fileSize || $length <=0)) {
                 // Invalid range requested
                return response('Range Not Satisfiable', 416, [
                    'Content-Range' => "bytes */{$fileSize}"
                ]);
            }

            $guzzleRequestOptions = [
                'headers' => [],
                'stream' => true // Important for getting a streamable body
            ];

            if ($isPartial) {
                $guzzleRequestOptions['headers']['Range'] = "bytes={$start}-{$end}";
            }

            // Make the request to Google Drive using the authorized Guzzle client
            $guzzleResponse = $authedHttpClient->request('GET', $downloadUrl, $guzzleRequestOptions);
            $body = $guzzleResponse->getBody(); // This is a Guzzle StreamInterface

            $responseStatus = $isPartial ? 206 : 200;
            
            $responseHeaders = [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . addslashes($fileName) . '"',
                'Accept-Ranges' => 'bytes',
                'Cache-Control' => 'public, max-age=600', // Cache for 10 minutes
                'Last-Modified' => gmdate('D, d M Y H:i:s', time()) . ' GMT', // Use actual file modification time if available
            ];

            if ($isPartial) {
                $responseHeaders['Content-Length'] = $length;
                $responseHeaders['Content-Range'] = "bytes {$start}-{$end}/{$fileSize}";
            } else {
                $responseHeaders['Content-Length'] = $fileSize;
            }
            
            // For some specific mime types that might cause issues with inline disposition
            // e.g., forcing download for unknown types or specific executables
            if ($mimeType === 'application/octet-stream' || strpos($fileName, '.exe') !== false) {
                $responseHeaders['Content-Disposition'] = 'attachment; filename="' . addslashes($fileName) . '"';
            }


            return new StreamedResponse(function () use ($body) {
                // Set time limit to 0 to prevent script timeout during streaming
                set_time_limit(0);
                
                // Read the stream in chunks
                // For Guzzle streams, $body->read() is the way.
                // $body->eof() checks if the end of the stream is reached.
                while (!$body->eof() && connection_status() === CONNECTION_NORMAL) {
                    echo $body->read(1024 * 1024); // Read 1MB chunks
                    flush();
                }
                if ($body->isReadable() && method_exists($body, 'close')) {
                     $body->close();
                }
            }, $responseStatus, $responseHeaders);

        } catch (\Google\Service\Exception $e) {
            Log::error('Google API Error during streaming: ' . $e->getMessage(), ['errors' => $e->getErrors()]);
            $errorMessages = array_map(function($error) { return $error['message']; }, $e->getErrors());
            return response("Google API Error: " . implode(', ', $errorMessages) . " (File ID: {$fileId})", $e->getCode() >= 400 && $e->getCode() < 500 ? $e->getCode() : 500);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error('Guzzle HTTP Error during streaming: ' . $e->getMessage());
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            return response("Network Error fetching file: " . $e->getMessage(), $statusCode);
        } catch (\Exception $e) {
            Log::error('Generic Streaming error: ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
            return response("Error streaming file: " . $e->getMessage(), 500);
        }
    }


    public function review(Request $request,GoogleSheetService $sheetService){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'star' => 'required',
            'message' => 'required',
            'role' => 'required',
        ]);

      try{
        $data = [
            $request->name,    // A
            $request->email,        // B
            $request->star,        // C
            $request->message,      // D
            $request->role,         // E
        ];  
        
        
        $sheetService->appendRow4($data);
        return back()->with('success','Successfully review submitted');
      }  catch(\Throwable $e){
         return redirect()->back()->with('message', 'Error: ' . $e->getMessage());   
     }
}
public function welcome()
{
    $sheetId   = '1O8q4P1gZtCfin2izOdT2AqDvDiuK72VS0-Zq4q0JSHE';
    $sheetName = 'Sheet4';

    // Google Sheets CSV export URL
    $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:csv&sheet={$sheetName}";

    // Fetch and parse CSV
    $csv   = Http::get($url)->body();
    $lines = array_map('str_getcsv', explode("\n", trim($csv)));
    $headers = array_shift($lines);

    $reviews = [];
    foreach ($lines as $line) {
        if (count($line) < 5) {
            continue; // skip incomplete rows
        }

        // assuming columns are: name,email,star,review,type
        list($name, $email, $star, $reviewText, $role) = $line;

        if (empty($name) || empty($reviewText)) {
            continue; // skip blanks
        }

        $reviews[] = [
            'name'    => $name,
            'email'   => $email,
            'star'    => (int) $star,
            'message' => $reviewText,
            'role'    => $role,
        ];
    }

    // shuffle and take first 3
    shuffle($reviews);
    $randomThree = array_slice($reviews, 0, min(3, count($reviews)));

    return view('index', [
        'reviews' => $randomThree,
    ]);
}



public function textai(Request $request,GoogleSheetService $sheetService)
{
    $request->validate([
        'ai_text' => 'required',
    ]);
    // return ;
    $text = $request->ai_text;
    try {
        $folderId=$request->folder_id;
        $userId = session('firebase_user');
        $decoded = json_decode($text, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $quiz = [];
    
            foreach ($decoded as $index => $item) {
                if (
                    isset($item['question_text'], $item['options'], $item['correct_answer']) &&
                    is_array($item['options'])
                ) {
                    // Map options to a–d
                    $optionLetters = ['a', 'b', 'c', 'd'];
                    $optionsAssoc = [];
                    foreach ($item['options'] as $i => $opt) {
                        $optionsAssoc[$optionLetters[$i]] = $opt;
                    }
    
                    // Find correct answer letter
                    $correctLetter = array_search($item['correct_answer'], $optionsAssoc);
            
                    // $sheetService->appendRow($row);
                    $quiz = [
                        $userId,
                        $folderId,
                        'question' => $item['question_text'],
                        'options' => $optionsAssoc,
                        'correct_answer' => $correctLetter, // a, b, c, or d
                    ];
                    $quiz = [
                        $userId,
                        $folderId,
                        $item['question_text'],
                        $item['options'][0],
                        $item['options'][1],
                        $item['options'][2],
                        $item['options'][3],
                        $correctLetter
                    ];
                    
                        

                    $sheetService->appendRow($quiz);
                    
                }
            }
        } else {
            return redirect()->back()->with('error', 'Error: INvalid Format Chaeck Instruction and Prompt');
        }
    } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
    
   return redirect()->back()->with('success', 'Quiz Uploaded Successfully!');
}


}
