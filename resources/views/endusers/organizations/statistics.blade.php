@extends('dashboard.layout.dashboard')
@push('page_style_plugins')
<link rel="stylesheet" href="{{asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/cdn/materialize.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">

<link rel="stylesheet" href="https://pivottable.js.org/dist/pivot.css"/>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .section-to-print, .section-to-print * {
            visibility: visible;
        }

        .section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    #tab_1_3 select {
        display: inline-table;
        width: 80%;
    }

    .pvtUi {
        width: 100%;
    }

    .whiteborder {
        border-color: white;
    }

    .greyborder {
        border-color: lightgrey;
    }

    #filechooser {
        color: #555;
        text-decoration: underline;;
        cursor: pointer; /* "hand" cursor */
    }

    .node {
        border: solid 1px white;
        font: 10px sans-serif;
        line-height: 12px;
        overflow: hidden;
        position: absolute;
        text-indent: 2px;
    }

    .c3-line, .c3-focused {
        stroke-width: 3px !important;
    }

    .c3-bar {
        stroke: white !important;
        stroke-width: 1;
    }

    .c3 text {
        font-size: 12px;
        color: grey;
    }

    .tick line {
        stroke: white;
    }

    .c3-axis path {
        stroke: grey;
    }

    .c3-circle {
        opacity: 1 !important;
    }

    .c3-xgrid-focus {
        visibility: hidden !important;
    }
</style>
@endpush
@section('content')

    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <?php $title = str_plural(trans('user.type_'.snake_case($model)));?>
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href={{route('Dashboard.landing')}}>{{$title}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Statistics</span>

                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> {{$title}}
            <small>Statistics</small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">

                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_1" onclick="$('#save_chart').attr('data-chart','per')" data-toggle="tab">
                            Ordinary Charts </a>
                    </li>
                    <li>
                        <a href="#tab_1_2" onclick="$('#save_chart').attr('data-chart','multi')" data-toggle="tab">
                            Table Charts </a>
                    </li>
                    <li>
                        <a href="#tab_1_3" onclick="$('.charts-canvas').addClass('hidden').fadeOut();"
                           data-toggle="tab"> Pivot Reports </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_1_1">
                        <div class="form-group">
                            <?php $route_prefix = config('route-prefixes.'.$model);?>
                            {!! Form::open(['route'=>"Dashboard.$route_prefix.stats.post",'class'=>'charts-form','id'=>'per_charts'])!!}

                            <div class="form-group col-sm-10">
                                {!! Form::label('sector_id', 'Theme:') !!}
                                {{Form::select('theme',$libs,null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default"]) }}

                                <div class="input-group">
                                    <div class="icheck-list">
                                        {!! Form::label('attr_list', 'Attribute List:') !!}
                                        @foreach($target_types as $key=>$property)
                                            <div class="col-sm-1 form-group"></div>
                                            <div class="disp    form-group col-sm-2">
                                                <?php $name = ucwords(str_replace('_', ' ', snake_case($key)));?>
                                                {!! Form::label('attr_list', $name.':',['class'=>'btn-block']) !!}
                                                {{Form::radio('attr_list',$key ,null,['data-size'=>"mini",'data-name'=>$name,'class'=>'make-switch switch-radio1'])}}
                                            </div>
                                        @endforeach


                                    </div>
                                </div>


                            </div>
                            <div id="targets_wrapper" class="disp  margin-top-20  form-group col-sm-2">
                                <div class="form-actions">

                                    <input type="submit" class="btn btn blue" value="Draw">
                                </div>
                            </div>

                            <div class="disp form-group col-sm-2  margin-top-20">
                                {{--<input type="submit" class="btn btn blue" value="Draw">--}}

                            </div>

                            </form>


                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_2">
                        <div class="form-group">
                            {!! Form::open(['route'=>"Dashboard.$route_prefix.stats.post",'class'=>'charts-form','id'=>'multi_charts'])!!}
                            <div class="form-group col-sm-10">
                                {!! Form::label('sector_id', 'Theme:') !!}
                                {{Form::select('theme',$multi_libs,null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default"]) }}
                                <input type="hidden" name="multi" value="true">


                            </div>
                            <div class="form-group col-sm-10">
                                {!! Form::label('attr_list', 'X indicator:') !!}
                                {{Form::select('attr_list[x]',$target_types_m ,null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default",'id'=>'attr_list_x'])}}
                            </div>
                            <div class="form-group col-sm-10">
                                {!! Form::label('attr_list', 'Y indicators:') !!}


                                {!! Form::select('attr_list[y][]',$target_types_m ,old('targets[]'), ['multiple','id'=>'attr_list_y','data-style'=>'btn-default','placeholder'=>'Please Select Criteria','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}


                            </div>

                            <div id="targets_wrapper" class="disp  margin-top-20  form-group col-sm-2">
                                <div class="form-actions">
                                    <input type="submit" class="btn btn blue" value="Draw">
                                </div>
                            </div>


                            </form>


                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_3">

                        <div class="container-fluid">
                            <div class="col-sm-12">
                                <button class="btn blue" onclick="$('#save_pivot').removeClass('hidden')" id="pivoter">
                                    load
                                </button>
                                <button class="btn green hidden" id="save_pivot" data-model="{{$namespace}}">save
                                </button>
                            </div>
                            <div id="output" class="col-sm-12"></div>

                        </div>
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
                        <div class="actions">

                            <button href="#" class="btn  blue ">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <button class="btn green" data-chart="per" data-model="{{$namespace}}" id="save_chart">
                                <i class="fa fa-save"></i> Save
                            </button>

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
    <div id="target_handler" style="display:none;">
        <div class="form-group col-sm-12 ">
            {{ Form::select('target',array(),null,['class'=>'form-control']) }}
        </div>
    </div>

@stop
@push('page_script_plugins')
<script src="{{asset('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('/assets/pages/scripts/components-bootstrap-switch.min.js')}}"></script>

{!! Charts::assets() !!}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
<script type="text/javascript" src="{{asset('/js/pivotable/pivot.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/pivotable/d3_renderers.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/pivotable/c3_renderers.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/pivotable/export_renderers.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/pivotable/jquery.tabletojson.js')}}"></script>
<script>
    $(function () {
        var renderers = $.extend(
            $.pivotUtilities.renderers,
            $.pivotUtilities.c3_renderers,
            $.pivotUtilities.d3_renderers,
            $.pivotUtilities.export_renderers
        );

        var parseAndPivot = function (f) {
            $("#output").pivotUI(f, {renderers: renderers}, true);
        };

        $("#pivoter").on("click", function (event) {

            $("#output").html("<p align='center' style='color:grey;'>(processing...)</p>")
            $.get('{{route('populate',$model)}}', function (data) {
                parseAndPivot(data);
            });

        });


        $('#save_pivot').on('click', function (evt) {

            $.post('{{route('Dashboard.store.chart')}}',
                {_token:"{{csrf_token()}}",attr_list: $('.pvtTable').first().html(), model: $(this).attr('data-model'),theme:'pivot_pivot'}, function (evt) {

                })

        });


    });
</script>
<script>
    function setLabel($val) {
        $('#chart-label').text($val);
    }
    $(function () {
        $('#save_chart').on('click', function (evt) {
            evt.preventDefault();
            evt.stopPropagation();
            var formType = $(this).attr('data-chart'),
                multi = formType == 'per' ? 0 : 1;

            $.post('{{route('Dashboard.store.chart')}}',
                $('#' + formType + '_charts').serialize()
                + "&model=" + $(this).attr('data-model')
                + (multi ? "&multi=" + multi : ""),
                function (data) {
                    console.log(data);
                }
            )
        });


        $('.icheck-list input[type=radio]').on('switchChange.bootstrapSwitch', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.charts-canvas').removeClass('hidden').fadeIn();
            $form = $(this).closest('form');
            setLabel($(this).data('name'));
            $('div.chart.draw_chart').html(' <center>\r\ <div class=\"preloader-wrapper big active\" style=\"margin-top: {{ ($chart->settings()['height'] / 2) - 32 }}px;\">\r\n                                    <div class=\"spinner-layer spinner-blue-only\">\r\n                                        <div class=\"circle-clipper left\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                        <div class=\"gap-patch\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                        <div class=\"circle-clipper right\">\r\n                                            <div class=\"circle\"><\/div>\r\n                                        <\/div>\r\n                                    <\/div>\r\n                                <\/div>\r\n                            <\/center>');

            $.post($form.attr('action'), $form.serialize(), function (data) {
                $('div.chart.draw_chart').html(data);
            });

        });
        $('form.charts-form').submit(function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('.charts-canvas').removeClass('hidden').fadeIn();
            $.post($(this).attr('action'), $(this).serialize(), function (data) {

                $('div.chart.draw_chart').html(data);

            });
        });
        var charts = {!! json_encode($libs) !!};

        $('#attr_list_x').on('change', function (e) {
            $('#attr_list_y optgroup').prop('disabled', function (i, v) {
                console.log(v ? !v : v);
                return v ? !v : v;
            });
            console.log($('#opt_' + $(this).val()).prop('disabled', true).prop('disabled'))

            $('#attr_list_y option').prop('selected', function () {
                return this.defaultSelected;
            });

            $('#attr_list_y').selectpicker('destroy');
            $('#attr_list_y').selectpicker({
                style: 'blue'
            });
            ;

        });
//        $('.icheck-list input[type=radio]').on('switchChange.bootstrapSwitch', function ($event, $state) {
//            $event.preventDefault();
//            $select_val = this.value;
//            console.log(this.value);
//            $.get(document.location.origin + "/gateways/listings/" + $select_val,
//                null,
//                function (data) {
//                    var $list = $('#target_handler>div').clone()
//                        , $selectName = $select_val.split('-');
//                    $list.children('select').prop('name', 'target' + '[' + $select_val + '][]')
//
//                    $selectName = $selectName[$selectName.length - 1];
//                    $list.children('select').append("<option value='' selected='selected' disabled='disabled'>Please select " + $selectName.charAt(0).toUpperCase() + $selectName.slice(1) + "</option>");
//                    console.log(data);
//                    $.each(data, function (index, element) {
//                        $list.children('select').append("<option value='" + index + "'>" + element + "</option>");
//                    });
//                    $("#targets_wrapper").removeClass('hidden');
//
//                    $('#targets_wrapper>div.form-actions').html($list);
//                });
//        });

    })
</script>
@endpush