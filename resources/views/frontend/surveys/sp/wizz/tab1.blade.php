<!--new survey-->
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Survey</span>
        </div>
    </div>
    <div>
        @include('admin.errors')
    </div>
    <div class="portlet-body form">
        <div class="row">

            <form action="{{url("gateways/surveys/store/survey")}}" id="submit_form" class="currSurvey" novalidate
                  method="post">
            {{ csrf_field() }}

            <!-- Subject Field -->
                <div class="form-group col-sm-9">
                    </br>
                    {!! Form::label('subject', 'Subject:') !!}
                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-9">
                    <label class="control-label col-md-3">Advance Date Ranges</label>
                    <div class="col-md-4">
                        <div id="reportrange" tabindex="2" class="btn default">
                            <i class="fa fa-calendar"></i> &nbsp;
                            <span> </span>
                            <b class="fa fa-angle-down"></b>
                        </div>
                    </div>
                </div>
                <!-- Starts At Field -->

            {!! Form::hidden('starts_at', null, ['class' => 'form-control','placeholder'=>'Starts At','id'=>'starts_at']) !!}

            <!-- Expires At Field -->
            {!! Form::hidden('expires_at', null, ['class' => 'form-control','placeholder'=>'Expires At','id'=>'expires_at']) !!}


            <!-- Description Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
                </div>

                <!-- Project Id Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('projects-drop-down', 'Project Id:') !!}
                    {{--{!! Form::select('project_id',$projects, null, ['class' => 'form-control','id'=>'projects-drop-down','placeholder'=>'Please Choose A project']) !!}--}}
                </div>


                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    <div class="form-actions">
                        <div class="row  col-md-offset-0">
                            {!! Form::submit('Continue', ['class' => 'btn green  btn-outline']) !!}

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="/assets/ajax_dynamic_forms.js" type="text/javascript"></script>
@endpush