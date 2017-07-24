@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
<link href="{{asset('/assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/dashboard/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />

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
                    <a href="{{route('Dashboard.work.crud.list')}}">Social Workers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Open Organizations</span>

                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Monitoring And Evaluation
            <small>Organizations With Open Projects</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">


                <div id="MainMenu">
                    <div class="list-group panel">
                        @foreach($service_providers as $provider)
                            <a href="#organization_{{$provider->id}}" class="list-group-item list-group-item-success"
                               data-toggle="collapse"
                               data-parent="#MainMenu"><i class="fa fa-circle " aria-hidden="true"></i>
                                &nbsp;{{$provider->name}}</a>
                            <div class="collapse in" id="organization_{{$provider->id}}">
                                @foreach($provider->projects as $project)
                                    <a href="#project_{{$project->id}}" class="list-group-item" data-toggle="collapse"
                                       data-parent="#project_{{$project->id}}"><i class="fa fa-angle-right"
                                                                                  aria-hidden="true"></i>
                                        {{$project->name}}</a>
                                    <div class="collapse list-group-submenu" id="project_{{$project->id}}">
                                        @foreach($project->surveys as $survey)
                                            <a class="list-group-item" data-parent="#project_{{$project->id}}"
                                               data-toggle="modal"
                                               href="#basic" data-subject="{{$survey->subject}}"
                                               data-provider="{{$provider->name}}" data-project="{{$project->name}}"
                                               data-id="{{$survey->id}}"
                                               data-progress="{{(ceil($survey->progress))}}">{{$survey->subject}}</a>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach


                    </div>
                </div>


            </div>
        </div>


        <div class="clearfix"></div>

        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> Survay A - Project
                            A </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1" style="line-height:72px;">
                                <i><b class="sur_id"> Survay # 1 : </b></i> <span class="sur_subject">Survay Name</span>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div style="text-align: center;padding-top:10%;" class="col-md-7">
                                        <i ><b > Progress of Survay: </b></i>
                                    </div>
                                    <div class="col-md-4">
                                         <span class="easy-pie-chart">
															<div class=" progress number transactions" data-percent="55"
                                                                 style="display:inline-block">
																<span>+55</span>% </div>
												    </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn blue distination"   href="{{route('Dashboard.work.survey','id')}}">Social Workers By Name</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


    </div>
    <!-- END CONTENT BODY -->
@stop

@push("page_script_plugins")
<script src="{{asset('dashboard/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>

<script>
    $('#basic').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var subject = button.data('subject') // Extract info from data-* attributes
        var provider = button.data('provider') // Extract info from data-* attributes
        var project = button.data('project') // Extract info from data-* attributes
        var id = button.data('id') // Extract info from data-* attributes
        var progress = button.data('progress') // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text( provider +' > '+ project +' > '+ subject );
        modal.find('div.progress').attr('data-percent', progress ).find('span').text('+'+Math.ceil(progress));
        modal.find('b.sur_id').text(" Survay # "+id+" :");
        modal.find('span.sur_subject').text(subject);
        var dist = modal.find('a.distination');
        console.log(dist,dist.attr('href'));
          dist.attr('href',dist.attr('href').replace('id',id));

    })
</script>
@endpush