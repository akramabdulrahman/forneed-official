<div class="form-group">
    {!! Form::label('name', 'Project Name:') !!}
    {{Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {!! Form::label('description', 'Project Description:') !!}
    {{Form::text('description',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    <div class="form-group col-sm-12">
        {!! Form::label('sector_id', 'Sector:') !!}
        {!! Form::select('sector_id',  $sectors ,null, ['data-style'=>'btn-default','placeholder'=>'please select sector','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
    </div>
</div>
<div class="row form-group">
    <div class="form-group col-sm-6">
        {!! Form::label('sponsor', 'Donor:') !!}
        {{Form::text('sponsor',null,['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    <label class="control-label">Period</label>
    <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
        {{Form::date('starts_at', \Carbon\Carbon::now(),['class'=>'form-control'])}}
        <span class="input-group-btn">
            <button class="btn default" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
        <span class="input-group-addon"> to </span>
        {{Form::date('expires_at', \Carbon\Carbon::now(),['class'=>'form-control'])}}

        <span class="input-group-btn">
            <button class="btn default" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
    </div>
</div>
<div class="form-group">
    <?php $criteria = $update ? $project->getTargetCriteria() : []?>
    <label class="control-label">Beneficiaries</label>
    {!! Form::select('targets[]',$extra_types ,$criteria, ['multiple','data-style'=>'btn-default','placeholder'=>'Please Select Criteria','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
</div>
<div class="margin-top-10">
    <button type="submit" class="btn green"> Add</button>
    <a href="{{route('endusers.org.projects.list')}}" class="btn default"> Cancel </a>
</div>
