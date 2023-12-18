<!-- Wear record Modal -->
<div class="modal fade" id="suwearModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- <a class="close" href="" data-toggle="modal" data-dismiss="modal" data-target="#logBookModal">
                    <i class="fa fa-arrow-left" title=""></i>
                </a> -->
                <h4 class="modal-title"> Wear Info </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <form method="post" id="">    
                        <label class=" col-md-10 col-sm-12 col-xs-12 p-t-7 m-b-15"> 
                            Service user is going outside, Please enter info about his wears.
                            <!-- ucfirst($patient->name)  is going outside, Please enter info about his wears. --> 
                        </label>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7"> Details: </label>
                            <div class="col-md-9 col-sm-9 col-xs-9 ">
                                <div class="select-bi">
                                    <textarea name="log_detail" class="form-control detail-info-txt" rows="5" maxlength="1000" placeholder="Enter service user's wears"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning sbt-wear-record" type="submit"> Confirm </button>
                        </div>
                    </form>               
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wear record Modal End -->


<script>
    // profile status change
    $(document).ready(function(){
        //yp photo right click functionality 
        $(function () {
            $('.profile_click').bind('contextmenu', function (e) {

                $(this).addClass('profile_active_status');
                $('.loader').show();

                var service_user_id = $('.selected_su_id').val();
                if(service_user_id  == undefined){
                    service_user_id = "{{ $service_user_id }}";
                }

                $.ajax({
                    type:"get",
                    url: "{{ url('/service/user/afc-status') }}"+'/'+service_user_id,

                    success : function(resp){
                        if(resp == '1') {   //SHOW ONLY IF PRESENT
                            $('#suwearModal').modal('show');
                            setTimeout(function () {
                                autosize($("textarea"));
                            },200);
                           // alert(resp);
                        } else {
                            var log_detail = 'a';
                            update_afc_status(log_detail);

                            // $('.profile_active_status').removeClass('profile_active');
                            // $('.profile_active_status').addClass('profile_inactive');
                           // alert('done');
                        }

                    }
                });

                
                $('.loader').hide();
                e.preventDefault();
            });
        });

        //submit yp wear record
        $(document).on('click','.sbt-wear-record', function(){

            var log_detail      = $('textarea[name=\'log_detail\']').val().trim();                   
            if(log_detail == '') {
                $('textarea[name=\'log_detail\']').addClass('red_border');
                return false;    
            } else {
                $('textarea[name=\'log_detail\']').removeClass('red_border');
            }
            update_afc_status(log_detail);

            $('.loader').show();
            $('body').addClass('body-overflow');
            
            return false;
        }); 

        function update_afc_status(log_detail){
            var _token = "{{ csrf_token()}}";
            var service_user_id = $('.selected_su_id').val();
            if(service_user_id  == undefined){
                service_user_id = "{{ $service_user_id }}";
            }

            $.ajax({
                type   : 'post',
                url    : "{{ url('/service/user-profile/afc-status/update') }}"+'/'+service_user_id,
                data   :  { 'log_detail': log_detail },
                success:function(resp){ 
                  //  alert(resp);
                    if(isAuthenticated(resp) == false){
                        return false;
                    } 
                    if(resp == 'true') {         
                        $.ajax({
                            type:'post',
                            url:"{{ url('/service/notifications/')}}",
                            data:{ 'service_user_id':service_user_id,'_token': _token },
                            success:function(resp){
                                // console.log(resp);
                                if(resp != ''){

                                    $('.srvc_usr_ntf').html(resp);
                                }
                            }
                        });
                        // if($('.profile_active_status').hasClass('profile_inactive')) {
                        //     $('.profile_active_status').removeClass('profile_inactive');
                        //     $('.profile_active_status').addClass('profile_active');
                           
                        // } else {
                        //     $('.profile_active_status').removeClass('profile_active');
                        //      $('.profile_active_status').addClass('profile_inactive');
                           
                        // }

                        if($('.profile_active_status').hasClass('profile_active')) {
                            $('.profile_active_status').removeClass('profile_active');
                            $('.profile_active_status').addClass('profile_inactive');
                           
                        } else {
                            $('.profile_active_status').removeClass('profile_inactive');
                            $('.profile_active_status').addClass('profile_active');
                           
                        }
                        $('textarea[name=\'log_detail\']').val('');
                        //show success message
                        $('.ajax-alert-suc').find('.msg').text('MFC/AFC status has been changed successfully.');
                        $('.ajax-alert-suc').show();
                        
                        setTimeout(function(){$(".ajax-alert-suc").fadeOut()}, 5000);
                    } else if(resp == 'AUTH_ERR') {
                        $('.ajax-alert-err').find('.msg').text("{{ UNAUTHORIZE_ERR }}");
                        $('.ajax-alert-err').show();
                        setTimeout(function(){$(".ajax-alert-err").fadeOut()}, 5000);
                    } else { 
                        $('.ajax-alert-err').find('.msg').text('Some Error Occured. Status can not be updated.');
                        $('.ajax-alert-err').show();
                        setTimeout(function(){$(".ajax-alert-err").fadeOut()}, 5000);
                    } 
                    $('#suwearModal').modal('hide');
                    $('.profile_active_status').removeClass('profile_active_status');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        }                                     
    });
</script>

<!-- <script>
    $('.profile_click').click(function(){
        //var service_user_id = $('.selected_su_id').val();
        var service_user_id = "{{ $service_user_id }}";
        $.ajax({
            type:"get",
            url: "{{ url('/service/user/afc-status') }}"+'/'+service_user_id,

            success : function(resp){
                
                if(resp == true) {  
                    alert(resp);
                } else {
                    alert('error');
                }

            }
        });
    });

</script> -->
