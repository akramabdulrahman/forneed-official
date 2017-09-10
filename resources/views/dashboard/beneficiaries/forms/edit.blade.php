@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
    <link rel="stylesheet" href="{{asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}">
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
                        <a href={{route('Dashboard.landing')}}>Beneficiaries</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Edit Beneficiary</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Beneficiary
                <small></small>
            </h3>

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-6">
                    {!! Form::model($user, [
                                         'id' =>"account-form",
                                         'route'=>['Dashboard.ben.crud.update',$user->citizen->id]
                                     ]) !!}
                    {{ method_field('PATCH') }}


                    <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Email Field -->
                    <div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>


                    @foreach($extras as $cat=>$extra)
                        <?php $name = ucfirst(implode(' ', explode('_', snake_case($cat))));
                        $multi = isset($manyRelations) ? (in_array($cat, $manyRelations) ? true : false) : false;$final_name = $multi?str_plural($name):$name?>
                        <div class="form-group col-sm-6">
                            {{ Form::select("extra[$cat]".($multi?'[]':''),$extra->pluck('extra','id'),isset($citizen_extras[$cat])? $multi?collect($citizen_extras[$cat])->map->id->toArray() :$citizen_extras[$cat]:null,['class'=>'selectpicker show-tick show-menu-arrow form-control','data-style'=>"btn-default",'placeholder'=>"choose $final_name",$multi?'multiple':'']) }}
                        </div>
                    @endforeach

                    <div class="form-group  col-md-6 margin-left-10">
                        <div class="col-md-offset-1">
                            <input value="1" type="checkbox" id="contactable" {{$citizen->contactable?'checked':0}}
                            data-size="large" name="contactable" class="make-switch "
                                   data-on-color="info" data-off-color="danger" data-off-text="☒contact"
                                   data-on-text="☑contact">
                        </div>
                    </div>


                    <div class="form-group col-sm-12 margin-top-10">
                        <input type="submit" value="edit" class="btn green"/>
                        <a href="{{route('Dashboard.ben.crud.list')}}" class="btn default"> Cancel </a>
                    </div>
                    {{--</form>--}}
                    {{form::close()}}
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
@endpush