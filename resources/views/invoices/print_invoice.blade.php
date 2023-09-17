@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">فاتورة تحصيل</h1>
                         
                            <div class="col-md mt-4 ">
                                <h5 class="font-weight-bold">معلومات الفاتورة</h5>
                                <p class="invoice-info-row font-weight-bold "><span>رقم الفاتورة</span>
                                    <span>{{ $invoices->invoice_number }}</span></p>
                                <p class="invoice-info-row font-weight-bold"><span>تاريخ الاصدار</span>
                                    <span>{{ $invoices->invoice_Date }}</span></p>
                                <p class="invoice-info-row font-weight-bold"><span>تاريخ الاستحقاق</span>
                                    <span>{{ $invoices->Due_date }}</span></p>
                                <p class="invoice-info-row font-weight-bold"><span>القسم</span>
                                    <span>{{ $invoices->section->section_name }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class=" wd-20p ">#</th>
                                        <th class=" wd-40p">المنتج</th>
                                        <th class=" tx-center">مبلغ التحصيل</th>
                                        <th class=" tx-right">مبلغ العمولة</th>
                                        <th class=" tx-right">الاجمالي</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ $prodcut->product_name }}</td>
                                        <td class="tx-center">{{ number_format($invoices->Amount_collection, 2) }}</td>
                                        <td class="tx-right">{{ number_format($invoices->Amount_Commission, 2) }}</td>
                                        @php
                                        $total = $invoices->Amount_collection + $invoices->Amount_Commission ;
                                        @endphp
                                        <td class="tx-right">
                                            {{ number_format($total, 2) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                           
                                        </td>
                                        <td class="font-weight-bold">الاجمالي</td>
                                        <td class="font-weight-bold" colspan="2"> {{ number_format($total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">نسبة الضريبة ({{ $invoices->Rate_VAT }})</td>
                                        <td class="font-weight-bold" colspan="2">287.50</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">قيمة الخصم</td>
                                        <td class="font-weight-bold" colspan="2"> {{ number_format($invoices->Discount, 2) }}</td>

                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                        <td class="font-weight-bold" colspan="2">
                                            <h4 class="tx-success tx-medium">{{ number_format($invoices->Total, 2) }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-success   mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                class="mdi mdi-printer ml-1"></i>طباعة</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection