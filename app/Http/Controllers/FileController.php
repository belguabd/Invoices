<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function showOrDownload($invoice, $filename, $action)
    {
        $filePath = public_path('Attachments' . DIRECTORY_SEPARATOR . $invoice . DIRECTORY_SEPARATOR . $filename);

        if (file_exists($filePath)) {
            if ($action === 'download') {
                return response()->download($filePath, $filename);
            } else {
                return response()->file($filePath);
            }
        } else {
            abort(404);
        }
    }
}
