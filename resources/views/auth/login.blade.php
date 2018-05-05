@extends('layouts.login')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="logo">
                <a href="{{ url('/') }}"><svg id="tckz_logo" class="d-inline-block" data-name="Tckz logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><style>.cls-1{fill:#f1c40f;}.cls-2{fill:#f1c40f;}</style></defs><title>Tckz</title><path class="cls-1" d="M198,277.51a99.28,99.28,0,0,1-16.52-1.38L208.16,152c5.26,1.13,10.37,2.12,15.23,2.95A92,92,0,0,0,239,156.34c9.21,0,16.25-2.3,20.94-6.84s7.22-11.72,7.51-21.35l.07-2.29-2.13.85a65.2,65.2,0,0,1-10.28,3A71.11,71.11,0,0,1,240.27,131a93.7,93.7,0,0,1-12-.73c-3.73-.48-7.65-1.05-11.65-1.68s-8.24-1.19-12.7-1.69a138.51,138.51,0,0,0-15.22-.75c-13.43,0-25,1.59-34.27,4.71s-17.06,7.31-23,12.39a46,46,0,0,0-12.94,17.64,54.15,54.15,0,0,0-4,20.24c0,8.71,2,14.84,6.06,18.2s9.91,5,17.76,5h2.44l-1.1-2.18c-.27-.54-.54-1.11-.81-1.72s-.56-1.39-.89-2.39a20.58,20.58,0,0,1-.78-3.82,58.31,58.31,0,0,1-.31-6.76c0-7.92,1-14.57,3.06-19.78a30.23,30.23,0,0,1,8.11-12.14,29.53,29.53,0,0,1,12-6.21,59.72,59.72,0,0,1,15.1-1.85h.46L150.41,265.27A98.53,98.53,0,1,1,198,277.51Z" transform="translate(-98 -79.01)"/><path class="cls-2" d="M198,82a97,97,0,0,1,0,194,98.21,98.21,0,0,1-14.73-1.11l26-121.12c4.77,1,9.4,1.9,13.82,2.65A94.16,94.16,0,0,0,239,157.84c9.61,0,17-2.44,22-7.26s7.66-12.35,8-22.38l.14-4.58-4.26,1.7a64.29,64.29,0,0,1-10,2.91,70.14,70.14,0,0,1-14.53,1.3,90.86,90.86,0,0,1-11.82-.72c-3.71-.48-7.62-1-11.61-1.67s-8.28-1.2-12.76-1.7a141.73,141.73,0,0,0-15.39-.76c-13.59,0-25.28,1.61-34.75,4.79s-17.41,7.46-23.47,12.68a47.39,47.39,0,0,0-13.35,18.21,55.5,55.5,0,0,0-4.07,20.8c0,9.3,2.16,15.64,6.59,19.35,4.22,3.54,10.52,5.34,18.73,5.34h4.88l-2.2-4.36c-.25-.48-.5-1-.78-1.66a23.26,23.26,0,0,1-.84-2.25,18.38,18.38,0,0,1-.71-3.53,55,55,0,0,1-.3-6.57c0-7.73,1-14.2,3-19.23a28.66,28.66,0,0,1,7.69-11.56,28.19,28.19,0,0,1,11.43-5.89A57.42,57.42,0,0,1,173.82,149L149.38,263A97,97,0,0,1,198,82m0-3a100,100,0,0,0-46.54,188.53L177.53,146h-2.31a60.79,60.79,0,0,0-15.48,1.9,31.08,31.08,0,0,0-12.63,6.52,31.64,31.64,0,0,0-8.53,12.74q-3.15,8.1-3.16,20.32a59,59,0,0,0,.32,6.94,21.91,21.91,0,0,0,.84,4.11c.35,1.05.67,1.9.95,2.53s.56,1.23.84,1.79q-11.28,0-16.8-4.64t-5.52-17.05a52.22,52.22,0,0,1,3.86-19.68,44.23,44.23,0,0,1,12.52-17.06q8.69-7.47,22.47-12.11t33.79-4.63a137.79,137.79,0,0,1,15.05.74q6.64.74,12.64,1.68t11.68,1.69a95.37,95.37,0,0,0,12.21.74,72.72,72.72,0,0,0,15.16-1.37A66.19,66.19,0,0,0,266,128.1q-.42,13.91-7,20.32T239,154.84a90.4,90.4,0,0,1-15.37-1.37q-8-1.36-16.63-3.26L179.68,277.33A100,100,0,1,0,198,79Z" transform="translate(-98 -79.01)"/></svg><div class="d-inline-block logo-text">Tckz</div></a>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-accent">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
