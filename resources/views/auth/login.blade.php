@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="main-bg">
    <h1 class="name">{{ __('Login') }}</h1>
    <div class="sub-main-w3">
        <input type="radio" name="sections" id="option1" checked>
        <article>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="legend">{{ __('Login Here') }}</h3>
                <div class="input {{ $errors->has('email') || $errors->has('username') ? 'is-invalid' : '' }}">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus />
                    @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input {{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="fa fa-key" aria-hidden="true"></span>
                    <input type="password" name="password" required />
                    @if ($errors->has('email'))
                    <div class="uk-text-danger" role="alert">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    </div>
                    @endif
                    @if ($errors->has('username'))
                    <div class="uk-text-danger" role="alert">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    </div>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="bottom-text-w3ls" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn submit">{{ __('Login') }}</button>
                <div class="txt1 text-center p-t-54 p-b-20">
                    <span>{{ __('Or Sign Up Using') }}</span>
                </div>
                <a href="redirect/facebook" class="btn-face m-b-20"><i class="fa fa-facebook-official"></i>{{ __('Facebook') }}
                </a>
                <a href="redirect/google" class="btn-google m-b-20"><img src="{{ asset(config('app.img_frontend') . 'icons-google.png') }}" alt="{{ __('GOOGLE') }}">
                    {{ __('Google') }}
                </a>
                <p class="message">{{ __('Not registered?') }}<a href="{{ route('register') }}">{{ __('Create an account') }}</a></p>
            </form>
        </article>
        <div class="clear"></div>
    </div>
    <div class="copyright">
        <h2>&copy; {{ __('Copyright © 2019 by Mrs.Huyen') }}
        </h2>
    </div>
</div>
@endsection
