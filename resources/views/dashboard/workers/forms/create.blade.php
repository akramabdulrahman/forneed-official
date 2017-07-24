@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
<link rel="stylesheet" href="{{asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/custom-file-input/css/component.css')}}">
<link rel="stylesheet" href="{{asset('/assets/custom-file-input/css/demo.css')}}">
@endpush

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="background-color:#fff">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('Dashboard.work.crud.list')}}">Social Workers</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>New Social Worker</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> New Social Worker
                <small></small>
            </h3>

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal style-form" enctype="multipart/form-data" action="{{route('Dashboard.work.crud.store')}}"
                          method="post">
                        {{csrf_field()}}
                        @include('dashboard.workers.forms.fields')

                        <div class=" form-group col-sm-12 margin-top-10">
                            <input type="submit" value="Create" class="btn green">
                            <a href="{{route('Dashboard.work.crud.list')}}" class="btn default"> Cancel </a>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    @include('flash::message')

                    @include('dashboard.layout.errors')
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>

@stop
@push('page_script_plugins')
<script src="{{asset('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/assets/pages/scripts/components-bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/assets/custom-file-input/js/custom-file-input.js')}}"></script>
@endpush