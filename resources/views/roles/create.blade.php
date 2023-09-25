@extends('layouts.master')

@section('css')
    <!-- Internal Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Internal treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    اضافة الصلاحيات - مورا سوفت للادارة القانونية
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصلاحيات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة نوع مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">إضافة صلاحية جديدة</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">اسم الصلاحية:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <hr>
                            <h6 class="font-weight-bold">الصلاحيات</h6>
                            <div class="form-group">
                                <ul class="list-group list-group-flush">
                                    @foreach ($permission as $value)
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                                        value="{{ $value->id }}" id="checkbox{{ $value->id }}">
                                                    <label class="form-check-label mr-3" for="checkbox{{ $value->id }}">
                                                        {{ $value->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success">تأكيد</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Internal Treeview js -->
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
