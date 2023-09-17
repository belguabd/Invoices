@extends('layouts.master')
@section('css')
@endsection
@section('title')
    تغير حالة الدفع
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغير حالة الدفع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Status_Update', ['id' => $invoice->id]) }}" method="post" autocomplete="off">
                        @csrf
                        <!-- Section 1 -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="control-label font-weight-bold">رقم الفاتورة</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" name="invoice_number"
                                    value="{{ $invoice->invoice_number }}" required readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->invoice_Date }}" required readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->Due_date }}" required readonly>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label class="control-label font-weight-bold">القسم</label>
                                <select name="Section" class="form-control " readonly>
                                    <!--placeholder-->
                                    <option selected>{{ $invoice->section->section_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label font-weight-bold">المنتج</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option> {{ $product->product_name }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label font-weight-bold">مبلغ التحصيل</label>
                                <input type="text" class="form-control" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Amount_collection }}" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">

                            <div class="col">
                                <label for="inputName" class="control-label font-weight-bold">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Amount_Commission }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label font-weight-bold">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label font-weight-bold">نسبة ضريبة القيمة
                                    المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()"
                                    readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->Rate_VAT }}">
                                        {{ $invoice->Rate_VAT }}
                                </select>
                            </div>

                        </div>
                        {{-- 4 --}}

                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputName" class="control-label font-weight-bold">قيمة ضريبة القيمة
                                    المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoice->Value_VAT }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label font-weight-bold">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $invoice->Total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row mt-3">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{ $invoice->note }}</textarea>
                            </div>
                        </div><br>
                        <!-- Add similar sections for other fields -->

                        <!-- Actions Section -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label class="control-label font-weight-bold">حالة الدفع</label>
                                <select class="form-control" id="Status" name="Status" required>
                                    <option selected disabled>-- حدد حالة الدفع --</option>
                                    <option value="مدفوعة">مدفوعة</option>
                                    <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">تاريخ الدفع</label>
                                <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-end mt-3">
                                <button type="submit" class="btn btn-success">تحديث حالة الدفع</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
@endsection
