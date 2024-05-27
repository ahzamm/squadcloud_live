@extends('layouts/backend')
@section('page_title', 'Inner Page Setting')
@section('innerservice_select', 'active')
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
                        <h3 class="title-3 m-b-30">Top Inner Page Setting</h3>
                        <a href="{{ url('admin/innerpage_setting/manage_innerpage_setting') }}" >
                            <button type="button" class="btn btn-outline-success">Add inner Setting</button>
                        </a>
                        <hr/>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-top-campaign">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Title Image</th>
                                        <th>key</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                               @foreach($innersetting as $innersettings)

                                <tbody>

                                <td>{{$innersettings->id}}</td>
                                <td>{{$innersettings->title}}</td>
                                
                                <td>
                                    @if($innersettings->title_image !='')
                                    <a href="">
                                        <img width="50px" height="50px" src="{{ asset('storage/media/innerpagesetting/'. $innersettings->title_image) }}" />
                              
                                        @else
                                                        
                                     image not available    
                                                        
                                    @endif
                                    </td>
                                
                                <td>{{$innersettings->setting_key}}</td>

                
                                <td class="text-left">
                                @if($innersettings->status==1)
                                <a href="{{ url('admin/innerpage_setting/status/0')}}/{{ $innersettings->id }}">
                                    <button type="button" class="btn btn-outline-warning btn-sm">Enable</button>
                                </a>
                                @elseif($innersettings->status==0)
                                <a href="{{ url('admin/innerpage_setting/status/1')}}/{{ $innersettings->id }}">
                                    <button type="button" class="btn btn-outline-secondary btn-sm">Disable</button>
                                </a>
                                @endif
                        
                                <a href="{{ url('admin/innerpage_setting/manage_innerpage_setting/')}}/{{ $innersettings->id }}">
                                <button type="button" class="btn btn-outline-info btn-sm">Update</button>
                                </a>
                                <a href="{{ url('admin/innerpage_setting/delete/')}}/{{ $innersettings->id }}">
                                 <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
                                </a>
                                </td>
                                 

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