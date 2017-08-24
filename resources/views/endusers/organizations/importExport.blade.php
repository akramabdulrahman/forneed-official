@extends('endusers.layout.dashboard')
@section('menu')
    @include('endusers.organizations.menu')
@stop
@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('endusers.org.index')}}">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>

                <li>
                    <span>Excel Input</span>

                </li>
            </ul>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Survays
            <small>{{$survey->subject}}</small>
        </h3>

        <div class="row">
            <a href="{{ route('importExport.surveys.export',[$survey->id,'xls']) }}">
                <button class="btn btn-success">Download Excel xls</button>
            </a>
            <a href="{{ route('importExport.surveys.export',[$survey->id,'xlsx']) }}">
                <button class="btn btn-success">Download Excel xlsx</button>
            </a>
            <a href="{{ route('importExport.surveys.export',[$survey->id,'csv']) }}">
                <button class="btn btn-success">Download CSV</button>
            </a>
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
                  action="{{ route('importExport.surveys.import',[$survey->id]) }}" class="form-horizontal"
                  method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="import_file"/>
                <button class="btn btn-primary">Import File</button>
            </form>
        </div>
        <div class="container">
            <h3 class="page-title"> Appendix
                <small>Reference Data To be Used in Sheet User-Criteria Values</small>
            </h3>
            <row>
                <a href="{{ route('importExport.extras.export',['xls']) }}">
                    <button class="btn btn-success">Download Excel xls</button>
                </a>
                <a href="{{ route('importExport.extras.export',['xlsx']) }}">
                    <button class="btn btn-success">Download Excel xlsx</button>
                </a>
                <a href="{{ route('importExport.extras.export',['csv']) }}">
                    <button class="btn btn-success">Download CSV</button>
                </a>
            </row>

        </div>


    </div>

@stop