@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
<link rel="stylesheet" href="{{asset('/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
<style>
    #dataTableBuilder_filter{
        display: inline-block;
        float: right;
    }
    #dataTableBuilder_length{
        display: inline-block;
        line-height: 1.42857;
    }
</style>

@endpush
@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('Dashboard.landing')}}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Accounts</span>
                </li>
            </ul>

            <div class="page-toolbar">
                <div class="pull-right">
                    <a href="{{route('Dashboard.admin.crud.create')}}" class="btn blue"><i class="fa fa-plus" aria-hidden="true"></i> Add New Account</a>
                </div>
            </div>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Accounts
            <small>Manage</small>
        </h3>
        <!-- END PAGE TITLE-->
    @include('flash::message')

        <!-- END PAGE HEADER-->
        <div class="portlet light borderless">

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    {!! $dataTable->table(['width' => '100%','class'=>'table-striped'],true) !!}
                </div>
            </div>
        </div>




        <div class="clearfix"></div>


    </div>
@stop

@push('page_script_plugins')

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
{!! $dataTable->scripts() !!}

@endpush