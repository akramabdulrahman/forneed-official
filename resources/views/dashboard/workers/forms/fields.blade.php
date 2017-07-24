
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



<div class="form-group col-sm-6">
    <select class="selectpicker show-tick show-menu-arrow form-control"
            data-style="btn-default" name="area_id"
            placeholder="choose Area">
        <option value="" selected disabled>Areas</option>
        @foreach($areas as $id=>$name)
            <option {{ (old("area_id") == $id ? "selected":"") }} value="{{$id}}">{{$name}}</option>
        @endforeach
    </select>
</div>

@include('endusers.extra_fields_form_poly')

<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">address</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('address')}}"
                                   name="address"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">mobile</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('mobile')}}"
                                   name="mobile"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-12">
    <label class="col-sm-2 col-sm-2 control-label">telephone</label>
    <div class="col-sm-10">
        <input type="text" value="{{old('telephone')}}"
                                   name="telephone"
               class="form-control text-center round-form">
    </div>
</div>
<div class="form-group col-sm-6">
    <label class="col-sm-2 col-sm-2 control-label">CV:</label>
    <div class="col-sm-12">
        
        <div class="">
            {!! Form::file('cv',['class'=>'inputfile inputfile-5','id'=>"file-6",'style'=>'display:none;' ]) !!}
            <label for="file-6"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span></span></label>
        </div>

    </div>
</div>
<div class="form-group  col-md-6">
    {!! Form::label('is_accepted', 'Accepted:') !!}
    <div>
        <input value="1" type="checkbox" id="is_accepted" name="is_accepted" class="make-switch" checked data-on-color="info" data-off-color="success">
    </div>

</div>