<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoice_Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentController extends Controller
{
    /**
     * view file and download
     */
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('pic')) {

            $invoice_id = $request->invoice_id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoice_Attachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
            return redirect()->back()->with('success', 'تم انشاء المرفق بنجاح');

        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Invoice_Attachment $invoice_Attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice_Attachment $invoice_Attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice_Attachment $invoice_Attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice_Attachment $invoice_Attachment)
    {
        $deleted = DB::table('invoice__attachments')->where('id', '=', $invoice_Attachment->id)->delete();
        return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
    }
}
