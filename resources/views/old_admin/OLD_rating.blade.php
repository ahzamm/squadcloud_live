@extends('layouts/backend')
@section('page_title', 'rating')
@section('rating_select', 'active')
@section('content')


<!-- ! Main -->
<main class="main users chart-page" id="skip-target">
  <div class="container">
    <h1 class="main-title text-center">Rating Details</h1>
    <section class="ftco-section">

      <div class="container">
        @if(session('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
          <span class="badge badge-pill badge-success">Success</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          {{session('message')}}

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        @endif


        <div class="row">
          <a href="{{ url('admin/rating/manage_rating') }}" class="btn btn-success">Add Section <i class="fa fa-plus"></i></a>
          <div class="col-md-6 text-center mb-5">

            <!-- <h2 class="heading-section">Table</h2> -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="table-wrap">
              <table class="table table-striped">
                <div class="table-responsive">
                  <table id="myTable" class="table table-top-campaign">

                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>SLUG</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($rating as $list)
                    <tbody>

                      <td>{{$list->id}}</td>
                      <td>{{$list->Linkproduct->title}}</td>
                      <td>{{$list->slug}}</td>


                      <td>
                        @if($list->status==1)
                        <a href="{{ url('admin/rating/status/0')}}/{{ $list->id }}" class="btn btn-primary">Enable</a>

                        @elseif($list->status==0)
                        <a href="{{ url('admin/rating/status/1')}}/{{ $list->id }}" class="btn btn-secondary">Disable</a>

                        @endif
                        <a href="{{ url('admin/rating/manage_rating/')}}/{{ $list->id }}" class="btn btn-warning">Update</a>

                        <a href="{{ url('admin/rating/delete/')}}/{{ $list->id }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete
                          <!-- <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm"></button> -->
                        </a>
                      </td>

                    </tbody>

                    @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
    </section>
    <div class="row">


    </div>
  </div>
</main>

@endsection()

@push('scripts')
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>
@endpush