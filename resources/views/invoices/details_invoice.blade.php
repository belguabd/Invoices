@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row  ">
        <div class="col-lg-12 col-md-12">
            <div class="col-3">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-solid-danger mg-b-0 mb-1" role="alert">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span></button>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                @if (session('success'))
                    <div class="alert alert-solid-success" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1 font-weight-bold">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line ">
                                    <li><a href="#tab4" class="nav-link fw-bolder active " data-toggle="tab">معلومات
                                            الفاتورة</a></li>
                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab4">
                                    <div class="container mt-5">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="card shadow">
                                                    <div class="card-header bg-success text-white text-center">
                                                        <h3 class="card-title text-white  mb-0">تفاصيل الفاتورة</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h5 class="fw-bold mb-3">معلومات الفاتورة</h5>
                                                                <p><strong>رقم الفاتورة:
                                                                    </strong>{{ $invoice->invoice_number }}</p>
                                                                <p><strong>تاريخ الفاتورة: </strong>
                                                                    {{ $invoice->invoice_Date }}</p>
                                                                <p><strong>تاريخ الاستحقاق: </strong>
                                                                    {{ $invoice->Due_date }}</p>
                                                                <p><strong>القسم:</strong>{{ $invoice->section->section_name }}
                                                                </p>
                                                                <p><strong>المنتج:</strong> {{ $product->product_name }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h5 class="fw-bold mb-3">المعلومات المالية</h5>
                                                                <p><strong>الخصم:</strong> {{ $invoice->Discount }}</p>
                                                                <p><strong>قيمة ضريبة القيمة المضافة:</strong>
                                                                    {{ $invoice->Value_VAT }}</p>
                                                                <p><strong>نسبة ضريبة القيمة المضافة:</strong>
                                                                    {{ $invoice->Rate_VAT }}</p>
                                                                <p><strong>المبلغ الإجمالي:</strong> {{ $invoice->Total }}
                                                                </p>
                                                                <p><strong>الحالة:</strong>
                                                                    @if ($invoice->Value_Status == 1)
                                                                        <span
                                                                            class="badge badge-pill  badge-success">{{ $invoice->Status }}</span>
                                                                    @elseif($invoice->Value_Status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ $invoice->Status }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="border rounded p-3">
                                                                    <strong class="mb-3 ">ملاحظات إضافية</strong>
                                                                    <p class="mb-0">{{ $invoice->note }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab5">
                                    <div class="container mt-3 ">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>المنتج</th>
                                                            <th>القسم</th>
                                                            <th>الحالة</th>
                                                            <th>المستخدم</th>
                                                            <th>تاريخ الإنشاء</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $invoice->id }}</td>
                                                            <td>{{ $invoice->invoice_number }}</td>
                                                            <td> {{ $product->product_name }}</td>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                            <td>
                                                                @if ($invoice->Value_Status == 1)
                                                                    <span
                                                                        class="badge   badge-success">{{ $invoice->Status }}</span>
                                                                @elseif($invoice->Value_Status == 2)
                                                                    <span
                                                                        class="badge  badge-danger">{{ $invoice->Status }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge  badge-warning">{{ $invoice->Status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ Auth::user()->name }}</td>
                                                            <td> {{ $invoice->invoice_Date }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <div class="card-body">
                                        <form action="{{ route('invoice_Attachment.store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <p class="text-danger">* صيغة المرفق: pdf, jpeg, jpg, png</p>
                                                    <h5 class="card-title">اضافة مرفق</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="custom-file">
                                                        <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}">
                                                        <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
                                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                                        <input class="custom-file-input" id="customFile" name="pic" type="file">
                                                        <label class="custom-file-label" for="customFile" accept=".pdf,.jpg,.png,image/jpeg,image/png" data-height="70">اختر ملف</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success mb-2">تأكيد</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                        <div class="table-responsive">
                                            @if ($invoice_Attachments)
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>اسم الملف</th>
                                                            <th>إنشاء بواسطة</th>
                                                            <th>تاريخ الإنشاء</th>
                                                            <th>العمليات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($invoice_Attachments as $invoice_Attachment)
                                                            <tr>
                                                                <td>{{ $invoice_Attachment->file_name }}</td>
                                                                <td>{{ $invoice_Attachment->Created_by }}</td>
                                                                <td>{{ $invoice_Attachment->created_at }}</td>
                                                                <td>
                                                                    <a href="{{ route('files.action', ['invoice' => $invoice->invoice_number, 'filename' => $invoice_Attachment->file_name, 'action' => 'view']) }}"
                                                                        class="btn btn-sm btn-outline-success" target="_blank">
                                                                        <i class="fas fa-eye"></i> عرض
                                                                    </a>
                                                                    <a href="{{ route('files.action', ['invoice' => $invoice->invoice_number, 'filename' => $invoice_Attachment->file_name, 'action' => 'download']) }}"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-download"></i> تحميل
                                                                    </a>
                                                                    <a class="modal-effect btn btn-sm btn-outline-danger open-delete-modal"
                                                                        data-effect="effect-scale" data-toggle="modal" href="#modaldelete">
                                                                        <i class="fas fa-trash-alt"></i> حذف
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <strong>لا توجد مرفقات</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== model delete ========== -->
            <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modaldelete"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">حذف المرفق</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @if ($invoice_Attachment)
                            <div class="modal-body">
                                <form
                                    action="{{ route('invoice_Attachment.destroy', ['invoice_Attachment' => $invoice_Attachment->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="form-group">
                                        <label for="editSectionName">هل تريد حذف المرفق
                                            ؟</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn ripple btn-secondary" data-dismiss="modal">الغاء</button>
                                        <input class="btn ripple btn-danger" type="submit" value="تأكيد" />
                                    </div>
                                    <!-- Other form fields -->
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ========== End delete ========== -->
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
