@extends('endusers.layout.dashboard_no_sidebar')
@push('page_style_plugins')
<link href="{{asset('/assets/bower_components/gridster/dist/jquery.gridster.css')}}" rel="stylesheet">
<link href="{{asset('/assets/global/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">
<link href="{{asset('/assets/layouts/layout2/css/layout.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
<style>
    /*******************************
 * MODAL AS LEFT/RIGHT SIDEBAR
 * Add "left" or "right" in modal parent div, after class="modal".
 * Get free snippets on bootpen.com
 *******************************/
    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 320px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .modal.left .modal-body,
    .modal.right .modal-body {
        padding: 15px 15px 80px;
    }

    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: -320px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #FAFAFA;
    }

    /* ----- v CAN BE DELETED v ----- */
    body {
        background-color: #78909C;
    }

    .demo {
        padding-top: 60px;
        padding-bottom: 110px;
    }

    .btn-demo {
        margin: 15px;
        padding: 10px 15px;
        border-radius: 0;
        font-size: 16px;
        background-color: #FFFFFF;
    }

    .btn-demo:focus {
        outline: 0;
    }

    .demo-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 15px;
        background-color: #212121;
        text-align: center;
    }

    .demo-footer > a {
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        color: #fff;
    }
</style>
<script src="{{('https://static.fusioncharts.com/code/latest/fusioncharts.js')}}" type="text/javascript"></script>
<script src="{{('https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js')}}"
        type="text/javascript"></script>

@endpush
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">


        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN CONTENT HEADER -->
        <!-- END CONTENT HEADER -->
        <!-- END CARDS -->
        <!-- BEGIN TEXT & VIDEO -->

        <?php $sp = $auth_user->serviceProvider()->first(); ?>
        <div id="print-target" class="row margin-bottom-40">
            <div class="col-lg-12">
                <div class="portlet light about-text" style="height: auto;padding-bottom: 15px !important;">
                    <h3 class="page-title"> About For Needs
                        <small> Forneeds.ps is a start-up company lead by team of entrepreneurs, funded by Taawon
                            organization. It is a decision support Information system that provides data gathering,
                            analysis, reports generation and visualization services for local and international
                            organization.
                        </small>
                    </h3>
                    <p class="margin-top-20">
                    </p>

                </div>

            </div>

            <div class="col-lg-3">
                <div class="portlet light about-text" style="height: auto;padding-bottom: 15px !important;">
                    <h4 style="font-size:18px">
                        <i class="fa  icon-info"></i> About Gaza-Strip</h4>
                    <p class="margin-top-20" style="text-align: justify;"> The Gaza Strip is home to a population of
                        approximately 1.9 million people, including 1.3 million Palestine refugees.

                        For the last decade, the socioeconomic situation in Gaza has been in steady decline. The
                        blockade on land, air and sea imposed by Israel following the Hamas takeover of the Gaza Strip
                        in 2007, entered its 10th year in June 2016 and continues to have a devastating effect as access
                        to markets and people’s movement to and from the Gaza Strip remain severely restricted.

                        Years of conflict and blockade have left 80 per cent of the population dependent on
                        international assistance. The economy and its capacity to create jobs have been devastated,
                        resulting in the impoverishment and de-development of a highly skilled and well-educated
                        society. The average unemployment rate is well over 41 per cent – one of the highest in the
                        world, according to the World Bank. </p>

                </div>
                <div class="portlet light about-text" style="height: auto;padding-bottom: 15px !important;">
                    <h4 style="font-size:18px">
                        <i class="fa  icon-info"></i> About Organization</h4>
                    <p class="margin-top-20"> {{$sp->mission_statement}} </p>

                </div>
                <div class="portlet light about-text" style="height: auto;padding-bottom: 15px !important;">
                    <h4 style="font-size:18px">
                        <i class="fa fa-check icon-info"></i> About Project</h4>

                    <p class="margin-top-20"> {{$project->name}} </p>
                    <p class="margin-top-20"> {{$project->description}}. </p>

                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-red bold uppercase"><i class="fa fa-pie-chart"
                                                                                             aria-hidden="true"></i>&nbsp;General indicator by sector</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>
                                        <div class="easy-pie-chart">
                                            <div class="number visits" data-percent="51.5">
                                                <span>-51.5</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span class="capitalize">protection</span>

                                        </div>

                                    </div>
                                    <div class="margin-bottom-10 visible-sm"></div>

                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>

                                        <div class="easy-pie-chart">
                                            <div class="number transactions" data-percent="52.5">
                                                <span>-52.5</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span class="capitalize">Food security</span>
                                        </div>
                                    </div>


                                    <div class="margin-bottom-10 visible-sm"></div>
                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>

                                        <div class="easy-pie-chart">
                                            <div class="number bounce" data-percent="47">
                                                <span>-47</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span class="capitalize">Shelter</span>
                                        </div>
                                    </div>
                                    <div class="margin-bottom-10 visible-sm"></div>
                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>

                                        <div class="easy-pie-chart">
                                            <div class="number bounce" data-percent="65.5">
                                                <span>-65.4</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span clas="capitalize">WASH </span>
                                        </div>
                                    </div>
                                    <div class="margin-bottom-10 visible-sm"></div>
                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>

                                        <div class="easy-pie-chart">
                                            <div class="number visits" data-percent="23.1">
                                                <span>-23.1</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span clas="capitalize">Education</span>
                                        </div>
                                    </div>
                                    <div class="margin-bottom-10 visible-sm"></div>
                                    <div class="col-md-2">
                                        <span class="capitalize">people in need</span>

                                        <div class="easy-pie-chart">
                                            <div class="number transactions" data-percent="57.9">
                                                <span>-57.9</span>%
                                                <canvas height="75" width="75"></canvas>
                                            </div>
                                            <span clas="capitalize">health and Nutrition</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @foreach($project->surveys as $survey)
                        <div class="col-lg-12">
                            <div class="portlet light tasks-widget bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-red bold uppercase"> <i
                                                    class="fa fa-check icon-info" aria-hidden="true"></i>
                                            &nbsp;About {{$survey->subject}} Survey
                                        </span>
                                    </div>
                                    <div class="pull-right"
                                         style="color:#838FA1">{{$survey->starts_at->format('d/m/Y')}}
                                        - {{$survey->expires_at->format('d/m/Y')}} <i
                                                class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <div class="pull-right" style="color:#838FA1">
                                        @include('endusers.organizations.targets_report')
                                    </div>

                                </div>
                                <div class="portlet-body">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <div class=" row form-group">
                                               {!! Form::label('sector_id', 'Theme:') !!}
                                               {{Form::select('theme',$libs,'chartjs_pie',['class'=>'theme-input select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default",'data-survey'=>$survey->id]) }}
                                               <input type="hidden" name="multi" value="true">
                                           </div>
                                           <div class="row">
                                               @foreach($survey->questions as $question)
                                                   <div class="col-md-6">
                                                       <div class="portlet light bordered">
                                                           <div class="portlet-title">
                                                               <div class="caption">
                                                                   <i class="icon-bar-chart font-green-haze"></i>
                                                                   <span class="caption-subject bold uppercase font-green-haze" style="font-size:.8em;">   {{$question->body}}</span>
                                                                   <span class="caption-helper"> Answers Distribution</span>
                                                                   <div class="devider"></div>
                                                               </div>

                                                           </div>
                                                           <div class="portlet-body">
                                                               <div
                                                                       class="questions_stat_chart_canvas  chart draw_chart">
                                                                   <div data-question-id="{{$question->id}}"
                                                                        class="questions_stat_chart_canvas survey-{{$survey->id}} chart draw_chart"></div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>

                                               @endforeach

                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                           <div class="mt-list-container list-news">
                                               <script>post_render_charts = []</script>
                                               @foreach($savedCharts[$survey->id] as $chart)
                                                   <?php $title =
                                                       explode(',',
                                                           str_replace('Citizens that satisfy :',
                                                               '',
                                                               $chart->title))?>

                                                   <div class="col-md-12">
                                                       <div class="portlet light bordered">
                                                           <div class="portlet-title">
                                                               <div class="caption">
                                                                   <i class="icon-bar-chart font-green-haze"></i>
                                                                   {{--<span class="caption-subject bold uppercase font-green-haze" style="font-size:.8em;">  {{explode(':',str_replace(['(',')'],'',$title[0]))[0]}}</span>--}}
                                                                   {{--<span class="caption-helper"> {{explode(':',str_replace(['(',')'],'',$title[0]))[1]}}</span>--}}
                                                                   <div class="devider"></div>
                                                                   {{--<span class="caption-subject bold uppercase font-green-haze">  {{explode(':',str_replace(['(',')'],'',$title[1]))[0]}}</span>--}}
                                                                   {{--<span class="caption-helper"> {{explode(':',str_replace(['(',')'],'',$title[1]))[1]}}</span>--}}
                                                               </div>
                                                           </div>
                                                           <div class="portlet-body">
                                                               <div
                                                                       class="questions_stat_chart_canvas  chart draw_chart">
                                                                   @if($chart->library == 'fusioncharts')
                                                                       {!! $chart->render() !!}
                                                                   @else
                                                                       <script class="post-render"
                                                                               type="text/html">{!! $chart->render() !!}</script>
                                                                   @endif
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>                                                    @endforeach

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
        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
            <a data-toggle="modal" tooltip="add component"
               class="btn-floating btn-large red rounded modal-toggle-action" data-toggle="modal"
               data-target="#myModal">
                <i class="fa fa-pie-chart"></i>
            </a>
            <ul class="fab-menu-inner">
                <li>
                    <a data-trigger="hover" data-toggle="popover" data-placement="left" data-content="print"
                       class="btn-floating print-btn btn-large blue rounded modal-toggle-action" data-toggle="modal"
                       data-target="#myModal">
                        <i class="fa fa-print"></i>
                    </a>
                </li>
                <li>
                    <a data-trigger="hover" data-toggle="popover" data-placement="left" data-content="save"
                       class="btn-floating save-btn btn-large orange rounded modal-toggle-action" data-toggle="modal"
                       data-target="#myModal">
                        <i class="fa fa-save"></i>
                    </a>
                </li>
            </ul>

        </div>
        <!-- END TEXT & VIDEO -->
        <!-- BEGIN MEMBERS SUCCESS STORIES -->

        <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Right Sidebar</h4>
                    </div>

                    <div class="modal-body">
                        <div class="dd " id="nestable_list_1">
                            <ol class="dd-list">
                                @foreach($project->surveys as $survey)


                                    <li class="dd-item dd-collapsed" data-id="{{$survey->id}}">
                                        <div class="dd-handle">
                                        <span class="capitalize">
                                            {{$survey->subject}}
                                        </span>
                                        </div>
                                        <ol class="dd-list">
                                            @foreach($survey->charts() as $key=>$chart)
                                                <?php $title =
                                                    explode(',',
                                                        str_replace('Citizens that satisfy :',
                                                            '',
                                                            $chart->title))?>
                                                <li class="dd-item dd-collapsed" data-id="{{$key}}">
                                                    <div class="dd-handle">
                                                            <span class="capitalize">
                                                                 chart #{{$key}}
                                                           </span>
                                                    </div>
                                                    <ol class="dd-list">
                                                        <li class="dd-item " data-id="{{$survey->id+$key}}">
                                                            <div class="dd-handle">
                                                            <span class="capitalize">
                                                                 {{explode(':',str_replace(['(',')'],'',$title[0]))[0]}}
                                                           </span>
                                                            </div>
                                                        </li>
                                                        <li class="dd-item" data-id="{{$survey->id+$key}}">
                                                            <div class="dd-handle">
                                                            <span class="capitalize">
                                                                {{explode(':',str_replace(['(',')'],'',$title[1]))[0]}}
                                                           </span>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </li>

                                            @endforeach
                                        </ol>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    </div>
    <div id="print-assets" class="hidden">
        <canvas id="canvas"></canvas>
        <div id="can_f"></div>
    </div>
    <!-- END CONTENT BODY -->
@endsection

@push('page_script_plugins')

<script src="{{asset('/assets/bower_components/gridster/dist/jquery.gridster.js')}}"></script>
<script src="{{asset('/assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
<script src="{{asset('dashboard/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('dashboard/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/html2canvas.js')}}"></script>
<script src="{{asset('/assets/print.elem.js')}}"></script>
{!! Charts::assets() !!}

<script>
    $(function () {


        $csrf = "{{csrf_token()}}"

        grid = $(".gridster ol").gridster({
            widget_margins: [0, 0],
            widget_base_dimensions: [242, 50]
        });

        $('.post-render').each(function () {
            $(this).parent().html($(this).html())
        })
        $('#myModal').on('show.bs.modal', function (e) {
            $(this).css('margin-right', '-1000px')
        });
        $('#myModal').on('shown.bs.modal', function (e) {
            $('.modal-backdrop').removeClass("modal-backdrop");
        });
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
        $('.questions_stat_chart_canvas').each(function () {
            var self = $(this);
            if ($(this).data('questionId'))
                $.get("{{route('endusers.org.projects.surveys.questions.chart','val')}}".replace('val', $(this).data('questionId')), function (data) {
                    self.html(data);
                });
        });

        $('.print-btn').on('click',function(){
            $('.theme-input').addClass('hidden');
            PrintElem('print-target')
            setTimeout(function(){
                $('.theme-input').removeClass('hidden');
            },0)

        })

        $('.save-btn').on('click',function(){
            $('.theme-input').addClass('hidden');
            print_voucher('print-target')
            setTimeout(function(){
                $('.theme-input').removeClass('hidden');
            },0)

        })
        $('.theme-input').on('change', function () {
            var survey_id = $(this).data('survey'),
                val = $(this).val();
            $('.questions_stat_chart_canvas.survey-' + survey_id).each(function () {
                var self = $(this);
                if ($(this).data('questionId'))
                    $.post("{{route('endusers.org.projects.surveys.questions.chart.withtheme','val')}}".replace('val', $(this).data('questionId')), {
                        theme: val,
                        _token: $csrf
                    }, function (data) {
                        self.html(data);
                    });
            });
        });

    })
</script>

@endpush