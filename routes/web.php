<?php

use App\Mail\helloMail;
use App\Models\Invoice_detail;
use App\Models\Invoice_Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\ArchiveInvoicesController;
use App\Http\Controllers\InvoiceAttachmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');
// Route::middleware('auth')->group(function () {
//     Route::get('/home', function () {
//         return view('home');
//     })->name('home');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
require __DIR__ . '/auth.php';
// Route::resource('sections', SectionController::class);

// Route::resource('products', ProductController::class);
// Route::resource('details_invoice', InvoiceDetailController::class);
// Route::resource('invoice_Attachment', InvoiceAttachmentController::class);
// Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
// Route::get('payments/invoices', [InvoiceController::class, 'Invoice_Paid']);
// Route::get('/files/{invoice}/{filename}/{action}', [InvoiceAttachmentController::class, 'showOrDownload'])->name('files.action');
// Route::get('/Status_show/{id}', [InvoiceController::class, 'show'])->name('Status_show');
// Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');

// Route::get('Invoice_UnPaid', [InvoiceController::class, 'Invoice_UnPaid']);
// Route::get('Invoice_Partial', [InvoiceController::class, 'Invoice_Partial']);
// Route::get('invoices/{id}/archive', [ArchiveInvoicesController::class, 'archive'])->name('archive_invoice');
// Route::get('/invoices/{id}/restore', [ArchiveInvoicesController::class, 'restore'])->name('restore_invoice');
// Route::get('/invoices/{id}/print', [InvoiceController::class, 'print'])->name('print_invoice');
// Route::get('invoices/archive', [ArchiveInvoicesController::class, 'show']);
// Route::get('invoices/export', [InvoiceController::class, 'export'])->name("invoices-export");
// Route::resource('invoices', InvoiceController::class);
Route::middleware(['auth'])->group(function () {
    // Place your authenticated routes here
    Route::resource('sections', SectionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('details_invoice', InvoiceDetailController::class);
    Route::resource('invoice_Attachment', InvoiceAttachmentController::class);
    Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
    Route::get('payments/invoices', [InvoiceController::class, 'Invoice_Paid']);
    Route::get('/files/{invoice}/{filename}/{action}', [InvoiceAttachmentController::class, 'showOrDownload'])->name('files.action');
    Route::get('/Status_show/{id}', [InvoiceController::class, 'show'])->name('Status_show');
    Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');
    Route::get('Invoice_UnPaid', [InvoiceController::class, 'Invoice_UnPaid']);
    Route::get('Invoice_Partial', [InvoiceController::class, 'Invoice_Partial']);
    Route::get('invoices/{id}/archive', [ArchiveInvoicesController::class, 'archive'])->name('archive_invoice');
    Route::get('/invoices/{id}/restore', [ArchiveInvoicesController::class, 'restore'])->name('restore_invoice');
    Route::get('/invoices/{id}/print', [InvoiceController::class, 'print'])->name('print_invoice');
    Route::get('invoices/archive', [ArchiveInvoicesController::class, 'show']);
    Route::get('invoices/export', [InvoiceController::class, 'export'])->name("invoices-export");
    Route::resource('invoices', InvoiceController::class);
});
Route::get('reset', function () {
    return view("auth.reset-password");
});
// Route::get('/some-route/{id}', [SomeController::class, 'index']);
Route::get('/gmail', function () {
    Mail::to('brahim2001elguabdi@gmail.com')->send(new helloMail());
    return 'done';
});
Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
    ]);
});
Route::view('/reports','reports.test');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/{page}', [AdminController::class, 'index']);
