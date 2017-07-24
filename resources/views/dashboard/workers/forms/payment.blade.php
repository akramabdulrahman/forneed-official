@extends('dashboard.layout.dashboard')

@section('content')
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" >
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Social Workers</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#"><span>Monitoring and Evaluation</span></a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Add Payment</span>
                </li>
            </ul>


        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Monitoring and Evaluation
            <small>Add New Payment</small>
        </h3>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row" >
            <div  id="print-target" class="col-md-6">
                <form  action="#">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="input" value="{{$worker->name}}" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">From</label>
                        <input type="input" value="{{$survey->starts_at->format('d/m/Y')}}" class="form-control"
                               placeholder="Enter From">
                    </div>
                    <div class="form-group">
                        <label class="control-label">To</label>
                        <input type="input" value="{{$survey->expires_at->format('d/m/Y')}}" class="form-control"
                               placeholder="Enter To"></div>

                    <div class="form-group">
                        <label class="control-label">Amount to be paid</label>
                        <?php $payment = $worker->calculatePayment($survey->id) ?>
                        <input type="input" value="{{ $payment[2] }} ₪" class="form-control"
                               placeholder="Enter Amount"></div>

                    <div class="form-group">
                        <label class="control-label">Total Amount</label>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="input" value="{{ $payment[0] }}" class="form-control" placeholder="# of Survays">
                            </div>
                            <div class="col-md-2" style="text-align:center"><i class="fa"> * </i></div>
                            <div class="col-md-5">
                                <input type="input" value="{{ $payment[1] }}" class="form-control" placeholder="Rate per survay">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group"><i class="fa"> + </i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="input" class="form-control" placeholder="Other expenses">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group"><i class="fa"> = </i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="input" class="form-control" placeholder="Total Amount">
                        </div>
                    </div>

                </form>


            </div>
            <div class="margin-top-10">
                <a href="javascript:;" class="btn blue print-btn"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                    Print Invoice</a>
                <a href="{{route('Dashboard.work.survey',$survey->id)}}" class="btn default"> Cancel </a>

            </div>
        </div>


        <div class="clearfix"></div>


    </div>
    <div id="print-assets" class="hidden">
        <canvas id="canvas"></canvas>
        <div id="can_f"></div>
    </div>
    <!-- END CONTENT BODY -->
@stop


@push('page_script_plugins')
<script src="{{asset('/assets/html2canvas.js')}}"></script>
<script src="{{asset('/assets/print.elem.js')}}"></script>
<script>
    $(function(){

        $('.print-btn').on('click',function(){
            PrintElem('print-target')


        })
    })
</script>
@endpush