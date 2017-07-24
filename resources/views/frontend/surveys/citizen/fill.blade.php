@extends('endusers.layout.dashboard')
@push('styles')
<link href="../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css"/>

@endpush
@section('menu')
    @include('endusers.citizens.menu')
@stop

@section('content')
    <div class="page-content">

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
        <div class="portlet light bordered full-height">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-drop font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> {{$survey->subject}}</span>
                </div>

            </div>

            <div class="portlet-body form">
                <div id="form_wizard_1" class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            @foreach($questions as $key=>$question)
                                <li class="{{($key === 0?"active":"")}}">
                                    <a href="#tab{{$key}}" data-toggle="tab" class="step first" aria-expanded="true">
                                        <span class="number">{{$key+1}}</span>
                                        <span class="desc">
                                    <i class="fa fa-check"></i>
                                    </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success" style="width: 25%;"></div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-content">
                                <div class="alert alert-danger display-none" style="display: none;">
                                    <button class="close" data-dismiss="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                                <div class="alert alert-success display-none" style="display: none;">
                                    <button class="close" data-dismiss="alert"></button>
                                    Your form validation is successful!
                                </div>
                                @foreach($questions as $key=>$quest)
                                    <div class="tab-pane {{ ($key === 0?"active":"")}} portlet light bordered "
                                         id="tab{{$key}}">
                                        <form action="{{route('userSurvey')}}"
                                              method="post"
                                              role="form"
                                              class="form portlet-body stepform">
                                            {{csrf_field()}}
                                            <input type="hidden" name="step" value="{{$quest[0]->step}}">
                                            <input type="hidden" name="final_step" value="1">
                                            <input type="hidden" name="survey_id" value="{{$survey->id}}">
                                            <div class="form-group form-md-radios ">
                                                @foreach($quest as $q)
                                                    <label style="text-transform:capitalize;"
                                                           for="{{$q->id}}">{{$q->body}}</label>
                                                    <div class="md-radio-inline form-group col-lg-offset-1 ">
                                                        @foreach($q->answers as $answer)
                                                            <div class="form-group" style="text-indent: 2em;">
                                                                <div class="md-radio">
                                                                    <input type="radio" id="{{$answer->id}}"
                                                                           name="answers[{{$q->id}}]"
                                                                           class="md-radiobtn" value="{{$answer->id}}">
                                                                    <label for="{{$answer->id}}">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span> {{$answer->answer}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                            @endforeach
                                            <!-- Submit Field -->
                                                <div class="form-group col-sm-12">
                                                    <div class="form-actions">
                                                        <div class="row  col-md-offset-0">
                                                            {!! Form::submit($quest==end($questions)?'finish':'Continue', ['class' => 'btn green step-submit btn-outline']) !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                @endforeach


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
<script>
    FN_App = {};
    FN_App.steps = {{count($questions)}};
</script>

<script src="/js/jquery.form.js"></script>
<script src="/assets/survey_user.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/form-wizard.js"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/timeline.min.js" type="text/javascript"></script>


<script src="/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>


<script src="../assets/pages/scripts/profile.min.js" type="text/javascript"></script>
@endpush
