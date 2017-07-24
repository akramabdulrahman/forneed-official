

<a href="{{route($modelRoute.'.edit',$id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
<a  onclick = "return confirm('Are you sure?')" href="{{route($modelRoute.'.delete',$id)}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>