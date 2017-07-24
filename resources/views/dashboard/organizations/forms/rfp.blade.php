@extends('dashboard.layout.dashboard')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href={{route('Dashboard.landing')}}>Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="Providers-Database.html">Services Providers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="Organizations.html"><span>Organizations</span></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Request For Payment</span>
                </li>
            </ul>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Organizations
            <small>Request For Payment</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6">
                <form action="#">


                    <div class="form-group">
                        <label class="control-label">Organization</label>
                        {!! Form::select('survey_id',$organizations, null, ['class' => 'form-control','id'=>'sp-drop-down','placeholder'=>'Please Choose An organization']) !!}

                    </div>
                    <div class="form-group">
                        <label class="control-label">Project</label>
                        <!-- Project Id Field -->
                        {!! Form::select('project_id',array(), null, ['class' => 'form-control','id'=>'projects-drop-down','placeholder'=>'Please Choose A project']) !!}

                    </div>
                    <div class="form-group">
                        <label class="control-label">Survay</label>
                        {!! Form::select('survey_id',array(), null, ['class' => 'form-control','id'=>'surveys-drop-down','placeholder'=>'Please Choose A survey']) !!}

                    </div>

                    <div class="form-group">
                        <label class="control-label"># of Social Workers</label>
                        <input type="input" class="form-control" readOnly value="0" placeholder="# of Social Workers"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label"># of Beneficiaries </label>
                        <input type="input" class="form-control" readOnly value="0" placeholder="# of Beneficiaries"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Target Area </label>
                        <input type="input" class="form-control" readOnly value="0" placeholder="# of Beneficiaries"/>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cost</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="input" class="form-control" placeholder="Lump sum"/>
                            </div>
                            <div class="col-md-1"><i class="fa"> + </i></div>
                            <div class="col-md-3">
                                <input type="input" class="form-control" placeholder="Consultation"/>
                            </div>
                            <div class="col-md-1"><i class="fa"> = </i></div>
                            <div class="col-md-4">
                                <input type="input" class="form-control" placeholder="Total No. IN(USD)"/>
                            </div>
                        </div>
                    </div>

                    <div class="margin-top-10">
                        <a href="javascript:;" class="btn blue"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                            Print (RFP)</a>
                        <a href="{{route('Dashboard.org.verify.list','org')}}" class="btn default"> Cancel </a>

                    </div>
                </form>
            </div>
        </div>


        <div class="clearfix"></div>


    </div>
    <!-- END CONTENT BODY -->

@stop
@push('page_script_plugins')
<script>
    $(function () {
        $(document).on('change', '#sp-drop-down', function (evt) {
            console.log($(this).val());
            $.get(document.location.origin + "/listings/projects/" + $(this).val(),
                null,
                function (data) {
                    var model = $('#projects-drop-down');
                    model.empty();
                    model.append("<option value='' selected='selected' disabled='disabled'>Please select a project</option>");
                    $.each(data, function (index, element) {
                        model.append("<option value='" + element.id + "'>" + element.name + "</option>");
                    });
                });
        });
        $(document).on('change', '#projects-drop-down', function (evt) {
            console.log($(this).val());
            $.get(document.location.origin + "/listings/surveys/" + $(this).val(),
                null,
                function (data) {
                    var model = $('#surveys-drop-down');
                    model.empty();
                    model.append("<option value='' selected='selected' disabled='disabled'>Please select a survey</option>");
                    $.each(data, function (index, element) {
                        model.append("<option value='" + element.id + "'>" + element.subject + "</option>");
                    });
                });
        });
    });
</script>
@endpush