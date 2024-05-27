@extends('layouts/backend')
@section('page_title', 'Dashboard')
@section('dashboard_select', 'active')
@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <!-- STATISTIC-->
                        <section class="statistic">
                            <div class="section__content section__content--p30">
                                <div class="container-fluid">
                                	
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <div class="statistic__item">
                                                <a href="{{ url('admin/blog') }}">
                                                <h2 class="number">{{ $blog }}</h2>
                                                <span class="desc">blogs online</span>
                                                <div class="icon">
                                                    <i class="zmdi zmdi-calendar-note"></i>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="statistic__item">
                                                <a href="{{ url('admin/client') }}">
                                                <h2 class="number">{{ $client }}</h2>
                                                <span class="desc">consist clients</span>
                                                <div class="icon">
                                                    <i class="zmdi zmdi-account-o"></i>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="statistic__item">
                                                <a href="{{ url('admin/product') }}">
                                                <h2 class="number">{{ $product }}</h2>
                                                <span class="desc">our products</span>
                                                <div class="icon">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="statistic__item">
                                                <a href="{{ url('admin/services') }}">
                                                <h2 class="number">{{ $services }}</h2>
                                                <span class="desc">total services</span>
                                                <div class="icon">
                                                    <i class="zmdi zmdi-money"></i>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- END STATISTIC-->
                    </div> 
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection()