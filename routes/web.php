<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Models\Invoice_Attachment;
use App\Models\Invoice_detail;

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
Route::resource('sections', SectionController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('products', ProductController::class);
Route::resource('details_invoice', InvoiceDetailController::class);
Route::resource('invoice_Attachment', InvoiceAttachmentController::class);
Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
Route::get('/{page}', [AdminController::class, 'index']);
Route::get('/files/{invoice}/{filename}/{action}', [InvoiceAttachmentController::class, 'showOrDownload'])->name('files.action');



// Route::get('/some-route/{id}', [SomeController::class, 'index']);
