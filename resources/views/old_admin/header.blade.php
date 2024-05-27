@extends('layouts/backend')
@section('page_title', 'Header')
@section('header_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        
      <section class="ftco-section">    
          <div class="container">
            
            <div class="eedit-btn">
            <h1 align="center" class="main-title">Header Details</h1>

               <a href="{{ url('admin/header/manage_header') }}" data-toggle="tooltip" title="insert record" class="btn btn-success" ><i class="fa fa-plus"></i></a>            
            </div>
        
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
              <!-- <a href="{{ url('admin/header/manage_header') }}" data-toggle="tooltip" title="insert record" class="btn btn-success"><i class="fa fa-plus"></i></a> -->
              <!-- <div class="col-md-6 text-center mb-5"> -->
                <!-- <h2 class="heading-section">Table</h2> -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="table-wrap">
                  <table class="table table-striped">
                  
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tbody>
                    @foreach($header as $headers)   
                    <tr>
                        <th scope="row">{{$headers->id}}</th>
                        <td>{{$headers->title}}</td>
                        <td>{{$headers->sub_title}}</td>
                        <td>
                        @if($headers->img_4 !='')
                        <a href="{{$headers->img_4}}">
                                 <img style="width:30px; height:30px; border-radius:30px;" src="{{ asset('storage/media/header/img4/'. $headers->img_4) }}" /> 
                         </a>
                          @else               
                           image not available            
                          @endif    
                        </td>
                       
                        <td>
                         @if($headers->status==1)
                        <a href="{{ url('admin/header/status/0')}}/{{ $headers->id }}" data-toggle="tooltip" title="Status" class="btn btn-warning">Enable</a>
                        @elseif($headers->status==0)
                          <a href="{{ url('admin/header/status/1')}}/{{ $headers->id }}" data-toggle="tooltip" title="Status" class="btn btn-secondary">Disable</a>
                          @endif
                          <a href="{{ url('admin/header/manage_header/')}}/{{ $headers->id }}" data-toggle="tooltip" title="Edit" class="btn btn-primary">Update</a>

                          <a href="{{ url('admin/header/delete/')}}/{{ $headers->id }}" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                       @endforeach              
                    </tbody>

                  </table>
                
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