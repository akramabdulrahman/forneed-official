
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user[name]', 'Name:') !!}
    {!! Form::text('user[name]', old('user[name]'), ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user[email]', 'Email:') !!}
    {!! Form::email('user[email]', old('user[email]'), ['class' => 'form-control']) !!}
</div>
@if(!$update)
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user[password]', 'Password:') !!}
    {!! Form::password('user[password]', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user[password_confirmation]', 'Confirm password:') !!}
    {!! Form::password('user[password_confirmation]', ['class' => 'form-control']) !!}
</div>
@endif

@include('endusers.extra_fields_form_poly')

<div class="form-group  col-md-6 margin-left-10">
    <div class="col-md-offset-1">
        <input value="1"  type="checkbox" id="contactable" data-size="large" name="contactable" class="make-switch "
               data-on-color="info" data-off-color="danger" data-off-text="☒contact" data-on-text="☑contact">
    </div>
</div>
<div class=" form-group col-sm-12 margin-top-10">
    <input href="javascript:;" class="btn green" type="submit" value="Create">
    <a href="{{route('Dashboard.ben.crud.list')}}" class="btn default"> Cancel </a>
</div>