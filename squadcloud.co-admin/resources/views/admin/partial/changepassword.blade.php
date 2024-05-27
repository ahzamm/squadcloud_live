<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert bg-danger text-light pb-0" id="changePassError" style="display: none">
        </div>
        <form action="" method="post" id="changePassword">
          @csrf
          <div class="form-group">
            <label for="">Current Password <span style="color: red">*</span></label>
            <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="Enter Your Current Password" required>
          </div>
          <div class="form-group">
            <label for="">New Password <span style="color: red">*</span></label>
            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="Password should be at least 8 characters long" required>
          </div>
          <div class="form-group">
            <label for="">Confirm Password <span style="color: red">*</span></label>
            <input type="password" name="newpassword_confirmation" id="newpassword_confirmation" class="form-control" placeholder="Password should be at least 8 characters long" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary" form="changePassword">Change Password</button>
      </div>
    </div>
  </div>
</div>