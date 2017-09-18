@extends('endusers.layout.dashboard')
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
                    <span>{{$project->name}}</span>
                </li>
            </ul>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Projects
            <small>{{$project->name}}</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info-circle font-red" aria-hidden="true"></i>
                            <span class="caption-subject font-red sbold uppercase">{{$project->name}} details</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div style="padding:5px"><i>Project Name :</i> {{$project->name}}</div>
                        <div style="padding:5px"><i>Project Donor :</i> {{$project->serviceProvider->name}}</div>
                        <div style="padding:5px"><i>Project Period :</i> From {{$project->starts_at->format('m/d/Y')}}
                            To {{$project->expires_at->format('m/d/Y')}}
                        </div>
                        <div style="padding:5px">
                            <i>Project Beneficiaries :
                                @foreach($project->targets_string() as $key=>$target)

                                    ({{$key}} : {{$target}}) <br>
                                @endforeach
                            </i>
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
                                    Survays list</h4></div>
                            <div class="pull-right">
                                <a href="{{route('endusers.org.projects.surveys.create',$project->id)}}" class="btn blue"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                    Add New Survay</a>
                            </div>
                        </div>

                    </div>
                    <div class="portlet-body">
                        {!! $dataTable->table(['width' => '100%','class'=>'table-striped']) !!}
                    </div>
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

@endpush