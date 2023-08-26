@extends('layouts.master2')
@section('css')
<!--- Internal Fontawesome css-->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('assets/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection
@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="{{URL::asset('assets/img/media/404.svg')}}" class="error-page" alt="error">
			<h2 class="mt-4">عفوا. الصفحة التي كنت تبحث عنها غير موجودة.</h2>
			<h6>ربما تكون قد أخطأت في كتابة العنوان أو ربما تكون الصفحة قد انتقلت.</h6><a class="btn btn-outline-success" href="{{ url('/' . $page='home') }}"><i class="fas fa-home"></i> العودة إلى الرئيسية</a>
		</div>
		<!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection