
@extends('layouts.custom-master')

@section('styles')



@endsection

@section('content')

                <div class="">
                    <!-- CONTAINER OPEN -->
                    <div class="col col-login mx-auto mt-7">
                        <div class="text-center">
                            <a href="{{url('index')}}">
                                <img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="container-login100">
                        <div class="wrap-login100 p-6">
                            <form class="login100-form validate-form">
                                <span class="login100-form-title">
                                    Login
                                </span>
                                <div class="wrap-input100 validate-input mb-4" data-validate = "Valid email is required: ex@abc.xyz">
                                    <input class="input100" type="text" name="email" placeholder="Email">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                    <input class="input100" type="password" name="pass" placeholder="Password">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="text-end pt-1">
                                    <p class="mb-0"><a href="{{url('forgot-password')}}" class="text-primary ms-1">Forgot Password?</a></p>
                                </div>
                                <div class="container-login100-form-btn">
                                    <a href="{{url('index')}}" class="login100-form-btn btn-primary">
                                        Login
                                    </a>
                                </div>
                                <div class="text-center pt-3">
                                    <p class="text-dark mb-0">Not a member?<a href="{{url('register')}}" class="text-primary mx-1">Sign UP now</a></p>
                                </div>
                                <div class=" flex-c-m text-center mt-3">
                                    <p>Or</p>
                                    <div class="social-icons">
                                        <ul>
                                            <li><a class="btn  btn-social btn-block"><i class="fa fa-google-plus text-google-plus"></i> Sign up with Google</a></li>
                                            <li><a class="btn  btn-social btn-block mt-2"><i class="fa fa-facebook text-facebook"></i> Sign in with Facebook</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>

@endsection

@section('scripts')



@endsection
