@extends('layouts/backend')
@section('page_title', 'Product')
@section('Product_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        <h1 align="center" class="main-title">Product Detail</h1>
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
              
    <a href="{{ url('admin/slider/manage_slider') }}" class="btn btn-success">Add Section <i class="fa fa-plus"></i></a>
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
                        <th class="text-left">Product Name</th>
                        <th>price</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th class="text-center">Action</th>
                        
                      </tr>
                    </thead>
                   
                    <tbody>
                    @foreach($data as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->product_name }}</td>
                            <td>{{ $list->price }}</td>
                            <td>{{ $list->linkProductClass->title }}</td>
                            <td>
                                @if($list->img_2 !='')
                                <a href="{{$list->link}}">
                                    <img width="50px" height="50px" src="{{ asset('storage/media/product/img2/'. $list->img_2) }}" />
                                </a>
                                
                                @else
                                
                                image not available    
                                
                                @endif
                            </td>
                            <td class="text-left">
                            @if($list->status==1)
                             <a href="{{ url('admin/product/status/0')}}/{{ $list->id }}" class="btn btn-primary">Enable</a>

                             @elseif($list->status==0)
                             <a href="{{ url('admin/product/status/1')}}/{{ $list->id }}" class="btn btn-primary">Disable</a>
                             
                             @endif
                             <a href="{{ url('admin/product/manage_product/')}}/{{ $list->id }}" class="btn btn-warning">Update</a>

                             <a href="{{ url('admin/product/delete/')}}/{{ $list->id }}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete
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