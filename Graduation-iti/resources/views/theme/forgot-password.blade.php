@extends('theme.master')

@section('content')

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Forgot Password</h1>
                    <form action="{{ route('account.proccessForgetPassword') }}" method="POST">
                        @csrf
                        @if (session('success'))
                            <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #d1e7dd;
                                background-color: #d1e7dd;
                                color: #0f5132;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div style="
                                padding: 15px;
                                margin-bottom: 20px;
                                border: 1px solid #f8d7da;
                                background-color: #f8d7da;
                                color: #721c24;
                                border-radius: 5px;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 16px;
                                text-align: center;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control" placeholder="example@example.com">
                            @error("email")
                                <span style="
                                    color: #ff4d4d;
                                    font-family: 'Montserrat', sans-serif;
                                    font-size: 14px;
                                    font-weight: bold;
                                    margin-top: 5px;
                                    display: block;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="justify-content-between d-flex">
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Do not have an account? <a href="{{ route('account.login') }}">Back to Login</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>

@endsection
