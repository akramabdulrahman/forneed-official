<a class="{{!isset($class)?:$class}}" href="{{$route}}" @foreach($attr as $key=>$val) {{$key}}={{$val}} @endforeach>{{$label}}</a>
