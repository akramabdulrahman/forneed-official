<div class="form-group col-sm-6">
    <select class="selectpicker show-tick show-menu-arrow form-control"
            data-style="btn-default" name="sector_id[]" data-placeholder="Sectors"
            placeholder="select sector" multiple>
        <option value="" selected disabled>Sectors</option>
        @foreach($sectors as $id=>$name)
            <option {{ ( in_array ($id,is_null(old("sector_id"))?[]:old("sector_id")) ? "selected":"") }} value="{{$id}}">{{$name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-sm-6">
    <select class="selectpicker show-tick show-menu-arrow form-control"
            data-style="btn-default" name="area_id[]" multiple
            placeholder="choose Company">
        <option value="" selected disabled>Areas</option>
        @foreach($areas as $id=>$name)
            <option {{ (in_array ($id,is_null(old("area_id"))?[]:old("area_id"))  ? "selected":"") }} value="{{$id}}">{{$name}}</option>
        @endforeach
    </select>
</div>
@include('endusers.extra_fields_form_poly')
<div class="form-group  col-md-6">
    <input value="1" type="checkbox" id="contactable" data-size="large" name="contactable" class="make-switch" checked
           data-on-color="info" data-off-color="danger" data-off-text="☒contact" data-on-text="☑contact">
</div>