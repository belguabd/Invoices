<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Hamcrest\Core\Set;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Invoice_detail;
use App\Notifications\AddInvoice;
use App\Models\Invoice_Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Mime\Part\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateInvoiceRequest;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        
        return view('invoices.index', compact('invoices'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoices', compact('sections'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInvoiceRequest $request)
    {
        
        $currentDate = Carbon::now();
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Payment_Date' => $currentDate->format('Y-m-d'),
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        $invoiceId = $invoice->id;
        $invoiceDetail = new Invoice_detail([
            'invoice_id' => $invoiceId, // Associate the detail with the invoice
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'Payment_Date' => $currentDate->format('Y-m-d'),
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);
        $invoiceDetail->save();  // Save the associated 
        if ($request->hasFile('pic')) {
            $invoice_id = Invoice::latest()->first()->id;
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
        }
        $user = Auth::user();
        Notification::send($user, new AddInvoice($invoiceId));
        return redirect()->route("invoices.index")->with('success', 'تم انشاء الفاتورة بنجاح');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $product = Product::findOrFail($invoice->product);
        return view('invoices.status_update', compact('invoice', 'product'));
    }
    public function Status_Update($id, Request $request)
    {

        $invoices = Invoice::findOrFail($id);
        $invoiceId = $invoices->id;
        if ($request->Status === 'مدفوعة') {
            $invoices->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            $invoiceDetail = new Invoice_detail([
                'invoice_id' => $invoiceId, // Associate the detail with the invoice
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => Auth::user()->name,

            ]);
        } else {
            $invoices->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            $invoiceDetail = new Invoice_detail([
                'invoice_id' => $invoiceId, // Associate the detail with the invoice
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'Payment_Date' => $request->Payment_Date,
                'note' => $request->note,
                'user' => Auth::user()->name,

            ]);
        }
        $invoiceDetail->save();
        return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة بنجاح.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrfail($id);
        // return $invoice;
        $prodcut = Product::where('id', $invoice->product)->first();
        $sections = Section::all();
        return view("invoices.update_invoices", compact('invoice', 'sections', 'prodcut'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice = DB::table('invoices')
            ->where('id', $invoice->id)
            ->update([
                'invoice_number' => $request->invoice_number,
                'invoice_Date' => $request->invoice_Date,
                'Due_date' => $request->Due_date,
                'product' => $request->product,
                'section_id' => $request->Section,
                'Amount_collection' => $request->Amount_collection,
                'Amount_Commission' => $request->Amount_Commission,
                'Discount' => $request->Discount,
                'Value_VAT' => $request->Value_VAT,
                'Rate_VAT' => $request->Rate_VAT,
                'Total' => $request->Total,
                'Status' => 'غير مدفوعة',
                'Value_Status' => 2,
                'note' => $request->note,
            ]);
        if ($invoice) {
            return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة بنجاح.');
        } else {
            return redirect()->route('invoices.index')->with('success', 'فشل في تحديث الفاتورة.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice = Invoice::findOrFail($invoice->id);
        $attachments = Invoice_Attachment::where('invoice_id', $invoice->id)->get();
        foreach ($attachments as $attachment) {
            $attachment->forceDelete();
        }
        $invoice->forceDelete();
        if ($invoice) {
            return redirect()->route('invoices.index')->with('deleted_at', 'تم حذف الفاتورة بنجاح.');
        } else {
            return redirect()->route('invoices.index')->with('deleted_at', 'حدث خطأ أثناء حذف الفاتورة.');
        }
    }
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
    public function Invoice_Paid()
    {
        $invoices = Invoice::where('Value_Status', 1)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoice::where('Value_Status', 2)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices = Invoice::where('Value_Status', 3)->get();
        return view('invoices.invoices_Partial', compact('invoices'));
    }
    public function print($invoiceId)
    {
        $invoices = Invoice::where('id', $invoiceId)->first();
        $prodcut = Product::where('id', $invoices->product)->first();

        return view('invoices.print_invoice', compact('invoices', 'prodcut'));
    }
    public function export() 
    {
        
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
}
