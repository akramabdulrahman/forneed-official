@foreach($extras as $cat=>$extra)
    <?php $name=ucfirst(implode(' ',explode('_',snake_case($cat))));?>
    <div class="form-group col-sm-6 ">
        <select class="selectpicker show-tick show-menu-arrow form-control"
                data-style="btn-default" name="{{"extra[$cat]"}}"
                placeholder="choose {{$name}}">
            <option value="" selected disabled>{{$name}}</option>
            @foreach($extra as $item)
                <option {{ isset(old('extra')[$cat])?((old('extra')[$cat] == $item->id )? "selected":""):"" }} value="{{$item->id}}">{{$item->extra}}</option>
            @endforeach
        </select>
    </div>
@endforeach