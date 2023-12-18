<!-- Support Ticket -->
<div class="modal fade" id="ticketmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - Support Ticket </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button type="button" class="btn label-default active ticket-add-btn"> Add New </button>
                        <button type="button" class="btn label-default ticket-open-btn view-ticket-btn"> Opened Support Ticket </button>
                    </div>
                    <!-- alert messages -->
                   @include('frontEnd.common.popup_alert_messages')
                <form method="post" action="" id="add_ticket">
                                  
                    <div class="events-list ticket-record-list ticket-height">
                    <!--     support tickets will be shown here using ajax -->
                    </div>
                    

                    <div class="ticket-add">
                        <div class="form-group col-md-12 co-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-2 p-t-7 p-l-0 p-r-0"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 p-0">
                                <input type="text" class="form-control" name="ticket_title">
                            </div>
                        
                        </div>
                        <div class="form-group col-md-12 co-sm-12 col-xs-12q">
                            <label class="col-md-2 col-sm-2 p-t-7 p-l-0 p-r-0"> Description: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 p-0">
                                <textarea rows="4" class="form-control txtarea" name="ticket_message"></textarea> 
                            </div>
                        
                        </div>
                        <div class="modal-footer tkt-ftr m-t-0 recent-task-sec">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning add-new-tkt-btn" type="submit"> Confirm </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>       
        </div>
    </div>
</div>


<!-- view chat ticket modal -->
<div class="modal fade" id="chatmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <section class="panel">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#ticketmodal" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                    <h4 class="modal-title" id="mySmallModalLabel"> Support Ticket </h4>
                </div>
                
                <div class="panel-body ">
                    <div class="chat-view-click cht-hgt cal_evnt_scroller chat-view">
                        <!--  chat shown using ajax -->
                    </div>
                    <form method="post" action="" id="add_ticket_chat">
                        <div class="row">
                            <div class="col-xs-9">
                                <input type="text" class="form-control chat_input" name="chat_input" placeholder="Enter your text">
                            </div>
                            <div class="col-xs-3 chat-send">
                                <input type="hidden" name="ticket_id" class="view_ticket_id" value="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-warning">Send</button>
                            </div>
                        </div>
                     </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ url('public/frontEnd/js/calendar/moment-2.2.1.js') }}"></script>

<script>
     //get ticket record list
    $(document).ready(function(){
        $(document).on('click','.view-ticket-btn', function(){

            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/support-ticket') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.ticket-record-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');    
                    } else {
                        $('.ticket-record-list').html(resp);
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });

    });
</script>

<script>
    //save new support ticket
    $(document).ready(function(){
        $(document).on('click','.add-new-tkt-btn', function(){

            var title = $('input[name=\'ticket_title\']').val();
            title = jQuery.trim(title);         
            var message = $('textarea[name=\'ticket_message\']').val();
            message = jQuery.trim(message);
            //var user_id = $('input[name=\'user_id\']').val();
            //alert(user_id); return false;
            var user_id = "{{ Auth::user()->id }}";
            //var ticket_token = $('input[name=\'_token\']').val();
            var ticket_token = "{{ csrf_token() }}";
            var error = 0;
            if((title == '') || (title == null) ){ 
                $('input[name=\'ticket_title\']').addClass('red_border');
                error = 1;
            } else{ 
                $('input[name=\'ticket_title\']').removeClass('red_border');
            }
            if((message == '') || (message == null) ){ 
                $('textarea[name=\'ticket_message\']').addClass('red_border');
                error = 1;
            } else{ 
                $('textarea[name=\'ticket_message\']').removeClass('red_border');
            }
            if(error == 1){ 
                return false;
            }
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'post',
                url : "{{ url('/system/support-ticket/add') }}",
                data: { 'title' : title, 'message' : message, 'user_id' : user_id, '_token' : ticket_token },
                success:function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == '0'){
                     $('span.popup_error_txt').text('Error Occured');
                     $('.popup_error').show();
                    }
                    else{
                    //empty the input fields
                    $('input[name=\'ticket_title\']').val('');
                    $('textarea[name=\'ticket_message\']').val('');
                    
                    $('#ticketmodal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    //show success message
                    $('span.popup_success_txt').text('Support Ticket added successfully');
                    $('.popup_success').show();
                    setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    /*---------Three tabs click option----------*/
    $('#ticketmodal .events-list').hide();
    $(document).ready(function(){
        //$('.ticket-open-btn').on('click',function(){
        $(document).on('click','.ticket-open-btn',function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            $(this).closest('.modal-body').find('.events-list').siblings('.ticket-add').hide();
            $(this).closest('.modal-body').find('.events-list').show();
        });

        //$('.ticket-add-btn').on('click',function(){
        $(document).on('click','.ticket-add-btn',function(){
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            $(this).closest('.modal-body').find('.ticket-add').siblings('.events-list').hide();
            $(this).closest('.modal-body').find('.ticket-add').show();
        });

    });
</script>

<script>
    $(document).ready(function(){
        // get support_ticket list
        $(".support_ticket").click(function(){
            autosize($("textarea"));
            $('.loader').show();
            $('body').addClass('body-overflow');
            $('#ticketmodal').modal('show');
            $('.loader').hide();
            $('body').removeClass('body-overflow');
        });
    });
</script>   

<script>
    //clear data while click on cancel and close btn
    $(document).ready(function(){  
        $(document).on('click','.cancel-btn',function(){
            $('#add_ticket').find('input').val('');
            $('#add_ticket').find('textarea').val('');
            var token = "{{ csrf_token() }}";
            $('input[name=\'_token\']').val(token);
        });
    });
</script>

<script>
    /*$(document).ready(function(){
      
        $(function () {
           
            $(document).on('click','.chat-send', function(){ alert(1);

                var chatTime = moment().format("h:mm");
                var am_pm    = moment().format("h:mm") >= 12 ? "am" : "pm";
                var chatdate = moment().format('DD-MMM-YYYY');
                var chatText = $('.chat-input').val();
                var chatText = $('input[name=\'chat_input\']').val(); 
                var ticket_id = $('.view_ticket_id').val();  
                var ticket_token = $('input[name=\'_token\']').val();
                if (chatText == "") {
                    //$('.chat_input').addClass('red_border');
                    //return false;
                    alert('Empty Field');
                    $(".chat-input").focus();
                } else {
                    //$('.chat_input').parent().removeClass('red_border');
                    // $('<li class="clearfix odd"><div class="conversation-text"><div class="ctext-wrap"><p>' + chatText + '<i>' + chatTime + ' '+am_pm+' ' + chatdate +'</i></p></div></div></li>').appendTo('.conversation-list');
                    $('.chat-input').val('');
                    $(".chat-input").focus();
                    
                    $('.conversation-list').scrollTo('100%', '100%', {
                        easing: 'swing'
                    });
                }
            });
        });
    });*/

</script>

<script>
    //click on view chat
    $(document).ready(function(){
        $(document).on('click','.view-chat', function(){ 
           
            var ticket_id = $(this).attr('view_mseg_id');
            var label = $(this).closest('.input-group').find('.label').html();

            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/support-ticket/view') }}"+'/'+ticket_id,
                success:function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    $('#mySmallModalLabel').text('Support Ticket - '+label);
                    $('.view_ticket_id').val(ticket_id);
                    $('.chat-view-click').html(resp);

                    //for scrolling chat to the end
                    var chat_height = $('.conversation-list').height();
                     // alert(chat_height);
                    $('.chat-view').scrollTop(chat_height);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>


<script>
    // add new ticket mesg
    $(document).ready(function(){ 
        $(document).on('click','.chat-send', function(){ 
            var chatmsegtxt = $('input[name=\'chat_input\']').val();
            var ticket_id = $('.view_ticket_id').val();  
            var ticket_token = $('input[name=\'_token\']').val();
            chatmsegtxt = jQuery.trim(chatmsegtxt);

            if(chatmsegtxt == ''){
                $('.chat_input').addClass('red_border');
                return false;
            } else{
                $('.chat_input').removeClass('red_border');
            }
            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type: 'post',
                url : "{{ url('/system/support-ticket/view-msg/add') }}",
                data : {'chat_input' : chatmsegtxt, 'ticket_id' :  ticket_id, '_token' : ticket_token},
                success : function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp != ''){

                        $('.chat-view-click').html(resp);
                        $('.chat_input').val('');

                        //for scrolling chat to the end
                        var chat_height = $('.conversation-list').height();
                        $('.chat-view').scrollTop(chat_height);

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                    else{
                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                        return false;
                    }
                }
            });
            return false;
        });    
    });
</script>

<script>
    //ticket status changed
    $(document).ready(function(){ 
        $(document).on('click','.tkt-status',function(){

            var status_btn = $(this);
            var support_id = status_btn.attr('view_mseg_id');
            var supprt_token = "{{ csrf_token() }}";

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'post',
                url  : "{{ url('/system/support-ticket/ticket_status/') }}"+'/'+support_id,
                data : { 'support_id' : support_id, '_token' : supprt_token },
                dataType : 'json',
                success:function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    var response    = resp['response'];
                    var new_status  = resp['new_status'];

                    if(response == true){ 

                        if(new_status == 0){  
                            status_btn.html('<span class="color-red"><i class="fa fa-times"></i></span>Close');
                            status_btn.closest('span.settings').siblings('a.label').removeClass('label-success');
                            status_btn.closest('span.settings').siblings('a.label').addClass('label-danger');
                        } else{ 
                            status_btn.html('<span><i class="fa fa-comment-o"></i></span>Open');
                            status_btn.closest('span.settings').siblings('a.label').removeClass('label-danger');
                            status_btn.closest('span.settings').siblings('a.label').addClass('label-success'); 
                        }

                        $('span.popup_success_txt').text('Ticket Status Changed successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);                           
                    }
                    else{
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                    }

                    $('.tkt-status').closest('.pop-notifbox').removeClass('active'); //hide cog options 
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');                    
                }
            });
            return false;
        });
    });
</script>