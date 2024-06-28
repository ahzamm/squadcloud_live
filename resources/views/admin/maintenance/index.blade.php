@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-2">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title mb-0"><span><i class="fa-solid fa-triangle-exclamation"></i></span> Maintenance Mode</h3>
                  <div class="d-flex align-items-center ml-auto">
                    <a class="btn btn-success btn-sm mr-2" href="{{ route('allowedip.index') }}">
                      <i class="fa fa-plus"></i> Allow IP Address</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    @if ($mode)
                      <div class="c0l-12 col-md-6">
                        <h2>Maintenance mode is activated</h2>
                        <a href="{{ route('maintenance.deactivate') }}" class="btn btn-primary">Deactivate</a>
                      </div>
                    @else
                      <div class="col-12 col-md-6">
                        <form action="{{ route('maintenance.store') }}" method="post">
                          @csrf
                          <div class="form-group">
                            <label for="">Expected Up Time</label>
                            <div class="input-group date" id="timePicker" data-target-input="nearest">
                              <input type="text" name="maintenance_time" class="form-control datetimepicker-input" data-target="#timePicker">
                              <div class="input-group-append" data-target="#timePicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                            <p class="text-sm text-danger">
                              @error('maintenance_time')
                              @enderror
                            </p>
                          </div>
                          <input type="submit" value="Activate" class="btn btn-danger">
                        </form>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('#timePicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
          time: "fa fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
        }
      });
    })
    $(document).on('click', '.viewFrontPages', function() {
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
        <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
      id = $(this).attr('data-value');
      $.ajax({
        method: 'get',
        url: '/admin/front-pages/' + id,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        }
      })
    })
  </script>
@endpush
