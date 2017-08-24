@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
    <link rel="stylesheet" href="{{asset("/assets/pages/css/profile.min.css")}}">
@endpush
@section('content')
    <!-- BEGIN PAGE HEADER-->
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href={{route('Dashboard.landing')}}>Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>User</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> User Profile
            <small></small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{url('/profile_image')}}" class="img-responsive" alt=""></div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Marcus Doe</div>
                            <div class="profile-usertitle-job"> {{Auth::user()->user_type}}</div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->

                        <!-- END SIDEBAR BUTTONS -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">

                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->

                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Your Info</span>
                                    </div>
                                    <div class="actions">
                                        <a href="edit_Beneficiaries_profile.html"><i class="fa fa-pencil"
                                                                                     aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="portlet-body ">
                                    <div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                        name :<span>{{$user->name}}</span></div>
                                    <div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                        Email :<span>{{$user->email}}</span></div>
                                    @if($user->facebook_id)
                                        <div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
                                            <i class="fa fa-mobile" aria-hidden="true"></i>
                                            Fb : <a href="http://facebook.com/profile.php?id={{$user->facebook_id}}">
                                     <span>
                                         http://facebook.com/
                                      </span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- END PORTLET -->
                            @foreach($types as $type_model=>$type)
                                <div class="portlet light ">
                                    <div class="portlet-title">
                                        <div class="caption caption-md">
                                            <i class="icon-bar-chart theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{$type_model}}</span>
                                        </div>
                                        <div class="actions">
                                            <a href="edit_Beneficiaries_profile.html"><i class="fa fa-pencil"
                                                                                         aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body ">
                                        @foreach($type as $key=>$value)
                                            @if(!strpos($key,'Populated') )
                                                <div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
                                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                                    {{str_replace('_',' ',snake_case($key))}} :<span>{{$value}}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>


                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
@stop
