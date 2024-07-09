@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
  <style>
    .custom-card-height {
      height: 280px;
      overflow-y: auto;
    }
    .small-box .icon svg {
    font-size: 70px;
    top: 20px;
    position: absolute;
    right: 15px;
    transition: all .3s linear;
}
  </style>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><span><i class="fas fa-chart-pie"></i></span> Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <a href="{{ route('services.index') }}" class="small-box-footer">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $serviceCount }}</h3>
                  <p>Services</p>
                </div>
                <div class="icon">
                  <i class="fa fa-gears"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('portfolios.index') }}" class="small-box-footer">
              <div class="small-box bg-orange">
                <div class="inner">
                  <h3>{{ $portfolioCount }}</h3>
                  <p>Portfolios</p>
                </div>
                <div class="icon">
                  <i class="fa fa-podcast"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('clients.index') }}" class="small-box-footer">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $clientCount }}</h3>
                  <p>Clients</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users-viewfinder"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('products.index') }}">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $productCount }}</h3>
                  <p>Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-navigate"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('subscribers.index') }}" class="small-box-footer">
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>{{ $subscriberCount }}</h3>
                  <p>
                    Subscribers
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('job_applications.index') }}" class="small-box-footer">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3>{{ $JobApplicationCount }}</h3>
                  <p>
                    Job Application
                  </p>
                </div>
                <div class="icon">
                  <i class="fa fa-paperclip"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('jobs.index') }}" class="small-box-footer">
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>{{ $social }}</h3>
                  <p>
                    Job Post
                  </p>
                </div>
                <div class="icon">
                  <i class="fa fa-graduation-cap"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a href="{{ route('user.index') }}" class="small-box-footer">
              <div class="small-box bg-indigo">
                <div class="inner">
                  <h3>{{ $user }}</h3>
                  <p>
                    Site Managment Users
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-settings"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-phone mr-1"></i>
                  Today's Contact Requests
                </h3>
              </div>
              <div class="card-body custom-card-height">
                <table class="table table-bordered table-striped" style="cursor:pointer">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($todaysContactRequests as $key => $item)
                      <tr onclick="openInNewTab('contact');">
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->message }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa-solid fa-bell"></i>
                  Today's Job Applications
                </h3>
              </div>
              <div class="card-body custom-card-height">
                <div class="row">
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active" id="revenue-chart" role="tabpanel" aria-labelledby="v-pills-reseller-tab">
                        <div class="table-responsive">
                          <table class="table table-bordered table-striped" style="cursor:pointer">
                            <thead>
                              <tr>
                                <th>Serial#</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Contact Number</th>
                                <th>Resume</th>
                                <th>Date & time</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($jobApplication as $key => $item)
                                <tr onclick="openInNewTab('coveragerequest');">
                                  <td>{{ ++$key }}</td>
                                  <td>{{ $item->name }}</td>
                                  <td>{{ $item->email }}</td>
                                  <td>{{ $item->phone }}</td>
                                  <td>
                                    <a href="{{ asset('backend/resumes/' . $item->resume) }}" class="btn btn-primary btn-sm" download>
                                      <i class="fa fa-download"></i> Download
                                    </a>
                                  </td>
                                  <td>{{ $item->created_at }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection
