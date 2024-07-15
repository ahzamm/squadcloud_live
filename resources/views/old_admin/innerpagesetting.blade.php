@extends('layouts/backend')
@section('page_title', 'contact')
@section('contact_select', 'active')
@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet">


 <!-- ! Main -->
 <main class="main users chart-page" id="skip-target">
      <div class="container">
        
      <section class="ftco-section">    
          <div class="container">
            
            <div class="eedit-btn">
            <h1 align="center" class="main-title">Inner Page Heading</h1>

               <a href="{{ url('admin/innerpage_setting/manage_innerpage_setting') }}" data-toggle="tooltip" title="insert record" class="btn btn-success" ><i class="fa fa-plus"></i></a>            
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
                                 <!-- <a href="{{ url('admin/innerpage_setting/manage_innerpage_setting') }}"class="btn btn-success"><i class="fa fa-plus"></i></a> -->
                                
                
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
                                               <th>Title</th>
                                               <th>Title Image</th>
                                               <th>key</th>
                                               <th>ACTION</th>                          
                                               </tr>
                                                </thead>
                   
                                                <tbody>
                                                @foreach($innersetting as $innersettings)
                                                <tr>
                                                    <th>{{$innersettings->id }}</th>
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
                                                  
                                                      <td>
                                                      @if($innersettings->status==1)
                                                      <a href="{{ url('admin/innerpage_setting/status/0')}}/{{ $innersettings->id }}" class="btn btn-warning">Enable</a>
                                                      @elseif($innersettings->status==0)
                                                      <a href="{{ url('admin/innerpage_setting/status/1')}}/{{ $innersettings->id }}" class="btn btn-secondary">Disable</a>
                                                      @endif
                                                      <a href="{{ url('admin/innerpage_setting/manage_innerpage_setting/')}}/{{ $innersettings->id }}" class="btn btn-primary">Update</a>
                      
                                                      <a href="{{ url('admin/innerpage_setting/delete/')}}/{{ $innersettings->id }}"
                                                          onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete
                                                        <!-- <button onclick="return confirm('Are you sure?')" type="button" class="btn btn-outline-danger btn-sm"></button> -->
                                                    </a>
                                                    </td                         
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