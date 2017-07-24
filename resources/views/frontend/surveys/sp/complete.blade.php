<input type="hidden" id="sp_id" value="{{$sp->id}}">

<div class="modal fade in" id="SurveyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div id="form_wizard_1" class="modal-content  form-wizard">

            <div class="modal-body form-body">
                <ul class="nav nav-pills tabs nav-justified steps">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab" class="step first" aria-expanded="true">
                            <span class="number"> 1 </span>
                            <span class="desc">
                  <i class="fa fa-check"></i> Survey Details
                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" class="step">
                            <span class="number"> 2 </span>
                            <span class="desc">
                                            <i class="fa fa-check"></i> Add Questions</span>
                        </a>
                    </li>

                    <li>
                        <a href="#tab3" data-toggle="tab" class="step last">
                            <a href="#tab3" data-toggle="tab" class="step last">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                                                <i class="fa fa-check"></i> Targeting Mechanism </span>
                            </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="alert alert-danger display-none" style="display: none;">
                        <button class="close" data-dismiss="alert"></button>
                        You have some form errors. Please check below.
                    </div>
                    <div class="alert alert-success display-none" style="display: none;">
                        <button class="close" data-dismiss="alert"></button>
                        Your form validation is successful!
                    </div>
                    <div class="tab-pane active" id="tab1">
                        @include("profiles.surveys.sp.wizz.tab1")
                    </div>
                    <div class="tab-pane" id="tab2">
                        @include("profiles.surveys.sp.wizz.tab2")

                    </div>

                    <div class="tab-pane " id="tab3">

                        @include("profiles.surveys.sp.wizz.tab3")

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                {{--      <a href="javascript:;" class="btn default button-previous disabled"
                                         style="display: none;">
                                          <i class="fa fa-angle-left"></i> Back </a>

                                      <a href="javascript:;" class="btn green button-submit" style="display: none;">
                                          Submit
                                          <i class="fa fa-check"></i>
                                      </a>--}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


@push('styles')
<link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>

<script src="/assets/survey_widget.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/form-wizard.js"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>


<script src="/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
@endpush