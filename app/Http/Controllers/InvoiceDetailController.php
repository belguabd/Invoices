<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoice_detail;
use App\Models\Invoice_Attachment;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoiceDetailController extends Controller
{
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
    }

    /**
     * Display the specified resource.
     */
    public function show($invoiceId)
    {
        
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice_detail = Invoice_detail::where('invoice_id', $invoiceId)->get();
        $invoice_Attachments = Invoice_Attachment::where('invoice_id', $invoiceId)->get();
        $product = Product::findOrFail($invoice->product);
        // return $invoice_Attachment;
        return view("invoices.details_invoice", compact('invoice', 'invoice_detail', 'invoice_Attachments','product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice_detail $invoice_detail)
    {
      
    }
}
