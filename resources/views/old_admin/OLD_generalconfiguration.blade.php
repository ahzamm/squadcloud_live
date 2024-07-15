@extends('layouts/backend')
@section('page_title', 'general configuration')
@section('general configuration_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        <h1 align="center" class="main-title">General Configuration Detail</h1>
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
     <a href="{{ url('admin/general_configuration/manage_general_configuration')}}" class="btn btn-success">Add General Configuration <i class="fa fa-plus"></i></a>
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
                        <th>Site Title</th>
                        <th>Site Logo</th>
                        <th>Fav Icon</th>
                        <th>Action</th>
                    </tr>
                     </thead>
                   
                    <tbody>
                    @foreach($GeneralConfiguration as $GeneralConfigurations)

                            <td>{{$GeneralConfigurations->id}}</td>
                            <td>{{$GeneralConfigurations->site_title}}</td>

                            <td>
                            @if($GeneralConfigurations->site_logo !='')
                            
                            <a href="#">
                                <img style="width:30px; height:30px; border-radius:30px;" src="{{ asset('storage/media/generalconfigurationl/img1/'. $GeneralConfigurations->site_logo) }}" />                           
                            </a>
                            @else     
                                image not available          
                            @endif                       
                            </td>
                            
                            <td>
                                @if($GeneralConfigurations->fav_icon !='')
                            <a href="#">
                                <img style="width:30px; height:30px; border-radius:30px;" src="{{ asset('storage/media/generalconfigurationl/img2/'. $GeneralConfigurations->fav_icon) }}" />      
                            </a>
                                @else       
                                    image not available             
                                @endif                       
                            </td>
                            <td class="text-left">
                                @if($GeneralConfigurations->status==1)
                                <a href="{{ url('admin/general_configuration/status/0')}}/{{$GeneralConfigurations->id}}">
                                    <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                </a>
                                @elseif($GeneralConfigurations->status==0)
                                <a href="{{ url('admin/general_configuration/status/1')}}/{{ $GeneralConfigurations->id }}">
                                    <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                </a>
                                @endif

                                <a href="{{ url('admin/general_configuration/manage_general_configuration')}}/{{$GeneralConfigurations->id}}">
                                <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                </a>
                                <a href="{{ url('admin/general_configuration/delete/')}}/{{ $GeneralConfigurations->id }}">
                                <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
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
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endpush   