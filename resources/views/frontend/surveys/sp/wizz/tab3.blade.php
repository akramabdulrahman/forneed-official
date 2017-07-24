<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Configurations</span>
        </div>
    </div>
    <div>
        @include('admin.errors')
    </div>
    <div class="portlet-body form " id="config-handler">

        <div class="row" >

            <div class="config-wrapper col-lg-12 row ">

{{--            {!! Form::open(['route' => 'storeConfig','class'=>"config_form"]) !!}--}}
            {!! Form::hidden('survey_id',null,['class'=>'curr-survey']) !!}
            <!-- User Attr Name Field -->
                <div class="form-group col-sm-4">
{{--                    {!! Form::select('user_attr_name', $user_attrs, null, ['class' => 'form-control','placeholder'=>'User Attribute...']) !!}--}}
                </div>

                <!-- Operator Field -->
                <div class="form-group col-sm-4">
                    {!! Form::select('operator', array(">"=>"Greater Than","<"=>"Less Than",">="=>"Greater Than or Equals","<="=>"Less Than or Equals","=="=>"Equals","!="=>"Not Equal"),null, ['class' => 'form-control', 'placeholder'=>'Relation...']) !!}
                </div>

                <!-- Coefficient Field -->
                <div class="form-group col-sm-4">
                    {!! Form::number('coefficient', null, ['class' => 'form-control','placeholder'=>'Coefficiant...']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <button id="add_config" class="btn btn-lg btn-block glyphicon glyphicon-plus-sign"></button>

            </div>
        </div>
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            <div class="form-actions">
                <div class="row  col-md-offset-0">
                    {!! Form::submit('Finish', ['class' => 'btn green  btn-outline configs-submit']) !!}

                </div>
            </div>
        </div>
    </div>
</div>
