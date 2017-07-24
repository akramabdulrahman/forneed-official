@extends('dashboard.layout.dashboard')

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
                    <a href="{{route('Dashboard.work.crud.list')}}">Social Workers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Hiring</span>

                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Hiring
            <small>Pending Applicants</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width:9%"> #</th>
                        <th> Project Name</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $key=> $project)
                        <tr>
                            <td> {{$key+1}}</td>
                            <td><a href="{{route('Dashboard.work.applicants',$project->id)}}"> {{$project->name}} </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="clearfix"></div>


    </div>
    <!-- END CONTENT BODY -->
@stop