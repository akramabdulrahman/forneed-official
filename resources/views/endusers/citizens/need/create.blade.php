@extends('endusers.layout.dashboard')

@section('menu')
    @include('endusers.citizens.menu')
@stop

@push('page_style_plugins')
<link href="{{asset("/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css")}}" rel="stylesheet" type="text/css"/>
<style>
    .no-border {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    }

    input.transparent-input {
        background-color: rgba(0, 0, 0, 0) !important;
        border: none !important;
    }
</style>
@endpush
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Dashboard
            <small>dashboard & statistics</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN PORTLET -->
        <div class="row">
            <div class="portlet light col-lg-7">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">New Need</span>
                        <span class="caption-helper hide">weekly stats...</span>
                    </div>

                </div>
                <div class="portlet-body " style="height:400px;padding: 0px;margin: 0px;margin-bottom: 16px;">
                    {!! Form::open(array('route'=>'endusers.ben.storeServiceRequest','method'=>'POST', 'files'=>true)) !!}

                    <div class="portlet light form">
                        <div class="portlet-title col-lg-12 text-indent-2">
                            <div class="form-group">
                                Sector
                                <div class="btn-group  btn-group-devided" data-toggle="buttons">
                                    @foreach($sectors as $id=>$sector)
                                        <label class="btn btn-transparent btn-default btn-circle btn-sm">
                                            {{ Form::radio('sector_id', $id,null,['class'=>'toggle']) }}
                                            {{$sector}}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="fileinput fileinput-new"  data-provides="fileinput">

                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                                    <span class="btn default btn-file" ">
                                                <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        {!! Form::file('images[]', array('multiple'=>true,'accept'=>"image/*",'class'=>' file ',"data-provides"=>"fileinput")) !!}
                                                    </span>
                                    </div>

                                    <a href="javascript:;" class="btn red fileinput-exists"
                                       data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    Location
                                    <div class="btn-group  btn-group-devided" data-toggle="buttons">
                                        @foreach($areas as $area)
                                            <label for="area_id_{{$area->id}}"
                                                   class="btn btn-transparent btn-default btn-circle  btn-sm">
                                                {{ Form::radio('area_id', $area->id,null,['class'=>'toggle area_id ','id'=>'area_id_'.$area->id,'data-lat'=>$area->lat,'data-lng'=>$area->lng]) }}
                                                {{$area->name}}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 form-group">

                                <div id="map" style="height:320px;"></div>
                                <div style="position:absolute;z-index:99;top:0px;left:0px;"></div>

                            </div>
                            <div class="form-group col-lg-12 border-top ">
                                {!! Form::submit('Submit Need',['class'=>'btn btn-success btn-lg btn-block']) !!}
                            </div>
                        </div>

                    </div>

                    {!! Form::close()!!}


                </div>


            </div>
            <div class="col-lg-5">
                @include('flash::message')
            </div>
        </div>

    </div>
@stop

@push('page_script_plugins')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="{{asset('/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/map_init.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/location_map_bind.js')}}" type="text/javascript"></script>

@endpush