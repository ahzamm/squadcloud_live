<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">WhyChooseUs</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p class="text-center">Banner</p>
  <img src="{{asset('whychoose-us/'.$whyChooseUs_data->image)}}" alt="" srcset="" class="img-fluid" width="100%" height="200">
  <dl class="mt-2">
    <dt>Title :</dt>
    <dd>{{$whyChooseUs_data->title}}</dd>
    <dt>Description :</dt>
    <dd>{{$whyChooseUs_data->description}}</dd>
  </dl>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
</div>
