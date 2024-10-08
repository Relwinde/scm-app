
@extends('layouts.master')

@section('styles')



@endsection

@section('content')

                            <!-- PAGE-HEADER -->
                            <div class="page-header">
                                <h1 class="page-title">Progress</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Advanced Ui</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Progress</li>
                                </ol>
                            </div>
                            <!-- PAGE-HEADER END -->

                            <!-- ROW-1 OPEN -->
                            <div class="row">
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Basic Progress</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-primary w-10"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-primary w-20"></div>
                                                </div>
                                                <div class="progress progress-md mb-3 ">
                                                    <div class="progress-bar bg-primary w-40"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-primary  w-60" ></div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-primary  w-80"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Contextual Progress</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-pink w-10"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-green w-20"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-yellow w-40"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-blue w-60"></div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-orange w-80"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Basic Progress with label</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-primary w-10">10%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-secondary w-20"> 20%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-success w-40"> 40%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-warning  w-60"> 60%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-info w-80"> 80%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Contextual Progress with label</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-pink w-10"> 7%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-green w-20">20%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-yellow w-40" >40%</div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-blue w-60">60%</div>
                                                </div>
                                                <div class="progress progress-md ">
                                                    <div class="progress-bar bg-orange w-80"> 80%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                            </div>
                            <!-- ROW-1 OPEN -->

                            <!-- ROW-2 OPEN -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Progress Sizes</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-xs mb-3">
                                                    <div class="progress-bar bg-blue w-30"></div>
                                                </div>
                                                <div class="progress progress-sm mb-3">
                                                    <div class="progress-bar bg-blue w-60"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-blue w-70"></div>
                                                </div>
                                                <div class="progress progress-lg">
                                                    <div class="progress-bar bg-blue w-80"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Mixed color Progress with Sizes</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-xs mb-3">
                                                    <div class="progress-bar bg-orange w-5"></div>
                                                    <div class="progress-bar bg-warning w-5"></div>
                                                    <div class="progress-bar bg-info w-5"></div>
                                                </div>
                                                <div class="progress progress-sm mb-3">
                                                    <div class="progress-bar bg-pink w-10"></div>
                                                    <div class="progress-bar bg-yellow w-15"></div>
                                                    <div class="progress-bar bg-teal w-15"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar bg-pink w-15"></div>
                                                    <div class="progress-bar bg-blue w-20"></div>
                                                    <div class="progress-bar bg-cyan w-30"></div>
                                                </div>

                                                <div class="progress progress-lg">
                                                    <div class="progress-bar bg-green w-30"></div>
                                                    <div class="progress-bar bg-pink w-20"></div>
                                                    <div class="progress-bar bg-orange w-40"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                            </div>
                            <!-- ROW-2 CLOSED -->

                            <!-- ROW-3 OPEN -->
                            <div class="row">
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Striped Progress</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated w-10"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-blue-1 w-20"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-yellow-1 w-40">50%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-green-1 w-60">40%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                                <div class="col-xl-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Animated Progress</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="example">
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-indeterminate bg-pink" ></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-indeterminate bg-yellow-1"></div>
                                                </div>
                                                <div class="progress progress-md mb-3">
                                                    <div class="progress-bar progress-bar-indeterminate bg-blue-1"></div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar progress-bar-indeterminate bg-purple-1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL-END -->
                            </div>
                            <!-- ROW-3 CLOSED -->

@endsection

@section('scripts')



@endsection
