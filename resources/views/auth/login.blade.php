@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="">
                <div class="lg:w-1/2 lg:mx-auto card p-6 md:py-12 md:px-16 rounded shadow">
                    <div class="card-header" style="font-size: 30px; padding:30px; text-align:center">{{ __('Login') }}</div>

                    <div class="card-body py-2" style="padding-left: 40px; padding-right: 30px;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row mb-8">
                                <label class="label text-lg mb-4 block" for="email">{{ __('E-Mail Address') }}</label>


                                <div class="col-md-6">
                                    <input id="email" type="email" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-8">
                                <label for="password" class="label text-lg mb-4 block">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row py-6">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="button">
                                        {{ __('Login') }}
                                    </button><span>&nbsp;&nbsp;</span>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
