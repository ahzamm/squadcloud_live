@extends('layouts/backend')
@section('page_title', 'Home Page Setting')
@section('setting_select', 'active')
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
                                    <h3 class="title-3 m-b-30">top settings</h3>
                                    <a href="{{ url('admin/setting/manage_setting') }}">
                                        <button type="button" class="btn btn-outline-success">Add setting</button>
                                    </a>
                                    <hr/>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-top-campaign">
                                           
                                           <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>TITLE</th>
                                                    <th>SLUG</th>
                                                    <th>KEY</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                            @forelse($homeSetting as $setting)
                                                <tr>
                                                <td>{{$setting->id}}</td>
                                                    <td>{{$setting->title}}</td>
                                                    <td>{{$setting->slug}}</td>
                                                    <td>{{$setting->key}}</td>

                                                    <td class="text-left">
                                                        @if($setting->status==1)
                                                        <a href="{{ url('admin/setting/status/0')}}/{{ $setting->id }}">
                                                            <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                                        </a>
                                                        @elseif($setting->status==0)
                                                        <a href="{{ url('admin/setting/status/1')}}/{{ $setting->id }}">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                                        </a>
                                                        @endif
                                                        <a href="{{ url('admin/setting/manage_setting/')}}/{{ $setting->id }}">
                                                            <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                                        </a>
                                                        <a href="{{ url('admin/setting/delete/')}}/{{ $setting->id }}">
                                                            <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <div class="alert alert-danger">No record found!</div>
                                                  @endforelse
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