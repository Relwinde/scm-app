
@extends('layouts.custom-master')

@section('styles')



@endsection

@section('content')

                    <div class="">
                        <div class="col col-login mx-auto mt-7">
                            <div class="text-center">
                                <a href="{{url('index')}}">
                                    <img src="{{asset('build/assets/images/brand/logo.png')}}" class="header-brand-img" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- CONTAINER OPEN -->
                        <div class="container-login100">
                            <div class="row">
                                <div class="col col-login mx-auto">
                                    <form class="card shadow-none" method="post">
                                        <div class="card-body p-6">
                                            <h3 class="text-center card-title">Mot de passe oublié</h3>
                                                <div class="wrap-input100 validate-input" data-validate = "Entrez un email valide: ex@abc.xyz">
                                                    <input class="input100" type="text" name="email" placeholder="Email">
                                                    <span class="focus-input100"></span>
                                                    <span class="symbol-input100">
                                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                                <div class="form-footer mt-4">
                                                    <a href="{{url('index')}}" class="btn btn-primary btn-block">Soumettre</a>
                                                </div>
                                                <div class="text-center text-muted mt-3 ">
                                                 <a href="{{url('login')}}">Revenir</a> sur la page de connexion.
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- CONTAINER CLOSED -->
                    </div>

@endsection

@section('scripts')



@endsection
