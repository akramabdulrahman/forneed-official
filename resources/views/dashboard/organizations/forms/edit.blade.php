@extends('dashboard.layout.dashboard')


@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="background-color:#fff">
            <!-- BEGIN PAGE HEADER-->

            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href={{route('Dashboard.landing')}}>Organizations</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Edit Organization</span>
                    </li>
                </ul>

            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Organization
                <small></small>
            </h3>

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-6">
                    {!! Form::model($user, [
                                         'id' =>"account-form",
                                         'route'=>['Dashboard.org.crud.update',$user->serviceProvider->id]
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


                    <div class="form-group col-sm-6 {{ $errors->has('sector_id') ? 'has-error' : ''}}">
                        {!! Form::label('sector_id', 'Sector:') !!}
                        {{ Form::select('sp[sector_id][]', $sectors,array_keys($sp->sectors()->pluck('name','id')->toArray()),['class'=>'selectpicker show-tick show-menu-arrow form-control','multiple'=>true,'data-style'=>"btn-default"]) }}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('area_id') ? 'has-error' : ''}}">
                        {!! Form::label('area_id', 'Area:') !!}
                        {{ Form::select('sp[area_id][]', $areas,array_keys($sp->areas()->pluck('name','id')->toArray()),['class'=>'selectpicker show-tick show-menu-arrow form-control','multiple'=>true,'data-style'=>"btn-default"]) }}
                    </div>
                    @foreach($extras as $cat=>$extra)
                        <?php $name = ucfirst(implode(' ', explode('_', snake_case($cat))));?>
                        <div class="form-group col-sm-6">
                            {{ Form::select("extra[$cat]", $extra->pluck('extra','id'),isset($service_provider_extras[$cat])?$service_provider_extras[$cat]:null,['class'=>'selectpicker show-tick show-menu-arrow form-control','data-style'=>"btn-default",'placeholder'=>"choose $name"]) }}
                        </div>
                    @endforeach
                    <div class="form-group col-sm-6 {{ $errors->has('mission_statement') ? 'has-error' : ''}}">
                        {!! Form::label('sp[mission_statement]', 'mission statement:') !!}
                        {!! Form::textarea('sp[mission_statement]', $sp->mission_statement, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                        {!! Form::label('sp[phone_number]', 'phone number:') !!}
                        {!! Form::text('sp[phone_number]', $sp->phone_number, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('mobile_number') ? 'has-error' : ''}}">
                        {!! Form::label('sp[mobile_number]', 'mobile_number:') !!}
                        {!! Form::text('sp[mobile_number]', $sp->mobile_number, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('fax') ? 'has-error' : ''}}">
                        {!! Form::label('sp[fax]', 'fax:') !!}
                        {!! Form::text('sp[fax]', $sp->fax, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6 {{ $errors->has('') ? 'has-error' : ''}}">
                        {!! Form::label('sp[website]', 'website:') !!}
                        {!! Form::text('sp[website]', $sp->website, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('') ? 'has-error' : ''}}">
                        {!! Form::label('sp[contact_person]', 'contact_person:') !!}
                        {!! Form::text( 'sp[contact_person]', $sp->contact_person, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6 {{ $errors->has('') ? 'has-error' : ''}}">
                        {!! Form::label('sp[contact_person_title]', 'contact_person_title:') !!}
                        {!! Form::text( 'sp[contact_person_title]', $sp->contact_person_title, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group  col-md-12">
                        {!! Form::label('sp[is_accepted]', 'Accepted:') !!}
                        <div>
                            {!! Form::checkbox('sp[is_accepted]',1,$sp->is_accepted?'checked':'',['class'=>'make-switch','data-off-color'=>'success','data-on-color'=>'info']) !!}

                        </div>

                    </div>
                    <div class="form-group col-sm-12 margin-top-10">
                        <input type="submit" value="edit" class="btn green"/>
                        <a href="{{route('Dashboard.org.crud.list')}}" class="btn default"> Cancel </a>
                    </div>
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
