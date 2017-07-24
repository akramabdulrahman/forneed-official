@extends('endusers.layout.dashboard_no_sidebar')
@push('page_style_plugins')
<link rel="stylesheet" href="{{asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}">
<link rel="stylesheet" href="{{url('css/style.css')}}">
<style>
    .selectpicker .btn:hover {
        background: #398439 !important;
        text-decoration: none;
    }
</style>
@endpush
@push('page_script_plugins')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="{{url('js/google_map.js')}}"></script>
<script src="{{asset('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/assets/pages/scripts/components-bootstrap-switch.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>


@endpush
@section('content')
    <div id="map" class="col-lg-8 fh5co-map .gradient" style="padding:0px"></div>


    <div class=" container  text-center" style="position: absolute; width: 100%;
    margin: 45px auto;">
        <div>
            @include('errors')
        </div>
        <div class="portlet-body form">
            <div class="row">
                {!! Form::open(['route' => 'newSp']) !!}

                @include('endusers.organizations.fields')
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-success">Start <i class="glyphicon glyphicon-forward"></i>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
