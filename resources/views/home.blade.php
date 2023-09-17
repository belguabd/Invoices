{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.master')
@section('title')
    لوحه التحكم - برنامج الفواتير
@endsection
@section('css')
    <!--  Owl-carousel css-->


    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 ">الرئسية</h2>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 font-weight-bold text-white">الفواتير المدفوعة
                        </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <strong class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\Models\Invoice::where('Value_Status', '1')->sum('Total'), 2) }}
                                </strong>

                                <span class="text-white">درهم</span>
                                <p class="mb-0 tx-12 text-white op-7">عدد الفواتير المدفوعة :
                                    &nbsp;{{ \App\Models\Invoice::where('Value_Status', '1')->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::where('Value_Status', '1')->sum('Total') != 0)
                                    <span
                                        class="text-white op-7">{{ round((\App\Models\Invoice::where('Value_Status', '1')->count() / \App\Models\Invoice::count()) * 100) }}%</span>
                            </span>
                        @else
                            <span class="text-white op-7">0%</span>
                            </span>
                            @endif

                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 font-weight-bold text-white">الفواتير غير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <strong
                                    class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Invoice::where('Value_Status', '2')->sum('Total'), 2) }}</strong>

                                <span class="text-white">درهم</span>
                                <p class="mb-0 tx-12 text-white op-7">عدد الفواتير غير المدفوعة :
                                    &nbsp;{{ \App\Models\Invoice::where('Value_Status', '2')->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::where('Value_Status', '2')->sum('Total') != 0)
                                    <span class="text-white op-7">
                                        {{ round((\App\Models\Invoice::where('Value_Status', '2')->count() / \App\Models\Invoice::count()) * 100) }}%
                                    </span>
                                @else
                                    <span class="text-white op-7">0%</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 font-weight-bold text-white">الفواتير المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <strong
                                    class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Invoice::where('Value_Status', '3')->sum('Total'), 2) }}</strong>

                                <span class="text-white">درهم</span>
                                <p class="mb-0 tx-12 text-white op-7">عدد الفواتير مدفوعة جزئيا :
                                    &nbsp;{{ \App\Models\Invoice::where('Value_Status', '3')->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                @if (\App\Models\Invoice::where('Value_Status', '2')->sum('Total') != 0)
                                    <span class="text-white op-7">
                                        {{ round((\App\Models\Invoice::where('Value_Status', '3')->count() / \App\Models\Invoice::count()) * 100) }}%
                                    </span>
                                @else
                                    <span class="text-white op-7">0%</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white font-weight-bold">اجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <strong
                                    class="tx-20 font-weight-bold mb-1 text-white">{{ number_format(\App\Models\Invoice::sum('Total'), 2) }}</strong>

                                <span class="text-white">درهم</span>
                                <p class="mb-0 tx-12 text-white op-7">عدد الفواتير :
                                    &nbsp;{{ \App\Models\Invoice::count() }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between border-bottom">
                        <h4 class="card-title mb-3 ">رسم بياني للفواتير</h4>
                    </div>


                </div>
                <div class="card-body">
                    {!! $chartjs->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one border-bottom">
                <div class="d-flex justify-content-between border-bottom">
                    <h4 class="card-title mb-3 ">رسم دائري للفواتير</h4>
                </div>
                <div class="card-body">
                    {!! $chartjspie->render() !!}
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}">
        < /> <!--Internal Flot js-- >
        <
        script src = "{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}" >
    </script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>


    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
