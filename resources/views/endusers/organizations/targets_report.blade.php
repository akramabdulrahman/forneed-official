@foreach($project->targets_string() as $target)
    {{$target}} <i
            class="fa fa-dot-circle-o"
            aria-hidden="true"></i>
@endforeach