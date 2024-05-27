<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Partner / Reseller</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p class="text-center">Partner / Reseller Image</p>
  <img src="{{asset('reseller-images/'.$reseller_data->image)}}" alt="" srcset="" class="img-fluid" height="200">
  <dl class="mt-2">
    <dt>Partner & Reseller Name:</dt>
    <dd>{{$reseller_data->username}}</dd>
    <dt>First Name:</dt>
    <dd>{{$reseller_data->first_name}}</dd>
    <dt>Last Name:</dt>
    <dd>{{$reseller_data->last_name}}</dd>
    <dt>Email Address:</dt>
    <dd>{{$reseller_data->email}}</dd>
    <dt>Contact Number:</dt>
    <dd>{{$reseller_data->phone}}</dd>
    <dt>CNIC Number:</dt>
    <dd>{{$reseller_data->nic}}</dd>
  </dl>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
</div>
