@extends('layouts/backend')
@section('page_title', 'Service')
@section('Service_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        <h1 align="center" class="main-title">Services Detail</h1>
        <section class="ftco-section">
         
        
        <div class="container">
        @if(session('message'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
		<span class="badge badge-pill badge-success">Success</span>
		{{session('message')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
		</div>
       @endif
 <div class="row">
              
    <a href="{{ url('admin/services/manage_services') }}" class="btn btn-success">Add Service<i class="fa fa-plus"></i></a>
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
                        <th>SERVICE HEADING</th>
                        <th>SERVICE ICON</th>
                        <th>Keyword</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                     </thead>
                   
                    <tbody>
                    @foreach($data as $list)
                    <tr>
                     <td>{{ $list->id }}</td>
                     <td>{{ $list->heading }}</td>
                     <td>
                         @if($list->icon !='')
                             
                             <img width="50px" src="{{ asset('storage/media/services/icon/'. $list->icon) }}" />
                         
                         @else
                         
                             icon not available    
                         
                         @endif
                     </td>
                     <td>{{ $list->keyword }}</td>
                     
                     <td class="text-left">
                            @if($list->status==1)
                             <a href="{{ url('admin/services/status/0')}}/{{ $list->id }}" class="btn btn-primary">Enable</a>

                             @elseif($list->status==0)
                             <a href="{{ url('admin/services/status/1')}}/{{ $list->id }}" class="btn btn-secondary">Disable</a>
                             
                             @endif
                             <a href="{{ url('admin/services/manage_services/')}}/{{ $list->id }}" class="btn btn-warning">Update</a>

                             <a href="{{ url('admin/services/delete/')}}/{{ $list->id }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete
                            <!-- <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm"></button> -->
                          </a>
                            </td>
                 </tr>
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
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endpush   