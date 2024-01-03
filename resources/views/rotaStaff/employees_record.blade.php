@include('rotaStaff.components.header')
            <!-- Top Bar Info Section End Here -->
            <div class="col-lg-12">
               <div class="row">

                @foreach($user as $users)
                 <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="white-box-info">
                    <div class="profile-title-box">
                      <h3>
                      <?php 
                            $str = str_split($users->name); echo strtoupper($str[0]); 
                            $whatIWant = substr($users->name, strpos($users->name, " ") + 1);    
                            $str1 =  str_split($whatIWant); echo strtoupper($str1[0]);
                        ?>

                      </h3>
                    </div>
                    <div class="basicInfo">
                      <h4>{{ $users->name }}</h4>
                      <h5><a href="#">View full profile</a></h5>
                    </div>
                    <div class="view_profile">
                       <h6><a href="#"><i class="fa fa-eye"></i></a></h6>
                    </div>
                 </div>
               </div>
                @endforeach

              




               
              </div>
         
            
          </div>
        </div>
      </div>
    </div>
  </section>
  @include('rotaStaff.components.footer')
 