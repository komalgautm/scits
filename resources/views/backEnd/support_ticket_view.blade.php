@extends('backEnd.layouts.master')
@section('title',' Support Tickets')
@section('content')

<style type="text/css">
    .chat-conversation .conversation-list .clearfix.odd {
      margin-bottom:  10px;
    }
    /*.panel .chat-view.cus-chat .clearfix { */
    .chat-conversation .conversation-list .clearfix {
      margin-bottom: 10px;
    }
    .panel .cus-chat {
      max-height: 425px;
      min-height: 425px;
      overflow: auto;
    }
    .panel.cus-chat-panel {
      margin-bottom: 0;
    }
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel cus-chat-panel">
                    <div class="panel-body">
                      <div class="chat-view cus-chat m-b-20">
                          <div class="chat-conversation" style="height: 700px;">
                             <ul class="conversation-list">
                                <?php 
                                    foreach ($tickets_chat as $key => $value) {       
                                        
                                        if($value['sender_type'] == 1) {
                                            $admin_class = 'even';
                                        } else {
                                            $admin_class = 'odd';
                                        }
                                        ?>
                            
                                        <li class="clearfix <?php echo $admin_class; ?>">
                                            <div class="conversation-text">
                                                <div class="ctext-wrap">
                                                  <p><?php echo $value['message']; ?> 
                                                    <i><?php echo date('g:i a d-M-Y',strtotime($value['created_at'])); ?></i>
                                                  </p>    
                                                </div>  
                                            </div>
                                        </li>
                                <?php  }  ?>
                                
                            </ul> 
                        </div>
                        <span id="chat-bottom">mk</span>
                    </div>        
                        <form method="post" action="" id="add_ticket_chat">
                            <div class="col-xs-9">
                                <input class="form-control chat-input" name="chat_input" placeholder="Enter your text" type="text" maxlength="255">
                            </div>
                            <div class="col-xs-3 chat-send">
                                <input name="ticket_id" value="{{ $value['ticket_id'] }}" type="hidden">
                                <input type="hidden" name="sender_type" value="">
                                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>   
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<!--main content end-->

<script>
    // add new ticket mesg
    $(document).ready(function(){
        $(document).on('click','.chat-send', function(){ 
            var chatmsegtxt = $('input[name=\'chat_input\']').val();
            var ticket_id = $('input[name=\'ticket_id\']').val();
            var ticket_token = $('input[name=\'_token\']').val();
            chatmsegtxt = jQuery.trim(chatmsegtxt);
            if(chatmsegtxt == ''){
                $('input[name=\'chat_input\']').addClass('red_border');
                return false;
            } else{
                $('input[name=\'chat_input\']').removeClass('red_border');
            }
            $('.loader').show();
            
            $.ajax({
                type: 'post',
                url : "{{ url('admin/support-ticket/add/msg') }}",
                data : {'chat_input' : chatmsegtxt, 'ticket_id' :  ticket_id, '_token' : ticket_token},
                success : function(resp){

                    if(resp != ''){
                        $('.chat-view').html(resp);
                        $('.loader').hide();
                        $('input[name=\'chat_input\']').val('');
                        $(".chat-input").focus();

                        //for scrolling chat to the end
                        var chat_height = $('.conversation-list').height();
                        $('.chat-view').scrollTop(chat_height);
                    } else{
                        $('.loader').hide();
                        return false;
                    }
                }
            });
            return false;
        });  

        //for scrolling chat to the end
        var chat_height = $('.conversation-list').height();
        $('.chat-view').scrollTop(chat_height);

    });
</script>

@endsection