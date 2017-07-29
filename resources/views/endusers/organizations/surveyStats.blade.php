@extends('endusers.layout.dashboard')
@section('menu')
    @include('endusers.organizations.menu')
@stop

@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="providers_index.html">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>

                <li>
                    <span>Statistics</span>
                </li>

            </ul>

            <div class="page-toolbar">
                <div class="pull-right">
                    <a id="report-generate" href="{{route('endusers.org.projects.generate.report','val')}}"
                       class="btn red hidden"><i class="fa fa-file-image-o" aria-hidden="true"></i>
                        Generate Report</a>
                    <a href="#" class="btn blue"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                </div>
            </div>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Statistics
            <small>Survays</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                            <span class="caption-subject font-red sbold uppercase">Choose Survay</span>
                        </div>
                        <div class="pull-right">
                            <a class="btn red hidden" data-toggle="modal" href="#basic" id="question_stats_toggle"><i
                                        class="fa fa-bar-chart"
                                        aria-hidden="true"></i>&nbsp;Statistics
                                For  Question</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('project_select', 'Project:') !!}
                                        {{ Form::select('project_select',[null => 'please select project']+ $projects->toArray() ,array(),['class'=>'selectpicker form-control','data-style'=>"btn-default",'id'=>'project_select']) }}
                                    </div>
                                </div>
                                <div class="form-group  hidden" id="survey_wrapper">
                                    <div class="form-group col-sm-12">
                                        {!! Form::label('survey_select', 'Survey:') !!}
                                        {{ Form::select('survey_select', array() ,array(),['class'=>'selectpicker form-control','data-style'=>"btn-default",'id'=>'survey_select']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="empty_survey text-center centered">
                This survey has no Questions
            </h2>
            <div class="col-md-12 hidden" id="questions_wrapper">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="">
                            <div class="pull-left"><h4 class="font-red sbold uppercase"><i class="fa fa-list"
                                                                                           aria-hidden="true"></i>
                                    Survay Questions list</h4></div>

                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="MainMenu">
                        {{-- scroller   --}}
                            <div class="" style="" data-always-visible="1" data-rail-visible1="1">
                                <div class="list-group panel" id="questions">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="question_template_holder" class="hidden">
            <div class="row question">
                <a href="javascript:;" style="background-color:#DFDFDF" href="" class="list-group-item toggle-holder"><i
                            class="fa fa-minus" aria-hidden="true"></i> &nbsp; Question
                </a>
                <div class="data-holder">
                    <div class="list-group-item toggle-target" data-toggle="">
                        <div class="row">
                            <div class="col-md-6 ">
                                <ol class="answers-list">

                                </ol>

                            </div>
                            <div class="col-md-6">
                                <div class="chart draw-canvas " ></div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="modal fade bs-modal-lg" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> <span
                                id="survey_label"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Questions</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="row" id="question_stats">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="i icon-layers font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase"> Chart </span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div id="questions_stat_chart_canvas" class="chart draw_chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@stop

@push('page_script_plugins')
{!! Charts::assets() !!}

<script>
    $questions = [];
    $('.empty_survey').addClass('hidden');
    $('#project_select').on('change', function (e) {
        var project_id = $(this).val(),
            generate_href = $('#report-generate').attr('href');


        //  console.log(generate_href,project_id,generate_href.replace('val',project_id))
        //  console.log($('#report-generate').attr('href').replace('val', $(this).val()))

        if (project_id) {
            $('#report-generate').attr('href', generate_href.replace('val', project_id));
            $('#report-generate').removeClass('hidden')
        }
        $.get(window.location.origin + "/listings/surveys/val".replace('val', project_id),
            function (data) {

                $options = data.map(function (v) {
                    $questions[v.id] = v;
                    $opt = document.createElement('option');
                    $opt.value = v.id;
                    $opt.text = v.subject;

                    return $opt;
                });
                console.log($options.join(''))
                $('#survey_select').html($options)
                $('#survey_select').selectpicker('destroy');
                $('#survey_select').selectpicker({
                    color: 'blue'
                });
                $('#survey_select').change();
                $('#survey_wrapper').removeClass('hidden');

            })

    });
    $('#project_select').change();
    $('#survey_wrapper').on('change', '#survey_select', function () {
        $('.empty_survey').removeClass('hidden');
        $template = $('#question_template_holder');


        $list = ($(this).val() in $questions) ? $questions[$(this).val()].questions : null;
        $('#questions').html('');
        if ($list != null) {
            $('#question_stats_toggle').attr('survey-id', $(this).val());
            $('#survey_label').text($questions[$(this).val()].subject)
            $question_list = $list.map(function (v) {
                var $question = $($template).find('.question').clone(),
                    $link = $($question).find('.toggle-holder'),
                    $data_container = $($question).find('.data-holder').find('.toggle-target');

                $link.html('<i class="fa fa-minus" aria-hidden="true"></i> &nbsp;' + v.body);
                $link.attr('data-question-id', v.id);
                $link.attr('href', '#question_' + v.id);
                $data_container.attr('id', 'question_' + v.id);
                $data_container.data('toggle', 'question_' + v.id)
                $data_container.find('ol.answers-list').html(v.answers.map(function (answer) {
                    return '<li>' + answer.answer + '</li>';
                }));
                $data_container.find('.chart.draw-canvas').attr('data-question-id', v.id);

                return $question;
            });
            if ($question_list.length !== 0) {
                $('#questions_wrapper').removeClass('hidden');
                $('.empty_survey').addClass('hidden');
                $('#questions').append($question_list);
                $('#question_stats_toggle').removeClass('hidden');
            }

            $charts = $('.chart.draw-canvas');
            if ($question_list.length > 0)
                $charts.each(function (i, v) {
                    var self = $(this);
                    $.get("{{route('endusers.org.projects.surveys.questions.chart','val')}}".replace('val', $(this).data('questionId')), function (data) {
                        self.html(data);
                        drawPieChart()

                    });
                });
            console.log($charts)


        }

    });

    $('#question_stats_toggle').on('click', function () {
        var $survey_id = $(this).attr('survey-id');
        $.get("{{route('endusers.org.projects.surveys.questions.relationChart','val')}}".replace('val', $survey_id), function (data) {
            $('#question_stats').html(data);
            $('.selectpicker').selectpicker({
                color: 'blue'
            });
            //
            $('#first_ans').on('change', function (event) {
                $('#second_ans optgroup').prop('disabled', function (i, v) {
                    return v ? !v : v;
                });
                console.log($(this).val()[0], 'first answer val')
                console.log($('#opt_question_' + $(this).val()[0].split('_')[0]).prop('disabled', true).prop('disabled'))

                $('#second_ans option').prop('selected', function () {
                    return this.defaultSelected;
                });

                $('#second_ans').selectpicker('destroy');
                $('#second_ans').selectpicker({
                    color: 'blue'
                });
                $('#second_question_wrapper').removeClass('hidden');

            });
            $('#second_ans').on('change', function (event) {
                var dataSerialized_arr = $('#questions_stats_form').serializeArray();
                dataSerialized_arr.map(function (v) {
                    if (v.name == 'first_ans') {
                        v.value = v.value.split('_')[1]
                    }
                })
                $.get("{{route('endusers.org.projects.surveys.questions.visualizeRelation')}}", $.param(dataSerialized_arr), function (data) {
                    $('#questions_stat_chart_canvas').html(data);
                });
                $('#question_stat').removeClass('hidden');
            });
            $('#question_stat').on('click', function (event) {
                var dataSerialized_arr = $('#questions_stats_form').serializeArray();
                dataSerialized_arr.map(function (v) {
                    if (v.name == 'first_ans') {
                        v.value = v.value.split('_')[1]
                    }
                })
                $.get("{{route('endusers.org.projects.surveys.questions.visualizeRelation')}}", $.param(dataSerialized_arr), function (data) {
                    $('#questions_stat_chart_canvas').html(data);
                    $('#question_stat_save').removeClass('hidden');
                });

                $('#question_stat_save').on('click', function (event) {
                    var dataSerialized_arr = $('#questions_stats_form').serializeArray();
                    dataSerialized_arr.map(function (v) {
                        if (v.name == 'first_ans') {
                            v.value = v.value.split('_')[1]
                        }
                    })
                    $.post("{{route('Dashboard.store.question.chart')}}", $.param(dataSerialized_arr), function (data) {
                        console.log(data);
                    });
                });
            });
        })
    });


</script>
@endpush