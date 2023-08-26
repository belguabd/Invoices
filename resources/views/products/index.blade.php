@extends('layouts.master')
@section('css')
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
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
                <div class="card-header pb-0">
                    <div class="col-2">
                        <a class="modal-effect btn btn-success btn-block" data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8"> <i class="fas fa-plus"></i> اضافة منتج</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                        <th class="wd-15p border-bottom-0">اسم القسم</th>
                                        <th class="wd-15p border-bottom-0">ملاحظات </th>
                                        <th class="wd-15p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->section->section_name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td><a class="modal-effect btn btn-outline-success fw-medium open-edit-modal"
                                                    data-effect="effect-scale" data-toggle="modal" href="#modalEdit"
                                                    data-id="{{ $product->id }}"
                                                    data-section_id="{{ $product->section_id }}"
                                                    data-product-name="{{ $product->product_name }}"
                                                    data-description="{{ $product->description }}">
                                                    تعديل
                                                </a>
                                                <a class="modal-effect btn  btn-outline-danger fw-medium open-delete-modal"
                                                    data-effect="effect-scale" data-toggle="modal" href="#modaldelete"
                                                    data-product-id="{{ $product->id }}"
                                                    data-delete-product-name="{{ $product->product_name }}">
                                                    حدف
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== add Products ========== -->
            <div class="modal" id="modaldemo8">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">Modal Header</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('products.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">اسم منتج</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">القسم</label>
                                    <select class="form-control" aria-label="Default select example" name="section_id">
                                        <option selected>--حدد القسم--</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">الوصف</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <input class="btn ripple btn-success" type="submit" value="تأكيد" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ========== End Products ========== -->
            <!-- ========== edit Product ========== -->

            <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">تعديل المنتج</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="products/update" method="POST" id="editForm" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" id="product_id" name="product_id">
                                <div class="form-group">
                                    <label for="editproductName">اسم منتج</label>
                                    <input type="text" class="form-control" id="editproductName" name="product_name">
                                </div>
								<div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">القسم</label>
                                    <select class="form-control" aria-label="Default select example" name="section_id" id="sectionDropdown">
                                        {{-- <option selected>--حدد القسم--</option> --}}
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editDescription">الوصف</label>
                                    <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <input class="btn ripple btn-success" type="submit" value="تأكيد" />
                                </div>
                                <!-- Other form fields -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== End Product ========== -->
            <!-- ========== Start modal delete ========== -->
            <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modaldelete"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">حذف القسم</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="products/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" class="form-control" id="productDeleteId" name="product_id">
                                <div class="form-group">
                                    <label for="editproductName">هل انت متأكد من عملية الحذف ؟</label>
                                    <input type="text" class="form-control" id="deleteproductName"
                                        name="product_name" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-secondary" data-dismiss="modal">الغاء</button>
                                    <input class="btn ripple btn-danger" type="submit" value="تأكيد" />
                                </div>
                                <!-- Other form fields -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ========== End  modal delete ========== -->

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
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script>
        //code update section
        $(document).ready(function() {
            $('.open-edit-modal').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('id');
                var sectionId = $(this).data('section_id');
			console.log(sectionId);
                var productName = $(this).data('product-name');
                var description = $(this).data('description');
                var deleteproduct = $(this).data('delete-product-name');
                $('#product_id').val(productId);
                $('#editproductName').val(productName);
                $('#editDescription').val(description);
                $('#deleteproductName').val(deleteproduct);
                $('#sectionDropdown').val(sectionId);
                $('#modalEdit').modal('show');
            });
            //code delete product
            $('.open-delete-modal').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('product-id');
                var deleteproduct = $(this).data('delete-product-name');
                $('#deleteproductName').val(deleteproduct);
                $('#productDeleteId').val(productId);
                $('#modaldelete').modal('show');
            });
        });
    </script>
@endsection
