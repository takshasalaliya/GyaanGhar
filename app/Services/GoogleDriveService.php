<?php

namespace App\Services;

use Google_Client;
use Google_Service_Drive;

class GoogleDriveService
{
    protected $client;
    protected $driveService;
    protected $rootFolderId = '1c2XEjRnxa9xZ9MsoriSqTXjlMhJvCnk_'; // Get from your Drive URL

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google/credentials.json')); // Path to service account JSON
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $this->client->setAccessType('offline');

        $this->driveService = new Google_Service_Drive($this->client);
    }

    public function createFolder($folderName, $parentId = null)
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentId ?? $this->rootFolderId],
        ]);
    
        $folder = $this->driveService->files->create($fileMetadata, ['fields' => 'id']);
    
        return $folder->id;
    }
    

    public function uploadFile($folderId, $file, $filename)
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $filename,
            'parents' => [$folderId]
        ]);

        $content = file_get_contents($file);

        $uploaded = $this->driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($file->getPathname()),
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);

        return $uploaded->id;
    }

    public function listFilesInFolder($folderId)
    {
        $query = "'$folderId' in parents and trashed = false";
        $response = $this->driveService->files->listFiles([
            'q' => $query,
            'fields' => 'files(id, name, mimeType, createdTime)'
        ]);
        return $response->getFiles();
    }

    public function uploadFileToFolder($folderId, $file)
    {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $file->getClientOriginalName(),
            'parents' => [$folderId]
        ]);

        $content = file_get_contents($file->getRealPath());

        $uploadedFile = $this->driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $file->getMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id'
        ]);

        return $uploadedFile->id;
    }

    // This is the correct deleteFile method, remove any duplicates
    public function deleteFile($fileId)
    {
        try {
            // Attempt to delete the file
            $this->driveService->files->delete($fileId, ['supportsAllDrives' => true]);
            logger("Deleted file: " . $fileId);
        } catch (\Exception $e) {
            logger("Failed to delete file: " . $fileId . " | Error: " . $e->getMessage());
            // Handle error (you can rethrow the error or log it)
        }
    }

    public function deleteFolderWithContents($folderId)
    {
        try {
            // Step 1: List all files in the folder
            $files = $this->listFilesInFolder($folderId);

            // Step 2: Delete each file in the folder
            foreach ($files as $file) {
                $this->deleteFile($file->getId());
            }

            // Step 3: Now that the folder is empty, delete the folder itself
            $this->deleteFile($folderId);

            logger("Folder and contents deleted successfully: " . $folderId);
        } catch (\Exception $e) {
            logger("Failed to delete folder with contents: " . $e->getMessage());
            // Handle or rethrow exception as needed
        }
    }
    public function createSubfolder($parentFolderId, $subfolderName)
{
    try {
        $fileMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $subfolderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$parentFolderId]
        ]);

        $folder = $this->driveService->files->create($fileMetadata, [
            'fields' => 'id, name'
        ]);

        return [
            'id' => $folder->id,
            'name' => $folder->name
        ];
    } catch (\Exception $e) {
        logger("Failed to create subfolder: " . $e->getMessage());
        throw $e;
    }
}

public function deleteFileOrFolder($fileId)
{
    $this->driveService->files->delete($fileId);
}


public function folderName($folderId){
     try {
        $folder = $this->driveService->files->get($folderId, ['fields' => 'name']);
        return $folder->name;
    } catch (\Exception $e) {
        return 'Unknown';
    }
}

}

