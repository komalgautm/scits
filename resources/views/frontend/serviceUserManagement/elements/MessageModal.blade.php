<!-- Plan Modal -->
<div class="modal fade" id="messageModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Message Section </h4>
            </div>
            <div class="modal-body" >
                <div class="row">  
                    <div class="foor-box-wrap foor-plan">
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" class="message_office" rel="{{ $service_user_id }}" title="Message">
                                    <section class="panel text-center profile-square" style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row red-bg">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                Office Messages
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>    
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="#" class="need_assistance" rel="{{ $service_user_id }}" title="Message">
                                    <section class="panel text-center profile-square" style="height: 191px">
                                        <div class="plan-user-heading alt wdgt-row label-success">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div class="panel-body">
                                            <div class="wdgt-text">
                                                Need Assistance
                                            </div>
                                        </div>
                                    </section>
                                </a>    
                            </div>
                        </div>
                        <!-- <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 bmp_plan_modal" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-danger">
                                        <i class="fa fa-frown-o"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            Message Plan 3
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>   
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 education-record-list" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-inverse">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            Message Plan 4
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".need_assistance").on('click',function(){
        var service_user_id = $(this).attr('rel');
        $.ajax({
            url: "{{ url('message/need_assistance') }}" + "/" + service_user_id,
            method: "GET",
            success: function(data){
                $(".chat-view-click").html(data);
                $("#messageModel").modal("hide");
                $("#needModal").modal("show");
            },
            error: function(){

            }
        })
    });

</script>

                        
