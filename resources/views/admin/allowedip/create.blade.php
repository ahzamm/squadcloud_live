<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel"><span><i class="fa-solid fa-network-wired"></i></span> Add IP Address</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="ipAddForm">
    <div class="alert bg-danger text-light pb-0" id="AllowedIpError" style="display: none">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Full Name <span style="color: red">*</span></label>
      <input type="text" name="person_name" class="form-control" placeholder="Example : Jawad Alam" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">IP Address <span style="color: red">*</span></label>
      <input type="text" class="form-control" name="ip_address" placeholder="Example : 192.168.0.1" required>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button"  class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  <button type="submit" form="ipAddForm" class="btn btn-outline-primary">Submit</button>
</div>