@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@section('title')
    تعديل مستخدم - مورا سوفت للادارة القانونية
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
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
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a href="{{ route('users.index') }}" class="btn btn-success btn-sm font-weight-bold ">
                            <i class="fas fa-angle-right mr-2"></i>&nbsp; رجوع
                        </a>
                    </div>
                </div><br>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                    required>
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control"
                                    required>
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" required id="password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="password-toggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="confirm-password" class="form-control" required
                                    id="confirm-password">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" id="confirm-password-toggle"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="status" id="select-beast" class="form-control nice-select custom-select">
                                <option value="{{ $user->status }}">{{ $user->status }}</option>
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>نوع المستخدم</strong>
                                <select name="roles_name[]" multiple class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if (in_array($role, $userRole)) selected @endif>{{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mg-t-30">
                        <button class="btn btn-success" type="submit">تحديث</button>
                    </div>
                </form>

            </div>
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

<!-- Internal Nice-select js-->
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>

<!--Internal  Parsley.min js -->
<script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<!-- Internal Form-validation js -->
<script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#password-toggle").click(function() {
            var passwordField = $("#password");
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $("#password-toggle").removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $("#password-toggle").removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#confirm-password-toggle").click(function() {
            var confirmPasswordField = $("#confirm-password");
            var confirmPasswordFieldType = confirmPasswordField.attr('type');

            if (confirmPasswordFieldType === 'password') {
                confirmPasswordField.attr('type', 'text');
                $("#confirm-password-toggle").removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                confirmPasswordField.attr('type', 'password');
                $("#confirm-password-toggle").removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

@endsection
