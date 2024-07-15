@extends('layouts/backend')
@section('page_title', 'Contact_form  ')
@section('contact_select', 'active')
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
                                    <h3 class="title-3 m-b-30">top contacts</h3>
                                    <!-- <a href="{{ url('admin/contact_forms/manage_contact') }}" >
                                        <button type="button" class="btn btn-outline-success">Add contact</button>
                                    </a> -->
                                    <!-- <hr/> -->
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach($contactform as $list)
                                                <tr>
                                                    <td>{{ $list->id }}</td>
                                                    <td>{{ $list->full_name }}</td>
                                                    <td>{{ $list->email }}</td>
                                                    <td>{{ $list->phone_number }}</td>
                                                    
                                                    <td class="text-left">
                                                        @if($list->status==1)
                                                        <a href="{{ url('admin/contact_forms/status/0')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                                        </a>
                                                        @elseif($list->status==0)
                                                        <a href="{{ url('admin/contact_forms/status/1')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                                        </a>
                                                        @endif
                                                        
                                                        <a href="{{ url('admin/contact_forms/show/')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-info btn-sm">Show</button>
                                                        </a>

                                                        <a href="{{ url('admin/contact_forms/delete/')}}/{{ $list->id }}">
                                                            <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                                        </a>
                                                    </td>
                                                </tr>
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
    $('#myTable').DataTable();
} );
</script>
@endpush