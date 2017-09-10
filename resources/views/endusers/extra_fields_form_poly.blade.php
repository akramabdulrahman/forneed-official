@foreach($extras as $cat=>$extra)
    <?php $name = ucfirst(implode(' ', explode('_', snake_case($cat))));
    $multi = isset($manyRelations) ? (in_array($cat, $manyRelations) ? true : false) : false?>
    <div class="form-group col-sm-6 ">
        <select class="selectpicker show-tick show-menu-arrow form-control"
                data-style="btn-default" name="{{"extra[$cat]".($multi?'[]':'')}}"
                placeholder="choose {{$multi?str_plural($name):$name}}"
                {{$multi?'multiple':''}}>
            <option value="" selected disabled>{{$multi?str_plural($name):$name}}</option>
            @foreach($extra as $item)
                <option {{ isset(old('extra')[$cat])?((old('extra')[$cat] == $item->id )? "selected":""):"" }} value="{{$item->id}}">{{$item->extra}}</option>
            @endforeach
        </select>
    </div>
@endforeach