@extends('layouts/backend')
@section('page_title', 'About')
@section('about_select', 'active')
@section('content')



    <!-- ! Main -->
    <main class="main users chart-page" id="skip-target">
      <div class="container">
      <section class="ftco-section">    
          <div class="container">
            
            <div class="eedit-btn">
            <h1 align="center" class="main-title">About</h1>

               <a href="{{ url('admin/about/manage_about') }}" data-toggle="tooltip" title="insert record" class="btn btn-success" ><i class="fa fa-plus"></i></a>            
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
                                 <!-- <a href="{{ url('admin/about/manage_about') }}"class="btn btn-success"><i class="fa fa-plus"></i></a> -->
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
                                                    <th>ICON</th>
                                                    <th>TITLE</th>
                                                    <th>SLUG</th>
                                                   <th>ACTION</th>
                                               </tr>
                                                </thead>
                   
                                                <tbody>
                                                @foreach($data as $list)   
                                                       <tr>
                                                        <th scope="row">{{ $list->id }}</th>
                                                        
                                                        <td> @if($list->icon_2  != '')
                                                        <a href="#">
                                                         <img width="50px" src="{{ asset('storage/media/about/icon_2/'. $list->icon_2) }}" />
                                                        </a>
                                                        @else               
                                                        image not available 
                                                         @endif
                                                        </td>
                                                       
                                                        <td>{{ $list->title_2 }}</td>
                                                       
                                                        <td>{{ $list->slug }} </td>
                                                         
                                                        </td>
                                                        
                                                     
                                                        <td>
                                                            @if($list->status==1)
                                                            <a href="{{ url('admin/about/status/0')}}/{{ $list->id }}" class="btn btn-warning">Enable</a>
                                                           
                                                            @elseif($list->status==0)
                                                            <a href="{{ url('admin/about/status/1')}}/{{ $list->id }}" class="btn btn-secondary">Disable</a>
                                                          
                                                            @endif
                                                            <a href="{{ url('admin/about/manage_about/')}}/{{ $list->id }}" class="btn btn-primary">Update</a>

                                                            <a href="{{ url('admin/about/delete/')}}/{{ $list->id }}"
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