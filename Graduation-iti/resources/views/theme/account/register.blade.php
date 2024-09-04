@extends('theme.master')

@section('content')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action=" {{ route('account.registration.store')}}" method="POST" id="registerationForm">
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
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input value="{{ old('name')}}" type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            @error("name")
                            <span style="
                                color: #ff4d4d;
                                font-family: 'Montserrat', sans-serif;
                                font-size: 14px;
                                font-weight: bold;
                                margin-top: 5px;
                                display: block;">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                           <input value="{{ old('email')}}" type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                           @error("email")
                           <span style="
                               color: #ff4d4d;
                               font-family: 'Montserrat', sans-serif;
                               font-size: 14px;
                               font-weight: bold;
                               margin-top: 5px;
                               display: block;">
                               {{$message}}
                           </span>
                           @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input value="{{ old('password')}}" type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            @error("password")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                   </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input value="{{ old('confirm_password') }}" type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please confirm password">
                            @error("confirm_password")
                                    <span style="
                                        color: #ff4d4d;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin-top: 5px;
                                        display: block;">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn botton btn-primary mt-2">Register</button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a class="forget-register" href="{{route('account.login')}}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
  body {
      font-family: 'Montserrat', sans-serif !important;
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
  .forget-register{
      color: #0056b3;
  }
  /* Form Controls */
  .form-label {
      font-weight: 600 !important;
      margin-bottom: 8px !important;
  }

  .form-control {
      border-radius: 6px !important;
      padding: 12px !important;
      border: 1px solid #ced4da !important;
  }

  /* Buttons */
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

  /* Links */
  .link-primary {
      color: #007bff !important;
      text-decoration: none !important;
  }

  .link-primary:hover {
      text-decoration: underline !important;
  }

  /* Card Styles */
  .card {
      border-radius: 8px !important;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
  }

  /* Modal Styles */
  .modal-title {
      font-size: 18px !important;
      font-weight: 600 !important;
  }

  .modal-body {
      padding: 20px !important;
  }

</style>
@endsection
