<!-- EarnScheme Incentive Details-->
<div class="modal fade" id="earnIncentiveDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close enable_incentive"  href="#" style="font-size:18px; padding-right:8px;">
                    <i class="fa fa-pencil" title="Edit"></i>
                </a>
                 <a class="close"  href="#" style="font-size:18px; padding-right:8px;" data-toggle="modal" data-dismiss="modal" data-target="#earningModal">
                    <i class="fa fa-arrow-left" title="Back"></i>
                </a>
                <h4 class="modal-title"> Incentive - Detail </h4>
            </div>

            <form method="post" id="view_incentive_form" action="">
                <div class="modal-body">
                    <div class="incentive-details">
                    <!-- alert mesage-->
                        @include('frontEnd.common.popup_alert_messages')
                        <!--  end of alert -->
                    <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0">  Title: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <input name="incentive_name" class="form-control" value="" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0"> Stars: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <div class="select-style">
                                            <select name="incentive_stars" class="view_incentive" disabled="disabled">
                                            <option value="0">Select Star</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0"> Details: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <textarea rows="5" disabled="disabled" name="incentive_detail" class="form-control txtarea view_incentive" value=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 p-0">
                                    <label class="col-sm-1 col-xs-12 color-themecolor r-p-0">  Url: </label>
                                    <div class="col-sm-11 r-p-0">
                                        <div class="input-group">
                                            <input name="incentive_url" class="form-control view_incentive" value="" type="text" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer m-t-0">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="incentive_id" class="incentive_id">
                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                    <button class="btn btn-warning edit-incentive-sub-btn" type="submit"> Confirm </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //making editable
    $(document).ready(function(){
        $(document).on('click','.enable_incentive', function(){
            $(this).addClass('active');
            $(this).parent().siblings('form').find('.view_incentive').removeAttr('disabled');
        });

        $('.edit-incentive-sub-btn').click(function(){
            if($('.enable_incentive').hasClass('active')) {
                return true;
            } else {
                return false;
            } 
        });
    });
</script>

<script>
    $(document).ready(function(){
         //view incentive
        $(document).on('click','.view_incentive_btn', function(){
                var incentive_id = $(this).attr('incentive_id');
                $('.enable_incentive').removeClass('active');
                $('#view_incentive_form').find('.view_incentive').attr('disabled','disabled');
                $('.loader').show();
                $('body').addClass('body-overflow');
                $.ajax({
                    type : 'post',
                    dataType: 'json',
                    url  : "{{ url('/system/earning/view_incentive/') }}"+'/'+incentive_id,
                    data :  {'incentive_id' : incentive_id},
                    success:function(resp) {
                        if(isAuthenticated(resp) == false){
                        return false;
                        }
                        var response = resp['response']
                        if(response == true) {
                        var title   = resp['name'];
                        var star    = resp['stars'];
                        var details = resp['details'];
                        var url     = resp['url'];
                        $('input[name=\'incentive_name\']').val(title);
                        $('select[name=\'incentive_stars\']').val(star);
                        $('input[name=\'incentive_url\']').val(url);
                        $('textarea[name=\'incentive_detail\']').val(details);
                        $('.incentive_id').val(incentive_id);
                        $('#earningModal').modal('hide');
                        $('#earnIncentiveDetails').modal('show');

                        setTimeout(function () {
                            autosize($("textarea"));
                        },200);
                        } else {

                        }
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });
                $(this).closest('.pop-notifbox').toggleClass('active');
                return false;
        });

        //save editable incentive
        $(document).on('click','.edit-incentive-sub-btn', function(){
            
            var incentive_id = $('input[name=\'incentive_id\']').val();

            error = 0;
            var incentive_detail = $('textarea[name=\'incentive_detail\']').val();
            var incentive_stars = $('select[name=\'incentive_stars\']').val();
            incentive_detail = jQuery.trim(incentive_detail);
            if((incentive_detail == '' || incentive_detail == null)) {
                $('textarea[name=\'incentive_detail\']').addClass('red_border');
                error = 1;
            } else {
                $('textarea[name=\'incentive_detail\']').removeClass('red_border');
            }
            if(incentive_stars == 0) {
                $('select[name=\'incentive_stars\']').parent().addClass('red_border');
                error = 1;
            } else {
                $('select[name=\'incentive_stars\']').parent().removeClass('red_border');
            }
            if(error == 1) {
                return false;
            }
            $('.loader').show();
            $('body').addClass('body-overflow');

            var formata = $('#view_incentive_form').serialize();
           
            $.ajax({
                type : 'post',
                url  : "{{ url('/system/earning/edit_incentive') }}",
                data : formata,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == true) {
                        $('#earnIncentiveDetails').modal('hide');
                        $('#earningModal').modal('show');
                        $('span.popup_success_txt').text('Incentive Details Updated Successsfully.');

                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else {
                        $('span.popup_error_txt').text('Some Error Occured.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                   // $('.edit_incentive').removeClass('active')
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });   
    });
</script>



