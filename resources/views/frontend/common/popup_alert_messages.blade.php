<div class="form-group col-md-12 col-sm-12 col-xs-12 popup_success popup_alrt_msg">
    <div class="popup_notification-box">
        <div class="alert alert-success alert-dismissible m-0" role="alert">
            <button type="button" class="close close-msg-btn" ><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <span class="popup_success_txt">New Row is added</span>.
        </div>
    </div>
</div>

<div class="form-group col-md-12 col-sm-12 col-xs-12 popup_error popup_alrt_msg">
    <div class="popup_notification-box">
        <div class="alert alert-danger alert-dismissible m-0" role="alert">
            <button type="button" class="close close-msg-btn" ><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <span class="popup_error_txt">{{ COMMON_ERROR }}</span>.
        </div>
    </div>
</div>

<script>
    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
    setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
</script>

<script type="text/javascript">
    $(document).on('click','.close-msg-btn',function(){
        $('.popup_alrt_msg').hide();
    });
</script>