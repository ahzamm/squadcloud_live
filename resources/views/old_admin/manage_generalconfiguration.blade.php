@extends('layouts/backend')
@section('page_title', 'general configuration')
@section('general_configuration_select', 'active')
@section('content')
              
        <!-- ! Main -->
 <main class="main users chart-page" id="skip-target">
        <div class="container">
        

        <section class="ftco-section">
          <div class="container">

      

          <div class="eedit-btn">
          @if($id>0)
          <h1 align="center" class="main-title">General Configuration</h1>
          @else
          <h1 align="center" class="main-title">General Configuration</h1>
          @endif  
          <a href="{{ url('admin/general_configuration') }}">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </a>
          </div>
          


 
               <div class="row">
                    <div class="bb-design">
                      
                    <form class="row g-3" action="{{ route('general_configuration.manage_general_configuration_process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                        <div class="col-md-6">
                        <label for="default_language" class="control-label mb-1">Default Language</label>                   
                         <select id="default_language" name="default_language" class="form-control">
                         <option value="English">English</option>
                         <option value="Urdu">Urdu</option>
                         </select>
                         @error('default_language')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                       



                        <div class="col-md-6">
                        <label for="site_title" class="form-label">Site Title</label>
                        <input id="site_title" value="{{ $site_title }}" name="site_title" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('site_title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="fav_icon" class="form-label">Site Logo</label>
                        <input id="img"  type="file" name="site_logo" class="form-control" > 
                        <small>dimensions:min_width=220,min_height=80</small>    
                        @error('site_logo')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" value="{{ $email }}" name="email" placeholder="Enter Eamil Address" type="text" class="form-control" >     
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <textarea id="address" value="{{ $address }}" name="address" placeholder="Enter Eamil Address" type="text" class="form-control">{{ $address }}</textarea>     
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <label for="office_timing" class="form-label">Office Timing</label>
                        <textarea id="office_timing" value="{{ $office_timing }}" name="office_timing" placeholder="Enter Eamil office_timing" type="text" class="form-control">{{ $office_timing }}</textarea>     
                        @error('office_timing')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <label for="fav_icon" class="form-label">Fav Icon</label>
                        <input id="img" name="fav_icon"  type="file"  class="form-control" > 
                        <small>dimensions:min_width=220,min_height=80</small>    
                        @error('fav_icon')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <h5>Chat Box</h2>
                        @if($chat_box == 1)
                        <input type="checkbox" id="chat_box" name="chat_box" checked value="0">
                        <label for="checkbox">Show Chat Box</label><br>
                        @elseif($chat_box == 0)
                        <input type="checkbox" id="chat_box" name="chat_box" value="1">
                        <label for="checkbox">Show Chat Box</label><br>
                        @else
                        <p>status not set</p>
                        @endif
                        @error('chat_box')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div> 
                        
                        
                        <div class="col-md-6">
                        <label for="whatsapp_url" class="control-label mb-1">Whatapp Url</label>
                        <input id="whatsapp_url" placeholder="Enter Whatapp url" value="{{ $whatsapp_url }}" name="whatsapp_url" type="url" class="form-control" >     
                        @error('whatsapp_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                         </div>

                         <div class="col-md-6">
                        <label for="skype_url" class="control-label mb-1">Skype Url</label>
                        <input id="skype_url" placeholder="Enter Skype url" value="{{ $skype_url }}" name="skype_url" type="url" class="form-control" >     
                        @error('skype_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                         </div>

                         
                         <div class="col-md-6">
                        <label for="message_url" class="control-label mb-1">Message Url</label>
                        <input id="message_url" placeholder="Enter Message url" value="{{ $message_url }}" name="message_url" type="url" class="form-control" >     
                        @error('message_url')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                         </div>

                         <div class="col-md-6">
                        <label for="phone_url" class="control-label mb-1">Phone Url</label>
                        <input id="phone_url" placeholder="Enter Phone url" value="{{ $phone_url }}" name="phone_url" type="url" class="form-control" >     
                        @error('phone_url')
                        <p class="text-danger">{{$phone}}</p>
                        @enderror
                         </div>

                         
                        <div class="col-md-6">
                        <label for="facebook_url" class="control-label mb-1">Facebook Url</label>
                        <input id="facebook_url" placeholder="Enter Facebook url" value="{{ $facebook_url }}" name="facebook_url" type="url" class="form-control" >     
                        @error('facebook_url')
                        <p class="text-danger">{{$facebook}}</p>
                        @enderror
                         </div>

                         
                        <div class="col-md-6">
                        <label for="linkedin_url" class="control-label mb-1">LinkedIn Url</label>
                        <input id="linkedin_url" placeholder="Enter LinkedIn url" value="{{ $linkedin_url }}" name="linkedin_url" type="url" class="form-control" >     
                        @error('linkedin_url')
                        <p class="text-danger">{{$phone}}</p>
                        @enderror
                        </div>

                         

                        <div class="col-md-6">
                        <label for="twitter_url" class="control-label mb-1">twitter Url</label>
                        <input id="twitter_url" placeholder="Enter twitter url" value="{{ $twitter_url }}" name="twitter_url" type="url" class="form-control" >     
                        @error('twitter_url')
                        <p class="text-danger">{{$phone}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="phone_number" class="control-label mb-1">Phone Number</label>
                        <input id="phone_number" placeholder="Enter phone Number" value="{{ $phone_number }}" name="phone_number" type="number" class="form-control" >     
                        @error('phone_number')
                        <p class="text-danger">{{$phone}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" value="{{ $email }}" name="email" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea id="meta_description" name="meta_description" placeholder="Enter meta_description" class="form-control" >{{ $meta_description }}</textarea>                                           
                        @error('meta_description')
                        <p class="text-danger text-center">{{$message}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <label for="keyword" class="form-label">Key Word</label>
                        <input id="keyword" value="{{ $keyword }}" name="keyword" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('keyword')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input id="slug" value="{{ $slug }}" name="slug" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>


                        <div class="col-md-6">
                        <label for="footer_text" class="form-label">Footer Text</label>
                        <input id="footer_text" value="{{ $footer_text }}" name="footer_text" placeholder="Enter Sub Title" type="text" class="form-control" >     
                        @error('footer_text')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>

                        <div class="form-group">
                          <input id="id" value="{{ $id }}" name="id" type="hidden">                                            
                         </div>


                    
                         <div>
                          @if($id>0)
                          <div class="red-btn">
                          <input type="Submit" value="update">
                        </div>
                          @else
                          <div class="red-btn">
                        <input type="Submit" value="Add">
                        </div>
                          @endif
                          <!-- <a href="{{ url('admin/slider') }}">
                          <div class="red-btn">
                          <input type="button" value="Back">
                          </div>
                        </a> -->
                          
                          
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
              </main>

@endsection()