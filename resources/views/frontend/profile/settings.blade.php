@extends('endusers.layout.dashboard_no_sidebar')

@push('styles')
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css"/>

@endpush
@section('content')
    <div class="page-content">

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>User</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"> New User Profile | Account
        <small>user account page</small>
    </h3>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar col-md-4">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{url('/profile_image')}}" class="img-responsive" alt=""></div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{$user->name}}</div>
                        <div class="profile-usertitle-job"> Service Provider</div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->

                    <!-- SIDEBAR MENU -->

                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->

            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        @if ($errors->any())
                                            <ul class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li data-name="">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <div id="account-message-div">

                                        </div>
                                        {!! Form::model($user, [
                                            'id' =>"account-form",
                                            'data-url'=>route('update_profile')
                                        ]) !!}
                                        {{--<form id="account-form"--}}
                                        {{--data-url="{{action('ProfilePageController@postUpdate')}}" role="form"--}}
                                        {{--action="#">--}}

                                        {!! csrf_field() !!}
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                            {!! Form::label('name', 'Name:') !!}
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                            {!! Form::label('email', 'Email:') !!}
                                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                        </div>




                                        <div class="form-group">
                                            <label class="col-sm-8 col-sm-8 control-label" for="contactable">
                                                <span>هل ترغب بالتواصل معكم لاعلامكم بالمشاريع والتدخلات والأنشطة والاستبانات في منطقة سكناكم؟</span>
                                                <input type="checkbox" value="1" checked="{{$type->contactable}}" id="contactable" name="contactable"
                                                       class="form-control text-center round-form">
                                            </label>
                                        </div>

                                        <div class="margiv-top-10">
                                            <input type="submit" value="Save Changes" class="btn green"/>
                                            <a href="javascript:;" class="btn default"> Cancel </a>
                                        </div>
                                        {{--</form>--}}
                                        {{form::close()}}
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                            dolor brunch. Food truck quinoa nesciunt laborum
                                            eiusmod. </p>

                                        <div id="image-message-div">

                                        </div>
                                        <form action="#" role="form" id="image-form"
                                              data-url="{{route('postUserImage')}}"
                                              enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail"
                                                         style="width: 200px; height: 150px;">
                                                        <img src="{{url('/profile_image')}}"
                                                             alt="No image"/></div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                         style="max-width: 200px; max-height: 150px;">

                                                    </div>
                                                    <div>
                                                        <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="file"> </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists"
                                                           data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="margin-top-10">
                                                <input type="submit" value="Save Changes" class="btn green"/>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>


                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <form action="#">
                                            <div class="form-group">
                                                <label class="control-label">Current Password</label>
                                                <input type="password" class="form-control"/></div>
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control"/></div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control"/></div>
                                            <div class="margin-top-10">
                                                <a href="javascript:;" class="btn green"> Change Password </a>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
    </div>
@endsection
@push('styles')
<link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="/assets/survey_widget.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/form-wizard.min.js"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>


<script src="/assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>

<script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>


<script src="/assets/pages/scripts/profile.min.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/timeline.min.js" type="text/javascript"></script>

<script>
    $('#account-form').on('submit', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $('#account-form').serialize(),
            error: function (data) {
                var errors = data.responseJSON;
//                console.log(JSON.parse(errors));
                var errorString = '<ul class="alert alert-danger">';
                $.each(errors, function (key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                $('#account-message-div').html(errorString);
                console.log(errorString);
                // Render the errors with js ...
            }
        }).done(function (data) {
            var errorString = '<ul class="alert alert-success">';
            $.each(data, function (key, value) {
                errorString += '<li>' + value + '</li>';
            });
            errorString += '</ul>';

            $('#account-message-div').html(errorString);
        }).always(function (data) {
        });
    });
</script>

<script>
    $('#image-form').on('submit', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: new FormData(this),
            async: false,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            error: function (data) {
                var errors = data.responseJSON;
                var errorString = '<ul class="alert alert-danger">';
                $.each(errors, function (key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                $('#image-message-div').html(errorString);
                console.log(errorString);
                // Render the errors with js ...
            }
        }).done(function (data) {
            var errorString = '<ul class="alert alert-success">';
            $.each(data, function (key, value) {
                errorString += '<li>' + value + '</li>';
            });
            errorString += '</ul>';
            $('#image-message-div').html(errorString);
        });
    });
</script>
@endpush

@push('styles')

<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush