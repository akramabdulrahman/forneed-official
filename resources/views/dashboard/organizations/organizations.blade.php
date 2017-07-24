@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
<link rel="stylesheet" href="{{asset('/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">

<style>
    #dataTableBuilder_filter {
        display: inline-block;
        float: right;
    }

    #dataTableBuilder_length {
        display: inline-block;
        line-height: 1.42857;
    }

    .dt-buttons {
        right: 1%;
        position: absolute !important;
        top: 1%;
    }
</style>

@endpush
@section('content')
    <!-- BEGIN CONTENT BODY -->
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
                    <a href="{{route('Dashboard.org.crud.list')}}">Service Providers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Organizations</span>

                </li>
            </ul>

            <div class="page-toolbar">
                <div class="pull-right">
                    <a href="{{route('Dashboard.org.payment')}}" class="btn blue">
                        <i class="fa fa-hand-o-up" aria-hidden="true"></i>
                        Request for payment</a>
                </div>
            </div>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <h3 class="page-title"> Service Providers
            <small>Organizations</small>
        </h3>
        <!-- END PAGE TITLE-->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_org" data-toggle="tab"
                           data-location="{{route('Dashboard.org.verify.list','org')}}"
                           class="model"> New Organizations </a>
                    </li>
                    <li>
                        <a href="#tab_project" data-toggle="tab"
                           data-location="{{route('Dashboard.org.verify.list','project')}}"
                           class="model"> New Projects </a>
                    </li>
                    <li>
                        <a href="#tab_survey" data-toggle="tab"
                           data-location="{{route('Dashboard.org.verify.list','survey')}}"
                           class="model"> New Survays </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_org">
                        {!! $dataTable->table(['width' => '100%','class'=>'table-striped']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- END CONTENT BODY -->
@stop
@push('page_script_plugins')

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>


<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
<script src="{{asset('/assets/project_widget.js')}}"></script>
{!! $dataTable->scripts() !!}
@include('dashboard.organizations.crud_details')
<script>
    var template = Handlebars.compile($("#details-template").html());
    // Add event listener for opening and closing details
    $('#dataTableBuilder tbody').on('click', 'td.details-control', function () {
        var table = window.LaravelDataTables["dataTableBuilder"];
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(template(row.data())).show();
            tr.addClass('shown');
        }
    });
</script>
<script>


    $(function () {
        $('a.model').on('click', function () {
            if (document.location.href != $(this).data('location'))
                document.location.href = $(this).data('location');
        });
        $('.model[href=#tab_{{$model}}]').click();
    })
</script>
@endpush