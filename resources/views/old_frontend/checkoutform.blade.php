
               <form class="contact-form" action="/submitcheckout" method="post">
                  @csrf
                  
                     <div class="row mb-3">
                       <div class="col" data-aos="fade-right" data-aos-duration="1000">
                         <input type="text" id="first_name" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="Full Name*">
                       </div>
   
                       <div class="col" data-aos="fade-right" data-aos-duration="1000">
                         <input type="text" id="last_name" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="last_name">
                       </div>
   
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email*">
                       </div>

                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="phone" class="form-control" name="phone" value="{{old('phone')}}" placeholder="phone*">
                       </div>
   
                      
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="country" class="form-control" name="country" value="{{old('country')}}" placeholder="country*">
                       </div>
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="state" class="form-control" name="state" value="{{old('state')}}" placeholder="state*">
                       </div>
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="address_line_1" class="form-control" name="address_line_1"  placeholder="address_line_1*">
                       </div>
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="address_line_2" class="form-control" name="address_line_2" value="{{old('address_line_2')}}" placeholder="address_line_2*">
                       </div>
                       
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="company" class="form-control" name="company" value="{{old('company')}}" placeholder="company*">
                       </div>
   
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="number" id="postal_code" class="form-control" name="postal_code" value="{{old('postal_code')}}" placeholder="postal_code*">
                       </div>
   
   
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="number" id="total_amount" class="form-control" name="total_amount" value="{{old('total_amount')}}" placeholder="total_amount*">
                       </div>
   
             
                       <div class="col" data-aos="fade-left" data-aos-duration="1000">
                         <input type="text" id="payment_method" class="form-control payment_method" name="payment_method" value="{{old('payment_method')}}" placeholder="payment_method*">
                       </div>

                       <div class="form-group">
  											<label class="form-label">Status</label>
  											<div class="form-check">
  												<div class="d-inline-block">
  													<input name="status" value="1" type="radio" id="crYes" checked class="form-check-input" >
  													<label class="form-check-label" for="crYes">Yes</label>
  												</div>
  												<div class="d-inline-block mx-5">
  													<input name="status" value="0" type="radio" id="crNo" class="form-check-input">
  													<label class="form-check-label" for="crNo">No</label>
                          </div>
  											</div>
  										</div>

                       <input type="submit" name="submit" value="submit">
   
                   </form>
             

