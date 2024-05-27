@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
@section('title','All Menus')
<style>
   .move {
      cursor: move;
   }
</style>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="card mt-3">
                  <div class="card-header">
                     <h5 class="card-title"><span><i class="fa-solid fa-user-shield"></i></span> Admin Menus</h5>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <div class="ml-auto">
                              <a href="{{ route('menus.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Admin Menus / SubMenus</a>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive scrol">
                              <table id="example" style="width: 100%;" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>Serial#</th>
                                       <th>Main Menus</th>
                                       <th>Number Of SubMenus</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="sortMenuTable" class="move">
                                    <input type="hidden" class="csrf_token" value="{{csrf_token()}}">
                                    @foreach ($collection as $key => $menu)
                                    <tr>
                                       <td>{{$key+1}} <input type="hidden" class="order-id" value="{{$menu->id}}"></td>
                                       <td>{{$menu->menu}}</td>
                                       <td>{{$menu->submenus->count()}}</td>
                                       <td>
                                          <a href="{{route("menu.edit",$menu->id)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                          <button class="btn btn-sm btn-danger btnDeleteMenu" data-value="{{$menu->id}}"><i class="fa fa-trash"></i></button>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="modal fade" id="SortMenuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sortable Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="p-2 d-flex justify-content-center">
               <div class="sk-wave text-center">
                  <div class="sk-rect sk-rect1"></div>
                  <div class="sk-rect sk-rect2"></div>
                  <div class="sk-rect sk-rect3"></div>
                  <div class="sk-rect sk-rect4"></div>
                  <div class="sk-rect sk-rect5"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection()
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
   $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
   });
   $(document).ready(function() {
      $('#example').DataTable();
      //Delete Menu
      $(document).on('click', '.btnDeleteMenu', function() {
         menuId = $(this).attr('data-value');
         row = $(this);
         swal({
            title: 'Are you sure?',
            text: "You want to delete this record",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
         }).then(function(result) {
            if (result.value) {
               $.ajax({
                  url: '/admin/menus/delete/' + menuId,
                  method: 'post',
                  dataType: 'json',
                  success: function(res) {
                     if (res.status) {
                        $(row).parents('tr').remove();
                        swal('Updated!', 'Menu / SubMenus deleted', 'success');
                        // console.log("delete record");
                     } else {
                        //$(secondInput).siblings('span').removeClass('d-none');
                     }
                  },
                  error: function(jhxr, status, err) {
                     console.log(jhxr);
                  }
               })
            } else if (result.dismiss === 'cancel') {
               //  swal(
               //      'Cancelled',
               //      'Your imaginary data is safe :)',
               //      'error'
               //  )
            }
         })
      })
      //delete menu end
   });
   $(document).on('click', '#SortMenu', function() {
      $('#SortMenuModal').modal('show');
      id = $(this).attr('data-value');
      $.ajax({
         url: "{{route('menus.sort')}}",
         method: 'get',
         dataType: 'html',
         beforeSend: function() {
            $('#SortMenuModal div.modal-body').html(`<div class="p-2 d-flex justify-content-center">
               <div class="sk-wave text-center">
               <div class="sk-rect sk-rect1"></div>
               <div class="sk-rect sk-rect2"></div>
               <div class="sk-rect sk-rect3"></div>
               <div class="sk-rect sk-rect4"></div>
               <div class="sk-rect sk-rect5"></div>
               </div>
               </div>`);
         },
         success: function(res) {
            $('#SortMenuModal div.modal-body').html(res);
            $("#sortable").sortable();
            $("#sortable").disableSelection();
         },
         error: function(jhxr, status, err) {
            console.log(jhxr);
         },
         complete: function() {
         }
      });
      //ajax end
   })
   $(document).on('click', '#SortPostBtn', function() {
      $.ajax({
         url: "/admin/menus/sort",
         type: "POST",
         data: new FormData(document.forms.namedItem("sortMenuForm")),
         contentType: false,
         cache: false,
         processData: false,
         dataType: 'JSON',
         beforeSend: function() {
            $('#loader-sortmenu-img').css('display', 'block');
         },
         success: function(res) {
            if ($.isEmptyObject(res.error)) {
               if (res.status) {
                  window.location.reload();
               }
            } else {
               //printErrorMsg(res.error,'#receiveSubmitError');
            }
         },
         error: function(jhxr, status, err) {
            console.log(jhxr);
         },
         complete: function() {
            $('#loader-sortmenu-img').css('display', 'none');
         }
      });
   });
   //  Sorting Sliders
   let sortMenuUrl = "{{route('sort.menu')}}";
   let sortTable = $("#sortMenuTable");
   let csrfToken = $('.csrf_token')
   let editUrlFront = "{{route('menu.edit')}}";
   $(sortTable).sortable({
      update: function(event, ui) {
         var SortIds = $(this).find('.order-id').map(function() {
            return $(this).val().trim();
         }).get();
         // Getting The Order id of each sortIds
         $(this).find('.order-id').each(function(index) {
            $(this).text(SortIds[index]);
         });
         //Sending Ajax to update the sort ids and change the data sorting
         $.ajax({
            url: sortMenuUrl,
            type: "post",
            data: {
               sort_Ids: SortIds
            },
            headers: {
               "X-CSRF-TOKEN": csrfToken.val()
            },
            success: function(response) {
               let table = "";
               $(response).each(function(index, value) {
                  table += ` <tr>
                  <td>${index + 1} <input type="hidden" class="order-id" value="${value.id}"></td>
                  <td>${value.menu} </td>
                  <td>${value.submenus.length}</td>
                  <td>
                  <a href="${editUrlFront}/${value.id}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                  <button  class="btn btn-sm btn-danger btnDeleteMenu" data-value="${value.id}"><i class="fa fa-trash"></i></button>
                  </td>
                  </tr>`;
               });
               $(sortTable).html(table);
            }
         })
      }
   });
</script>
@endpush