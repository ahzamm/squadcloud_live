@extends('layouts/backend')
@section('page_title', 'portfolio')
@section('portfolio_select', 'active')
@section('content')


    <!-- ! Main -->
<main class="main users chart-page" id="skip-target">
      <div class="container">
        <h1 align="center" class="main-title">portfolio Detail</h1>
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
              
    <a href="{{ url('admin/portfolio/manage_portfolio') }}" class="btn btn-success">Add portfolio<i class="fa fa-plus"></i></a>
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
                    <th>PORTFOLIO HEADING</th>
                    <th>KEYWORD</th>
                    <th>IMAGE</th>
                    <th>ACTION</th>
                    </tr>
                </thead>
                   
                    <tbody>
                    @foreach($data as $list)
                     <tr>
                         <td>{{ $list->id }}</td>
                         <td>{{ $list->heading }}</td>
                         <td>{{ $list->keyword }}</td>
                         <td>
                             @if($list->image !='')
                             <a href="{{$list->link}}">
                                 <img width="50px" src="{{ asset('storage/media/portfolio/'. $list->image) }}" />
                             </a>
                             
                             @else
                             
                             image not available    
                             
                             @endif
                         </td>
                         <td class="text-left">
                             @if($list->status==1)
                             <a href="{{ url('admin/portfolio/status/0')}}/{{ $list->id }}">
                                 <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                             </a>
                             @elseif($list->status==0)
                             <a href="{{ url('admin/portfolio/status/1')}}/{{ $list->id }}">
                                 <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                             </a>
                             @endif
                             <a href="{{ url('admin/portfolio/manage_portfolio/')}}/{{ $list->id }}">
                                 <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                             </a>
                             <a href="{{ url('admin/portfolio/delete/')}}/{{ $list->id }}">
                                 <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
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