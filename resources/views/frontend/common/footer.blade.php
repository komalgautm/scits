@include('frontEnd.common.modify_request')
@include('frontEnd.common.system_guide')
@include('frontEnd.common.sticky_notification')

<!--footer start-->
<footer class="footer-section">
    <div class="text-center">
        {{ date('Y')}} &copy; SCITS
        <a href="#" class="go-top">
          <!-- <i class="fa fa-angle-up"></i> -->
          <img src="{{  asset('public/images/scits_hand.png')}}" alt="system_guide" class="system_guide" height="25" width="auto" />
        </a>
    </div>
 
  <!-- <div class="text-left">
    <a href="#" style="color:white;" class="system_guide"> System Guide </a>
  </div> -->
</footer>
<!--footer end-->

<script>
$(document).ready(function(){
    $('.system_guide').on('click',function(){
        $('#System_guide').modal('show');
    });
});
</script>