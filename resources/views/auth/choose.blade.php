@extends('layouts.choose')
@push('styles')
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<link rel="stylesheet" href="css/bootstrap.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="css/citizen-style-default.css">
<link rel="stylesheet" href="css/citizen-style.css">
<link href="css/style-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="css/user-card.css">
<link rel="stylesheet" href="css/to-do.css">
@endpush
@push('scripts')

@endpush
@section('content')
    <div class="col-lg-5 " style="position: absolute;right: 28px;">
        <div class="uk-block ">
            <div class="row uk-margin-large-top">
                <div class=" col-md-push-1 animate-box fadeInRight animated-fast" data-animate-effect="fadeInRight">
                    <row>
                        <div class="col-md-6 col-sm-4 mb">
                            <a href="{{url('checkpoint/citizen')}}">
                                <div class="darkblue-panel pn">
                                    <div class="darkblue-header">
                                        <h5>Citizen</h5>
                                    </div>
                                    <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>

                                </div><!-- -- /darkblue panel ---->
                            </a>
                        </div>
                        <div class="col-md-6 col-sm-4 mb">
                            <a href="{{url('checkpoint/sp')}}">
                                <div class="darkblue-panel pn">
                                    <div class="darkblue-header">
                                        <h5>Service Provider</h5>
                                    </div>
                                    <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>

                                </div><!-- -- /darkblue panel ---->
                            </a>
                        </div>

                    </row>
                </div>

            </div>
        </div>
    </div>

@endsection
