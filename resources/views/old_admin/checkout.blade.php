@extends('layouts/backend')
@section('page_title', 'checkout')
@section('checkout_select', 'active')
@section('content')


    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
        
        <section class="ftco-section">
         
                 <div class="container">
                 <h1 align="center" class="main-title">Checkout Detail</h1>
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
                                                <th>productname</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Action</th>
                                               </tr>
                                                </thead>
                   
                                                <tbody>
                                                @foreach($checkoutdata as $list)
                                                <tr>
                                                    <td>{{ $list->id }}</td>
                                                    <td>{{ $list->first_name }}</td>
                                                    <td>{{ $list->email }}</td>
                                                    <td>{{ $list->phone }}</td>
                                                    <td>
                                                    @if($list->status==1)
                                                    <a href="{{ url('admin/checkout/status/0')}}/{{ $list->id }}" class="btn btn-warning">Enable</a>
                                                           
                                                    @elseif($list->status==0)
                                                    <a href="{{ url('admin/checkout/status/1')}}/{{ $list->id }}" class="btn btn-secondary">Disable</a>
                                                          
                                                    @endif
                                                    <a href="{{ url('admin/checkout/manage_checkout/')}}/{{ $list->id }}" class="btn btn-primary">Update</a>

                                                    <a href="{{ url('admin/checkout/delete/')}}/{{ $list->id }}"
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