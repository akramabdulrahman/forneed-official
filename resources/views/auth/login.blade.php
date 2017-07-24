
@if ((count($errors) > 0) && $errors->has('emaillogin'))

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="uk-text-small">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal " role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="form-group row{{ $errors->has('emaillogin') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="email" type="email"  class="form-control" name="email" placeholder="E-Mail Address"  value="{{ old('email') }}" required autofocus>


        </div>
    </div>

    <div class="form-group row{{ $errors->has('passwordlogin') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="password" type="password" class="form-control " placeholder="Password" name="password" required>


        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12   ">
            <div class="checkbox " style="color: rgba(0, 0, 0, 0.5);">
                <label class="pull-left uk-text-right-medium uk-vertical-align-middle">
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <a class="btn-link pull-right uk-text-right-medium uk-vertical-align-middle" style="color: rgba(0, 0, 0, 0.5);"  href="{{ url('/password/reset') }}">
                    Forgot Your Password?
                </a>
            </div>

        </div>

    </div>

    <div class="form-group">
        <div class="col-md-12 ">

            <input type="submit" value="Login" class="btn  btn-block btn-primary"/>
            <hr>
            <ul class="social-network  social-circle col-md-12 col-md-offset-4" >
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>

</form>

