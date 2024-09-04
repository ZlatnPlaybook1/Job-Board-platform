@extends('theme.master')

@section('content')


<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Login</h1>
                    <form action="{{ route('account.login.authenticate') }}" method="POST">
                        @csrf
                        @if (session('status'))
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

                        @if ($errors->has('login'))
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
                                {{ $errors->first('login') }}
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
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" value="{{ old('password') }}" name="password" id="password" class="form-control" placeholder="Enter Password">
                            @error("password")
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
                            <button type="submit" class="btn botton btn-primary mt-2">Login</button>
                            <a href="{{ route('account.forgotPassword')}}" class="mt-3 forget-register">Forgot Password?</a>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p >Do not have an account? <a class="forget-register" href="{{ route('account.registration') }}">Register</a></p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>


<style>
  body {
      font-family: 'Montserrat', sans-serif;
  }
  .alert {
      padding: 15px !important;
      border-radius: 5px !important;
      font-size: 16px !important;
      text-align: center !important;
  }
  .alert-success {
      background-color: #d1e7dd !important;
      border: 1px solid #d1e7dd !important;
      color: #0f5132 !important;
  }
  .alert-danger {
      background-color: #f8d7da !important;
      border: 1px solid #f8d7da !important;
      color: #721c24 !important;
  }
  .form-label {
      font-weight: 600 !important;
      margin-bottom: 8px !important;
  }
  .form-control {
      border-radius: 6px !important;
      padding: 12px !important;
      border: 1px solid #ced4da !important;
  }
  .botton {
      background-color: #007bff !important;
      color: #fff !important;
      border: 1px solid #007bff !important;
      border-radius: 6px !important;
      padding: 12px 24px !important;
      font-size: 14px !important;
      font-weight: 600 !important;
      text-transform: uppercase !important;
      transition: background-color 0.3s ease, transform 0.3s ease !important;
  }
  .botton:hover {
      background-color: #0056b3 !important;
      transform: scale(1.05) !important;
  }
  .forget-register{
    color: #0056b3;
  }
  .link-primary {
      color: #007bff !important;
      text-decoration: none !important;
  }
  .link-primary:hover {
      text-decoration: underline !important;
  }
  .card {
      border-radius: 8px !important;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
  }
</style>
@endsection
