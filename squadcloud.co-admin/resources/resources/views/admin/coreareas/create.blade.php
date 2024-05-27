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
  <h5 class="modal-title" id="exampleModalLabel"><span><i class="fa-solid fa-location-dot"></i></span> Add City Core Areas</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="ipAddForm">
    <div class="alert bg-danger text-light pb-0" id="AllowedIpError" style="display: none">
    </div>
    <div class="alert bg-success text-light text-center font-weight-bold" id="AllowedIpSuccess" style="display: none">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">City Core Area Name <span style="color: red">*</span></label>
      <input type="text" name="area_name" class="form-control" placeholder="Example : Clifton" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Select City <span style="color: red">*</span></label>
      <select name="city" id="" class="form-control">
        <option value> Select City</option>
        @foreach ($cities as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button"  class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  <button type="submit" form="ipAddForm" class="btn btn-outline-primary">Submit</button>
</div>
<!-- Code Finalize -->