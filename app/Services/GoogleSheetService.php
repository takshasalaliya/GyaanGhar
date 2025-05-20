<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetService
{
    protected $spreadsheetId;
    protected $sheetName;
    protected $sheetsService;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/' . env('GOOGLE_SHEETS_CREDENTIALS')));
        $client->addScope(Sheets::SPREADSHEETS);
        $client->setAccessType('offline');

        $this->sheetsService = new Sheets($client);
        $this->spreadsheetId = env('GOOGLE_SHEET_ID'); // set this in .env
        $this->sheetName = env('GOOGLE_SHEET_TAB', 'Sheet1');
    }

    public function appendRow(array $data, $sheetName = null)
    {
        // Use Sheet2 if no sheet name is passed
        $sheetName = $sheetName ?: $this->sheetName; 
    
        $range = $sheetName;
        $body = new Sheets\ValueRange(['values' => [$data]]);
        $params = ['valueInputOption' => 'RAW'];
    
        return $this->sheetsService->spreadsheets_values->append(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }


    public function appendRow2(array $data)
{
    $sheetName = 'Sheet2';  // Always use Sheet2

    $range = $sheetName;
    $body = new Sheets\ValueRange(['values' => [$data]]);
    $params = ['valueInputOption' => 'RAW'];

    return $this->sheetsService->spreadsheets_values->append(
        $this->spreadsheetId,
        $range,
        $body,
        $params
    );
}

public function appendRow3(array $data)
{
    $sheetName = 'Sheet3';  // Always use Sheet2

    $range = $sheetName;
    $body = new Sheets\ValueRange(['values' => [$data]]);
    $params = ['valueInputOption' => 'RAW'];

    return $this->sheetsService->spreadsheets_values->append(
        $this->spreadsheetId,
        $range,
        $body,
        $params
    );
}

public function appendRow4(array $data)
{
    $sheetName = 'Sheet4';  // Always use Sheet4

    $range = $sheetName;
    $body = new Sheets\ValueRange(['values' => [$data]]);
    $params = ['valueInputOption' => 'RAW'];

    return $this->sheetsService->spreadsheets_values->append(
        $this->spreadsheetId,
        $range,
        $body,
        $params
    );
}
    
}
