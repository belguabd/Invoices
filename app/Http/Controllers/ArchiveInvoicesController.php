<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class ArchiveInvoicesController extends Controller
{
    public function show()
    {
        $archive_invoices = Invoice::onlyTrashed()->get();
        return view('invoices.archive_invoices', compact('archive_invoices'));
    }
    public function archive($invoiceId)
    {
        $invoice = Invoice::where('id', $invoiceId)->first();
        $invoice->delete();
        return redirect()->back()->with('archive_invoice', 'تم نقل الفاتورة إلى الأرشيف بنجاح.');
    }
    public function restore($id)
    {
        $archivedInvoice = Invoice::onlyTrashed()->findOrFail($id);
        $archivedInvoice->restore();
        return redirect()->route('invoices.index')->with('restore_invoice', 'تم استعادة الفاتورة من الأرشيف بنجاح.');
    }
}
