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

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user[password]', 'Password:') !!}
    {!! Form::password('user[password]', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user[password_confirmation]', 'Confirm password:') !!}
    {!! Form::password('user[password_confirmation]', ['class' => 'form-control']) !!}
</div>
@include('endusers.extra_fields_form_poly')
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Organization Name</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('organization_name')}}" name="organization_name"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Mobile</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('mobile_number')}}" name="mobile_number"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('phone_number')}}" name="phone_number"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Fax</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('fax')}}" name="fax"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Website</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('website')}}" name="website"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Contact Person Title</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('contact_person_title')}}" name="contact_person_title"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Contact Person Name</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('contact_person')}}" name="contact_person"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">Mission Statement</label>
    <div class="col-sm-10">
    <textarea type="text"
              name="mission_statement"
              class="form-control text-center round-form">{{old('mission_statement')}}
    </textarea>
    </div>
</div>