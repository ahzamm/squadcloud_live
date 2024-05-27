@extends('layouts/backend')
@section('page_title', 'ContactView')
@section('contact_select', 'active')
@section('content')

 <!-- Main content -->
 <section class="content">


 <br>
 <br>
 <br>
 <br>
 <br>
 <br>

<h1>Checkout View</h1>
                
<h3>first_name</h3>

<p>{{$checkout->first_name}}</p>

<h3>last Name</h3>

<p>{{$checkout->last_name}}</p>


<h3>phone</h3>

<p>{{$checkout->phone}}</p>


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