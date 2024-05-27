@extends('layouts/backend')
@section('page_title', 'rating')
@section('rating_select', 'active')
@section('content')

    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        
        <section class="ftco-section">    
          <div class="container">
            
        
            <div class="eedit-btn">
            <h1 align="center" class="main-title">Ratings</h1>
               <a href="{{ url('admin/rating/manage_rating') }}" data-toggle="tooltip" title="insert record" class="btn btn-success" ><i class="fa fa-plus"></i></a>            
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
              <div class="col-md-12">
                <div class="table-wrap">
                  <table class="table table-striped">
                   
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>SLUG</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                 
                    @foreach($rating as $list)
                     <tbody>

                      <td>{{$list->id}}</td>
                      <td>{{$list->Linkproduct->product_name}}</td>
                      <td>{{$list->slug}}</td>
                      <td>
                        @if($list->status==1)
                         <a href="{{ url('admin/rating/status/0')}}/{{ $list->id }}" data-toggle="tooltip" title="Status" class="btn btn-warning">Enable</a>
                        @elseif($list->status==0)
                         <a href="{{ url('admin/rating/status/1')}}/{{ $list->id }}" data-toggle="tooltip" title="Status" class="btn btn-secondary">Disable</a>                    
                        @endif
                         <a href="{{ url('admin/rating/manage_rating/')}}/{{ $list->id }}" data-toggle="tooltip" title="Edit" class="btn btn-primary">Update</a>
                         <a href="{{ url('admin/rating/delete/')}}/{{ $list->id }}" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete" class="btn btn-danger">Delete
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