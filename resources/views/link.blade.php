<a class="{{!isset($class)?:$class}}" href="{{$route}}" @if(isset($attr))
    @foreach($attr as $key=>$val) {{$key}}={{$val}} @endforeach @endif>{{$label}}

    </a>
