<div class="float-right">
    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#emailModal">Add Email</a>
    </div>

<!-- Add Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-md" role="document">
<div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
  <h4>Add Email</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<!-- Modal Body -->
<form action="{{route('emailcontact.store')}}" method="POST">
@csrf
<div class="modal-body" id="emailContainer">

  @foreach ($data['email_contacts'] as $key=> $contact)
    <div class="d-flex gap-5 mb-2" id="row_1">
      <input type="text" class="form-control" name="adminemail[]" value="{{$contact->adminemail}}" placeholder="Enter Email">
      <button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button>
    </div>
  @endforeach

  <div class="d-flex gap-5 mb-2" id="row_1">
    <input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email">
    <button type="button" class="btn btn-success" onclick="addRow()"><i class="fa fa-plus"></i></button>
  </div>

</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-success" >Save</button>
</div>

</form>
</div>
</div>
</div>
</div>

function addRow() {
let htmlRow = '<div class="d-flex gap-5 mb-2"><input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email"><button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button></div>';
$('#emailContainer').append(htmlRow);
}
$(document).on('click','.deleteRow',function(){
      $(this).parent().closest('div').remove();
});
function validateEmail(email) {
const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
return re.test(String(email).toLowerCase());
}
$(function () {
$("#example1").DataTable({
"responsive": true
//   "autoWidth": false,
});
});
$(document).on('click','#emailEdit',function(){
$('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
<div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
</div>`);
id = $(this).attr('data-value');
$.ajax({
method:'get',
url:'/admin/front-emails/edit',
dataType: 'html',
success:function(res){
$('#frontPagesModal').find('.modal-content').html(res);
},
error:function(jhxr,err,status)
{
console.log(jhxr);
}
})
})
$(document).on('click','.removeMail',function(){
$(this).parents('li').remove();
});
$(document).on('click','#addEmail',function(){
email = $('#email').val();
if(email != '' && validateEmail(email) )
{
$('.todo-list').append(`<li>
<span class="text">${email}</span>
<span class="float-right removeMail" style="cursor: pointer">
<i class="fas fa-times"></i>
</span>
<input type="hidden" name="emails[]" value="${email}">
</li>`);
$('#email').removeClass('is-invalid').val('');
}
else
{
$('#email').addClass('is-invalid')
}
})
// changeContactEmail
$(document).on('click','#updateEmails',function(){
$.ajax({
url: "/admin/front-emails/edit",
type: "POST",
data:  new FormData(document.forms.namedItem("changeContactEmail")),
contentType: false,
cache: false,
processData:false,
dataType:'JSON',
beforeSend:function(){
  // $('#loader-img').css('display','block');
},
success:function(res){
 if(res.status)
 {
  $('#frontPagesModal').modal('hide');
  toastr.info('Emails Updated Successfully');
}
},
error:function(jhxr,status,err)
{
console.log(jhxr);
},
complete:function()
{
    //  $('#loader-img').css('display','none');
  }
});
})
