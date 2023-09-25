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
@section('title')
    الأقسام
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الأقسام</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row ">
        <div class="col-xl-12">
            {{-- @if (session('error'))
                <div class="alert alert-solid-danger mg-b-0" role="alert">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span></button>
                    {{ session('error') }}
                </div>
            @endif --}}
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
            </div>
            <div class="col-3">
                @if (session('success'))
                    <div class="alert alert-solid-success" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span></button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    {{-- <div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">الأقسام</h4>
								</div> --}}
                    <div class="col-3">
                        <a class="modal-effect btn btn-success btn-sm font-weight-bold p-2 " data-effect="effect-scale" data-toggle="modal"
                            href="#modaldemo8"> <i class="fas fa-plus"></i> اضافة قسم</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">اسم القسم</th>
                                        <th class="wd-15p border-bottom-0">الوصف</th>
                                        <th class="wd-15p border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td>{{ $section->id }}</td>
                                            <td>{{ $section->section_name }}</td>
                                            <td>{{ $section->description }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-sm btn-info open-edit-modal"
                                                    data-effect="effect-scale" data-toggle="modal" href="#modalEdit"
                                                    data-id="{{ $section->id }}"
                                                    data-section-name="{{ $section->section_name }}"
                                                    data-description="{{ $section->description }}">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                <a class="modal-effect btn btn-sm btn-danger open-delete-modal"
                                                    data-effect="effect-scale" data-toggle="modal" href="#modaldelete"
                                                    data-id="{{ $section->id }}"
                                                    data-delete-section-name="{{ $section->section_name }}">
                                                    <i class="las la-trash"></i>
                                                </a>
                                            </td>
                                            {{-- <td>{{ $section->Create_by }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal add --}}
            <div class="modal" id="modaldemo8">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('sections.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">اسم قسم</label>
                                    <input type="text" class="form-control" id="section_name" name="section_name">
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
            {{-- end modal  --}}
            {{-- modal edit --}}
            <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditLabel">تعديل القسم</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="sections/update" method="POST" id="editForm" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" id="section_id" name="section_id">
                                <div class="form-group">
                                    <label for="editSectionName">اسم القسم</label>
                                    <input type="text" class="form-control" id="editSectionName" name="section_name">
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
            {{-- end modal  --}}
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
                            <form action="sections/delete" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" class="form-control" id="sectionDeleteId" name="section_id">
                                <div class="form-group">
                                    <label for="editSectionName">هل انت متأكد من عملية الحذف ؟</label>
                                    <input type="text" class="form-control" id="deleteSectionName"
                                        name="section_name" readonly>
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
    {{-- <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
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
                var sectionId = $(this).data('id');
                var sectionName = $(this).data('section-name');
                var description = $(this).data('description');
                var deleteSection = $(this).data('delete-section-name');
                $('#section_id').val(sectionId);
                $('#editSectionName').val(sectionName);
                $('#editDescription').val(description);
                $('#deleteSectionName').val(deleteSection);
                $('#modalEdit').modal('show');
            }); 
            //code delete section
            $('.open-delete-modal').on('click', function(event) {
                event.preventDefault();
                var sectionId = $(this).data('id');
                var deleteSection = $(this).data('delete-section-name');  
                $('#deleteSectionName').val(deleteSection);
                $('#sectionDeleteId').val(sectionId);
                $('#modaldelete').modal('show');
            });
        });
    </script>
@endsection
