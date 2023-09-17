@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />


    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            @if (session('deleted_at'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: "تم حذف الفاتورة بنجاح",
                            type: "success"
                        })
                    }
                </script>
            @endif
            @if (session('restore_invoice'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: 'تم استعادة الفاتورة من الأرشيف بنجاح.',
                            type: "success"
                        })
                    }
                </script>
            @endif
            @if (session('archive_invoice'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: 'تم نقل الفاتورة إلى الأرشيف بنجاح.',
                            type: "success"
                        })
                    }
                </script>
            @endif
            <div class="col-3">
                @if (session('success'))
                    <div class="alert alert-solid-success" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col">
                        <div class="btn-group" role="group">
                            <a class="modal-effect btn btn-success-gradient  ml-1 tx-bold " href="{{ route('invoices.create') }}"><i class="fas fa-plus"></i>&nbsp;اضافة فاتورة</a>
                            <a class="modal-effect btn btn-dark-gradient  tx-bold" href="{{ route('invoices-export') }}"><i class="far fa-file-excel"></i>&nbsp;تصدير اكسيل</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                        <th class="wd-15p border-bottom-0"> تاريخ الفاتورة</th>
                                        <th class="wd-10p border-bottom-0">القسم</th>
                                        <th class="wd-25p border-bottom-0">الخصم</th>
                                        <th class="wd-25p border-bottom-0">الاجمالي</th>
                                        <th class="wd-25p border-bottom-0">الحالة</th>
                                        <th class="wd-20p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->invoice_Date }}</td>
                                            <td>{{ $invoice->section->section_name }}</td>
                                            <td>{{ $invoice->Discount }}</td>
                                            <td>{{ $invoice->Total }}</td>
                                            <td>
                                                @if ($invoice->Value_Status == 1)
                                                    <span
                                                        class="badge badge-pill badge-success">{{ $invoice->Status }}</span>
                                                @elseif($invoice->Value_Status == 2)
                                                    <span
                                                        class="badge badge-pill badge-danger">{{ $invoice->Status }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-warning">{{ $invoice->Status }}</span>
                                                @endif
                                            </td>
                                            <td>


                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('invoices.edit', ['invoice' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-info mx-1" data-placement="top"
                                                        data-toggle="tooltip" title="تعديل على الفاتورة"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('Status_show', ['id' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-primary mx-1" data-placement="top"
                                                        data-toggle="tooltip" title="تغيير حالة الدفع"><i
                                                            class="fas fa-handshake"></i></a>
                                                    <a href="{{ route('details_invoice.show', ['details_invoice' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-secondary mx-1" data-placement="top"
                                                        data-toggle="tooltip" title="عرض الفاتورة"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('print_invoice', ['id' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-dark mx-1" data-placement="top"
                                                        data-toggle="tooltip" title="طباعة الفاتورة"><i
                                                            class="fas fa-print"></i></a>
                                                    {{-- <a href="{{ route('details_invoice.show', ['details_invoice' => $invoice->id]) }}"
                                                        class="btn btn-sm btn-secondary mx-1" data-placement="top"
                                                        data-toggle="tooltip" title="نقل الى الارشيف"><i class="fas fa-archive"></i></a> --}}
                                                    <!-- Button to trigger the modal -->
                                                    <a href="#" class="btn btn-sm btn-warning mx-1"
                                                        data-placement="top" data-toggle="modal"
                                                        data-target="#confirmationModal" title="نقل الى الارشيف">
                                                        <i class="fas fa-archive"></i>
                                                    </a>

                                                    <!-- Modal for confirmation -->
                                                    <div class="modal fade" id="confirmationModal" tabindex="-1"
                                                        role="dialog" aria-labelledby="confirmationModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="confirmationModalLabel">
                                                                        تأكيد النقل إلى الأرشيف</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    هل أنت متأكد من نقل هذه الفاتورة إلى الأرشيف؟
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">إلغاء</button>
                                                                    <a href="{{ route('archive_invoice', ['id' => $invoice->id]) }}"
                                                                        class="btn btn-success">تأكيد النقل</a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a class="modal-effect btn btn-sm open-delete-modal btn-danger mx-1"
                                                        data-effect="effect-scale" data-toggle="modal"
                                                        href="#modaldelete" title="حذف الفاتورة">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- ========== model delete ========== -->
                                        <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog"
                                            aria-labelledby="modaldelete" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalEditLabel">حذف المرفق</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($invoices)
                                                            <form
                                                                action="{{ route('invoices.destroy', ['invoice' => $invoice->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="form-group">
                                                                    <label for="editSectionName">هل تريد حذف الفاتورة
                                                                        ؟</label>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn ripple btn-secondary"
                                                                        data-dismiss="modal">الغاء</button>
                                                                    <input class="btn ripple btn-danger" type="submit"
                                                                        value="تأكيد" />
                                                                </div>
                                                                <!-- Other form fields -->
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ========== End delete ========== -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
            <!--div-->
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
