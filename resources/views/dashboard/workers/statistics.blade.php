@extends('dashboard.layout.dashboard')

@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href={{route('Dashboard.landing')}}>Social Workers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Statistics</span>

                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Social Workers

            <small>Statistics</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Attributes</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="form-group">
                            <label>Attribute List</label>
                            <div class="input-group">
                                <div class="icheck-list">
                                    <label>
                                        <input type="radio" name="radio1" class="icheck "> Attribute 1 </label>
                                    <label>
                                        <input type="radio" name="radio1" class="icheck "> Attribute 2 </label>
                                    <label>
                                        <input type="radio" name="radio1" class="icheck "> Attribute 3 </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Pio Chart based on <span
                                        class="attribute_name">(attribute Name)</span></span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="chart draw_chart">
                            <h4 class="font-black-soft bold uppercase" style="text-align:center;line-height:115px">
                                Choose Specific Attribute To Draw Pie Chart</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>


    </div>

@stop
