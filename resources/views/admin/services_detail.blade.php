@extends('layouts/backend')
@section('page_title', 'Services Detail')
@section('services Detail_select', 'active')
@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- TOP CAMPAIGN-->
                                @if(session('message'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
											<span class="badge badge-pill badge-success">Success</span>
											{{session('message')}}
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
                                @endif
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30">Top Services Detail</h3>
                                    <a href="{{ url('admin/service_detail/manage_service_detail') }}" >
                                        <button type="button" class="btn btn-outline-success">Add Services Detail</button>
                                    </a>
                                    <hr/>
                                    <div class="table-responsive">
                                        <table id="rating" class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Slug</th>
                                                    <th>Description</th>
                                                    <th>Text Field</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                        
                                            @foreach($servicesdetail as $servicesdetails)

                                            <tbody>

                                            <td>{{$servicesdetails->id}}</td>
                                            <td>{{$servicesdetails->title}}</td>
                                            <td>{{$servicesdetails->slug}}</td>
                                            <td>{{$servicesdetails->description}}</td>
                                            <td>{{$servicesdetails->text_field}}</td>
                                            
                                        
                                            <td class="text-left">
                                            @if($servicesdetails->status==1)
                                            <a href="{{ url('admin/service_detail/status/0')}}/{{ $servicesdetails->id }}">
                                                <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                            </a>
                                            @elseif($servicesdetails->status==0)
                                            <a href="{{ url('admin/service_detail/status/1')}}/{{ $servicesdetails->id }}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                            </a>
                                            @endif
                                    
                                            <a href="{{ url('admin/service_detail/manage_service_detail/')}}/{{ $servicesdetails->id }}">
                                            <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                            </a>
                                            <a href="{{ url('admin/service_detail/delete/')}}/{{ $servicesdetails->id }}">
                                             <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </a>
                                            </td>
                                             
    
                                           </tbody>

                                           @endforeach

                                           

                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--  END TOP CAMPAIGN-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection()

@push('scripts')
<script>
$(document).ready( function () {
    $('#rating').DataTable();
});
</script>
@endpush