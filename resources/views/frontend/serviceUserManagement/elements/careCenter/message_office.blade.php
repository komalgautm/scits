<!-- View Office Messages chat modal -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <section class="panel">
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#careCenterModel" class="close" style="padding-right:6px"> <i class="fa fa-arrow-left"></i></a>
                    <h4 class="modal-title" id="mySmallModalLabel"> Office Messages </h4>
                </div>
                <div class="panel-body ">
                    <div class="chat-view-click cht-hgt cal_evnt_scroller chat-view">
                        <!--  chat shown using ajax -->
                    </div>
                    <form method="post" action="" id="add_office_message">
                        <div class="row">
                            <div class="col-xs-9">
                                <input type="text" class="form-control chat-input" name="chat_input" placeholder="Enter your text">
                            </div>
                            <div class="col-xs-3 chat-send">
                                <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
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

<script>
    //add office message by Staff
    $(function(){
        $("#add_office_message").validate({
            rules:{
                "chat_input":{
                    required:true
                }
            },
            submitHandler: function(form){

                $('.loader').show();
                $('body').addClass('body-overflow');

                $.ajax({
                    type:"POST",
                    dataTYpe:"JSON",
                    data:$("#add_office_message").serialize(),
                    url: "{{ url('/service/care-center/message-office/add')}}",
                    success: function(data){

                        if(isAuthenticated(data) == false){
                            return false;
                        }

                        $(".chat-view-click").html(data);
                        $(".chat-input").val("");                    

                        //for scrolling chat to the end
                        var chat_height = $('.conversation-list').height();
                        $('.chat-view').scrollTop(chat_height);

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');

                    },
                    error: function(){
                        alert("{{ COMMON_ERROR }}");

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    }
                });
            }
        });
    });



    // event_count = $('.scroller_cal_evnt .external-event').length;
    // if(event_count > 4){
    //     $('.scroller_cal_evnt').slimScroll({height:'140px'});            
    // }
</script>