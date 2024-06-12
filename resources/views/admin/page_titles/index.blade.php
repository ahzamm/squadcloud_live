@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3 card-outline card-info">
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Update Page Titles</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{ route('page_titles.update') }}" method="POST" id="pageTitleForm">
                  @csrf
                  @method('PUT')
                  <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Menu Name</th>
                        <th>Page Title</th>
                      </tr>
                    </thead>
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($page_titles as $key => $item)
                      <tr class="table-row">
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->menu}}</td>
                        <td>
                          <input type="hidden" name="page_titles[{{ $key }}][id]" value="{{ $item->id }}">
                          <input type="text" class="form-control" name="page_titles[{{ $key }}][title]" value="{{ old('page_titles.'.$key.'.title', $item->page_title) }}">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@include('admin.front-faq._modal')
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
@endpush
