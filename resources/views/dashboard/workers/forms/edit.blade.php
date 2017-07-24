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
                        <span>Edit Social Worker</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Social Worker
                <small></small>
            </h3>

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-6">
                {!! Form::model($worker,[
                                     'id' =>"account-form",
                                     'route'=>['Dashboard.work.crud.update',$worker->id],
                                     'files'=>true
                                 ]) !!}
                {{ method_field('PATCH') }}

                <!-- Name Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('user[name]', 'Name:') !!}
                        {!! Form::text('user[name]', old('user[name]'), ['class' => 'form-control']) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('user[email]', 'Email:') !!}
                        {!! Form::email('user[email]', old('user[email]'), ['class' => 'form-control']) !!}
                    </div>

                    <!-- Password Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('user[password]', 'Password:') !!}
                        {!! Form::password('user[password]', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('user[password_confirmation]', 'Confirm password:') !!}
                        {!! Form::password('user[password_confirmation]', ['class' => 'form-control']) !!}
                    </div>


                    <!-- area Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('area_id', 'Area:') !!}
                        {!! Form::select('area_id',$areas ,null, ['data-style'=>'btn-default','placeholder'=>'please select area','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
                    </div>
                    @foreach($extras as $cat=>$extra)
                        <?php $name = ucfirst(implode(' ', explode('_', snake_case($cat))));?>
                        <div class="form-group col-sm-6">
                            {{ Form::select("extra[$cat]", $extra->pluck('extra','id'),isset($social_worker_extras[$cat])?$social_worker_extras[$cat]:null,['class'=>'selectpicker show-tick show-menu-arrow form-control','data-style'=>"btn-default",'placeholder'=>"choose $name"]) }}
                        </div>
                    @endforeach


                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 col-sm-2 control-label">address</label>
                        <div class="col-sm-10">
                            {!! Form::text('address',null,['class'=>'form-control text-center round-form']) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 col-sm-2 control-label">mobile</label>
                        <div class="col-sm-10">
                            {!! Form::text('mobile',null,['class'=>'form-control text-center round-form']) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 col-sm-2 control-label">telephone</label>
                        <div class="col-sm-10">
                            {!! Form::text('telephone',null,['class'=>'form-control text-center round-form']) !!}

                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="col-sm-2 col-sm-2 control-label">CV:</label>
                        <div class="col-sm-12">

                            <div class="">
                                {!! Form::file('cv',['class'=>'inputfile inputfile-5','id'=>"file-6",'style'=>'display:none;' ]) !!}
                                <label for="file-6">
                                    <figure>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                             viewBox="0 0 20 17">
                                            <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                        </svg>
                                    </figure>
                                    <span></span></label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group  col-md-6">
                        {!! Form::label('is_accepted', 'Accepted:') !!}
                        <div>
                            {!! Form::checkbox('is_accepted',1,$worker->is_accepted?'checked':'',['class'=>'make-switch','data-off-color'=>'success','data-on-color'=>'info']) !!}

                        </div>

                    </div>
                    <div class=" form-group col-sm-12 margin-top-10">
                        <input type="submit" class="btn green" value="edit">
                        <a href="{{route('Dashboard.work.crud.list')}}" class="btn default"> Cancel </a>
                    </div>
                    {!! Form::close() !!}
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