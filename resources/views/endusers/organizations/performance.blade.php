@extends('endusers.layout.dashboard')
@section('menu')
    @include('endusers.organizations.menu')
@stop


@section('content')
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
                    <span>Performance Report</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Attributes</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        {!! Form::open(['route'=>"endusers.org.performance.post",'class'=>'charts-form','id'=>'per_charts'])!!}

                       <div class="form-group">
                           {!! Form::label('sector_id', 'Theme:') !!}
                           {{Form::select('theme',$libs,null,['class'=>'select2me show-tick show-menu-arrow form-control','placeholder'=>'choose chart','data-style'=>"btn-default"]) }}
                       </div>
                      <div class="form-group">
                          {!! Form::label('project_id', 'Project:') !!}
                          {{Form::select('project_id',$projects,null,['class'=>'select2me show-tick show-menu-arrow form-control','placeholder'=>'choose project','data-style'=>"btn-default"]) }}
                      </div>

                        <div class="form-group survey_wrapper hidden">
                          {!! Form::label('survey_id', 'Survey:') !!}
                          {{Form::select('survey_id',[],null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default"]) }}
                      </div>
                        <div class="form-actions">

                            <input type="submit" class="btn btn blue" value="Draw">
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <div class="col-md-12 charts-canvas hidden section-to-print">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Pio Chart based on <span
                                        class="attribute_name">(<span id="chart-label"></span>)</span></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="chart draw_chart ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@stop

@push('page_script_plugins')
<script>
    $('form.charts-form').submit(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $('.charts-canvas').removeClass('hidden').fadeIn();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            $('div.chart.draw_chart').html(data);
        });
    });

    $('#project_id').on('change', function (e) {
        var project_id = $(this).val();

        $.get(window.location.origin + "/listings/surveys/val".replace('val', project_id),
            function (data) {
                $options = data.map(function (v) {
                    $opt = document.createElement('option');
                    $opt.value = v.id;
                    $opt.text = v.subject;
                    return $opt;
                });
                $('#survey_id').append($('<option selected="selected"   value="">choose Survey</option>'))
                $('#survey_id').append($options)
                $('#survey_id').selectpicker('destroy');
                $('#survey_id').selectpicker({
                    color: 'blue'
                });
                $('.survey_wrapper').removeClass('hidden');
            });

    });
</script>
{!! Charts::assets() !!}
@endpush