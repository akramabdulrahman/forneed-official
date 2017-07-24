@extends('endusers.layout.dashboard')
@section('menu')
    @include('endusers.organizations.menu')
@stop

@push('page_style_plugins')
<link href="{{asset('/assets/layouts/layout2/css/layout.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endpush
@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

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
        <!-- BEGIN DASHBOARD STATS 1-->

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349">0</span>
                        </div>
                        <div class="desc"> Beneficiaries </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12">0</span></div>
                        <div class="desc"> Organization</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549">0</span>
                        </div>
                        <div class="desc"> Active Projects </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="89"></span></div>
                        <div class="desc">Surveys</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="100"></span></div>
                        <div class="desc">Social Workers</div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-cursor font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Sectors</span>
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


                            <div class="margin-bottom-20 visible-sm"></div>
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
        <div class="clearfix"></div>


    </div>
@stop

@push('page_script_plugins')
<script src="{{asset('dashboard/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}"
        type="text/javascript"></script>
<script src="http://forneeds-frontend.dev/dashboard/assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>


@endpush