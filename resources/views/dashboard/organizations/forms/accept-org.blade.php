{!! Form::open(['route'=>['Dashboard.org.verify.org.accept',$modelRoute,$id,isset($project_id)?$project_id:null],'method'=>'POST']) !!}
{{ method_field('PATCH') }}

<div class="btn-group">
    <button type="button" class="btn blue btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false"> Actions
        <i class="fa fa-angle-down"></i>
    </button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li>
            <button type="submit" class=" btn-block btn btn-info " name="is_accepted" value="1">
                <i class="fa fa-check " aria-hidden="true"></i> Accept
            </button>
        </li>
        <li>
            <button type="submit" class=" btn-block btn btn-danger" name="is_accepted" value="2">
                <i class="fa fa-times" aria-hidden="true"></i> Reject
            </button>
        </li>
    </ul>
</div>
{!! Form::close() !!}