<div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
    <i class="fa fa-mobile" aria-hidden="true"></i>
    name :<span>{{$user->name}}</span></div>
<div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
    <i class="fa fa-mobile" aria-hidden="true"></i>
    Email :<span>{{$user->email}}</span></div>
@if($user->facebook_id)
    <div style="padding: 10px 0px;border-bottom: 1px solid #EEF1F5;">
        <i class="fa fa-mobile" aria-hidden="true"></i>
        Fb : <a href="http://facebook.com/profile.php?id={{$user->facebook_id}}">
            <span>
                http://facebook.com/
                </span>
        </a>
    </div>
@endif