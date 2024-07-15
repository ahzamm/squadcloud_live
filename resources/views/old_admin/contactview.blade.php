@extends('layouts/backend')
@section('page_title', 'ContactView')
@section('contact_select', 'active')
@section('content')

 <!-- Main content -->
 <section class="content">

<h1>Contact View</h1>
                
<h3>Full Name</h3>

<p>{{$list->full_name}}</p>

<h3>Email</h3>

<p>{{$list->email}}</p>


<h3>Phone Number</h3>

<p>{{$list->phone_number}}</p>


<h3>Service Required</h3>

<p>{{$list->service_required}}</p>


<h3>Message</h3>

<p>{{$list->message}}</p>

</section>
<!-- /.content -->
@endsection()

@push('scripts')
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endpush