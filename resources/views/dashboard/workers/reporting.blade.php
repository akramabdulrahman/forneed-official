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
                    <a href="Beneficiaries_index.html">Social Workers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Reporting</span>

                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Social Workers
            <small>Reporting</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row" style="margin-bottom:15px">
            <div class="col-md-6">
                <form class="form-inline">
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">Please select export file type</option>
                            <option>Word</option>
                            <option>Excel</option>
                            <option>Pdf</option>
                            <option>Html</option>
                        </select>
                    </div>

                    <button type="submit" class="btn blue">Export</button>
                </form>
            </div>

        </div>

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
                            <label> Chart Type : </label>
                            <select class="form-control" id="chart-type">
                                <option value="chart">Chart</option>
                                <option value="table">Table</option>
                            </select>
                        </div>



                        <div class="table draw-data" style="display:none">
                            <div class="form-group">
                                <label>Attribute List for X : </label>
                                <select multiple="" class="form-control">
                                    <option>Attribute 1</option>
                                    <option>Attribute 2</option>
                                    <option>Attribute 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Attribute List for Y : </label>
                                <select class="form-control">
                                    <option>Attribute 1</option>
                                    <option>Attribute 2</option>
                                    <option>Attribute 3</option>
                                </select>
                            </div>
                            <div class="margin-top-10">
                                <a href="javascript:;" class="btn blue" id="draw-table">Draw</a>
                            </div>
                        </div>
                        <div class="chart draw-data">
                            <div class="form-group">
                                <label>Attribute List for X : </label>
                                <select class="form-control">
                                    <option>Attribute 1</option>
                                    <option>Attribute 2</option>
                                    <option>Attribute 3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Attribute List for Y : </label>
                                <select class="form-control">
                                    <option>Attribute 1</option>
                                    <option>Attribute 2</option>
                                    <option>Attribute 3</option>
                                </select>
                            </div>
                            <div class="margin-top-10">
                                <a href="javascript:;" class="btn blue" id="draw-chart">Draw</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="i icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Chart </span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div  class="chart draw_chart"> </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>


    </div>

@stop