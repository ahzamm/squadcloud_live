<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel"><span><i class="fa-solid fa-network-wired"></i></span> Update IP Address</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="ipEditForm">
    <div class="alert bg-danger text-light pb-0" id="EditAllowedIpError" style="display: none">
    </div>
    <input type="hidden" name="id" value="{{$ip->id}}">
    <div class="form-group">
      <label for="exampleInputEmail1">Full Name <span style="color: red">*</span></label>
      <input type="text" name="person_name" value="{{$ip->person_name}}" class="form-control" placeholder="Example : Jawad Alam" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">IP Address <span style="color: red">*</span></label>
      <input type="text" class="form-control" value="{{$ip->ip_address}}" name="ip_address" placeholder="Example : 192.168.0.1" required>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button"  class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  <button type="submit" form="ipEditForm" class="btn btn-outline-primary">Update</button>
</div>
<!-- Code Finalize -->