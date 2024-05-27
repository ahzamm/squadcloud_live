@extends('layouts/backend')
@section('page_title', 'Header')
@section('header_select', 'active')
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
                                    <h3 class="title-3 m-b-30">Top Header</h3>
                                    <a href="{{ url('admin/header/manage_header') }}" >
                                        <button type="button" class="btn btn-outline-success">Add Header</button>
                                    </a>
                                    <hr/>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-top-campaign">
                                          
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
                                            <td>{{$headers->id}}</td>
                                            <td>{{$headers->title}}</td>
                                            <td>{{$headers->sub_title}}</td>
                                            <td>
                                            @if($headers->img_4 !='')
                                                <a href="#">
                                                    <img style="width:30px; height:30px; border-radius:30px;" src="{{ asset('storage/media/header/img4/'. $headers->img_4) }}" /> 
                                                </a>
                                            @else               
                                                image not available            
                                            @endif                       
                                            </td>

                                            <td class="text-left">
                                            @if($headers->status==1)
                                            <a href="{{ url('admin/header/status/0')}}/{{ $headers->id }}">
                                                <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                            </a>
                                            @elseif($headers->status==0)
                                            <a href="{{ url('admin/header/status/1')}}/{{ $headers->id }}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                            </a>
                                            @endif
                                            <a href="{{ url('admin/header/manage_header/')}}/{{ $headers->id }}">
                                                <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                            </a>
                                            <a href="{{ url('admin/header/delete/')}}/{{ $headers->id }}">
                                                <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </a>
                                            </td>      
                                                </tr>
                                        </tbody>
                                             @endforeach
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