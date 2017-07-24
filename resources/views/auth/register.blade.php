@if ((count($errors) > 0) && !$errors->has('emaillogin'))

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="uk-text-small">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}

    <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="name" type="text" class="form-control" placeholder="Your Name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
    </div>

    <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="email" type="email" class="form-control" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required>
        </div>
    </div>

    <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
    </div>

    <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

        <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 ">
            <input type="submit" value="register" class="btn btn-block btn-primary"/>

            <hr>
            <ul class="social-network  social-circle col-md-12 col-md-offset-4" >
                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>


</form>
