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
                    <a href="{{route('endusers.org.index')}}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>

                <li>
                    <a href="{{route('endusers.org.projects.list')}}"><span>Projects</span></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{route('endusers.org.projects.list')}}"><span>Survays</span></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{$survey->subject}}</span>
                </li>
            </ul>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Survays
            <small>{{$survey->subject}}</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                            <span class="caption-subject font-red sbold uppercase">({{$survey->subject}}) details</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div style="padding:5px"><i>Survay Name :</i> {{$survey->subject}} </div>
                        <div style="padding:5px"><i>Survay Objective :</i> {{$survey->description}}    </div>
                        <div style="padding:5px"><i>Survay Target Criteria :</i>
                            @foreach($survey->project->targets_string() as $key=>$target)
                                ({{$key}} : {{$target}}) <br>
                            @endforeach </div>
                        <div style="padding:5px"><i>Survay Period :</i> From {{$survey->starts_at->format('m/d/Y')}}
                            To {{$survey->expires_at->format('m/d/Y')}} </div>
                        <div style="padding:5px"><i>Survay Social Workers :</i> {{$survey->SocialWorkers_string()}}
                        </div>
                        <div style="padding:5px"><i class="pull-left">Survay Progress :</i>
                            <span class="easy-pie-chart">
															<div class="number transactions pull-left" data-percent="{{ceil($survey->progress)}}"
                                                                 style="display:inline-block;margin-left:10px">
																<span>+{{ceil($survey->progress)}}</span>% </div>
														</span>
                            <div style="clear:both"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="">
                            <div class="pull-left"><h4 class="font-red sbold uppercase"><i class="fa fa-list"
                                                                                           aria-hidden="true"></i>
                                    Survay Questions list</h4></div>
                            <div class="pull-right">
                                <a href="{{route('endusers.org.projects.surveys.questions.create',$survey->id)}}" class="btn blue"><i class="fa fa-plus"
                                                                                aria-hidden="true"></i> Add New Question</a>
                            </div>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="MainMenu">
                            <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
                                <div class="list-group panel">
                                    @foreach($survey->questions as $question)
                                        <a href="javascript:;" style="background-color:#DFDFDF"
                                           href="#question_{{$question->id}}"
                                           class="list-group-item"><i class="fa fa-minus" aria-hidden="true"></i> &nbsp;
                                            {{$question->body}}

                                        </a>
                                        <div class="" id="question_{{$question->id}}">
                                            <div class="list-group-item" data-toggle="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ol>
                                                            @foreach($question->answers as $answer)
                                                                <li>{{$answer->answer}}</li>
                                                            @endforeach
                                                        </ol>

                                                    </div>
                                                    <div class="col-md-6">
                                                        @include('endusers.organizations.chart',['question'=>$question])
                                                        <div class="page-toolbar">
                                                            <div class="btn-group pull-right">
                                                                <button type="button"
                                                                        class="btn cyan btn-sm btn-outline dropdown-toggle"
                                                                        data-toggle="dropdown"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-right" role="menu">
                                                                    <li>
                                                                        <a href="{{route('endusers.org.projects.surveys.questions.edit',$question->id)}}">
                                                                            <i class="fa fa-pencil-square-o"
                                                                               aria-hidden="true"></i> Edit Question</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{route('endusers.org.projects.surveys.questions.delete',$question->id)}}">
                                                                            <i class="fa fa-trash-o"
                                                                               aria-hidden="true"></i>
                                                                            Delete Question</a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>


    </div>


@stop

@push('page_script_plugins')

{!! Charts::assets() !!}

<script>
    $(document).ready(function () {
        $charts = $('.chart.draw_chart');
        $charts.each(function (i, v) {
            console.log($(this).data())
            $(this).html(' <center>\r\ <div class=\"preloader-wrapper big active\" style=\"margin-top: {{ ($chart->settings()['height'] / 2) - 32 }}px;\">\r\n                                    <div class=\"spinner-layer spinner-blue-only\">\r\n                                        <div class=\"circle-clipper left\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                        <div class=\"gap-patch\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                        <div class=\"circle-clipper right\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                    <\/div>\r\n                                <\/div>\r\n                            <\/center>');
            var self = $(this);
            $.get("{{route('endusers.org.projects.surveys.questions.chart','val')}}".replace('val',$(this).data('questionId')), function (data) {
                self.html(data);
                drawPieChart()

            });
        });

    })

</script>
@endpush