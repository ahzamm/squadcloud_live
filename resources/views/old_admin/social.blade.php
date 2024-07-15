@extends('layouts/backend')
@section('page_title', 'social')
@section('social_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        
      <section class="ftco-section">    
          <div class="container">
            
            <div class="eedit-btn">
            <h1 align="center" class="main-title">Social Details</h1>

               <a href="{{ url('admin/social/manage_social') }}" data-toggle="tooltip" title="insert record" class="btn btn-success" ><i class="fa fa-plus"></i></a>            
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
	    <!-- <a href="{{ url('admin/social/manage_social') }}" class="btn btn-success"><i class="fa fa-plus"></i></a> -->
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
                    <th>LINK</th>
                    <th>IMAGE</th>
                    <th>ACTION</th>
                    </tr>
                </thead>                   
                    <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{ $list->id }}</td>
                        <td>{{ $list->title }}</td>
                        <td>{{ $list->link }}</td>
                        <td>
                            @if($list->image !='')
                            <a href="{{$list->link}}">
                                <img width="50px" src="{{ asset('storage/media/social/'. $list->image) }}" />
                            </a>
                            @else                
                            	image not available    
                            @endif
                        </td>
                        <td>
                          @if($list->status==1)
                          <a href="{{ url('admin/social/status/0')}}/{{ $list->id }}" class="btn btn-warning">Enable</a>
                          @elseif($list->status==0)
                          <a href="{{ url('admin/social/status/1')}}/{{ $list->id }}" class="btn btn-secondary">Disable</a>
                          @endif
                          <a href="{{ url('admin/social/manage_social/')}}/{{ $list->id }}" class="btn btn-primary">Update</a>
                          <a href="{{ url('admin/social/delete/')}}/{{ $list->id }}"
                              onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete
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