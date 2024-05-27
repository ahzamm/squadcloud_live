<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Packages</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p class="text-center">Banner</p>
  <img src="{{asset('slider_images/'.$packageData->package_slider_img)}}" alt="" srcset="" class="img-fluid" width="100%" style="height: 500px!important; object-fit:contain;">
  <dl class="mt-2">
    <dt>Internet package :</dt>
    <dd>{{$packageData->name}}</dd>
    <dt>Internet Bandwidth (Mbps) :</dt>
    <dd>{{$packageData->limit}}</dd>
    <dd>Internet Package Color Code :</dd>
    <dd>{{$packageData->color}}</dd>
    <dd>Province</dd>
    <dd>{{$packageData->province}}</dd>
  </dl>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
</div>
