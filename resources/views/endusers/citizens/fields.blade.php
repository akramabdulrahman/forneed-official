
@include('endusers.extra_fields_form_poly',['manyRelations'=>$fieldsManyToMany])
<div class="form-group  col-md-6">
    <input value="1" type="checkbox" id="contactable" data-size="large" name="contactable" class="make-switch" checked
           data-on-color="info" data-off-color="danger" data-off-text="☒contact" data-on-text="☑contact">
</div>