@extends('endusers.layout.dashboard')
@section('menu')
    @include('endusers.organizations.menu')
@stop
@push('page_style_plugins')
<link rel="stylesheet" href="/js/buttons/css/buttons.dataTables.css">
<link rel="stylesheet" href="{{asset('/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}">
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
                    <a href="{{route('endusers.org.index')}}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>

                <li>
                    <span>Projects</span>

                </li>
            </ul>
            <div class="page-toolbar">
                <div class="pull-right">
                    <a href="{{route('endusers.org.projects.create')}}" class="btn blue"><i class="fa fa-plus" aria-hidden="true"></i> Add New Project</a>
                </div>
            </div>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Services Providers
            <small>Projects</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                {!! $dataTable->table(['width' => '100%','class'=>'table-striped']) !!}

            </div>
        </div>


        <div class="clearfix"></div>


    </div>

@stop


@push('page_script_plugins')

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.6/handlebars.min.js"></script>

<script src="/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>

<script src="/js/buttons/js/dataTables.buttons.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
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

@endpush