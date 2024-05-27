@extends('layouts/backend')
@section('page_title', 'Feature')
@section('feature_select', 'active')
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
                                    <h3 class="title-3 m-b-30">top features</h3>
                                    <a href="{{ url('admin/feature/manage_feature') }}" >
                                        <button type="button" class="btn btn-outline-success">Add feature</button>
                                    </a>
                                    <hr/>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-top-campaign">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>PRODUCT NAME</th>
                                                    <th>FEATURE</th>
                                                    <th>SLUG</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                @foreach($data as $list)
                                                <tr>
                                                    <td>{{ $list->id }}</td>
                                                    <td>{{ $list->linkProduct->product_name }}</td>
                                                    <td>{{ $list->feature }}</td>
                                                    <td>{{ $list->slug }}</td>
                                                   
                                                    <td class="text-left">
                                                        @if($list->status==1)
                                                        <a href="{{ url('admin/feature/status/0')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                                        </a>
                                                        @elseif($list->status==0)
                                                        <a href="{{ url('admin/feature/status/1')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                                        </a>
                                                        @endif
                                                        <a href="{{ url('admin/feature/manage_feature/')}}/{{ $list->id }}">
                                                            <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                                        </a>
                                                        <a href="{{ url('admin/feature/delete/')}}/{{ $list->id }}">
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