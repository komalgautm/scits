<!-- Plan Modal -->
<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Plans </h4>
            </div>
            <div class="modal-body" >
                <div class="row">  
                    <div class="foor-box-wrap foor-plan">
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10">
                            <div class="profile-nav alt profile-plan-div">
                                <a href="{{ url('/service/placement-plans/'.$service_user_id) }}">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row red-bg">
                                        <i class="{{ $labels['placement_plan']['icon'] }}"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            {{ $labels['placement_plan']['label'] }}
                                        </div>
                                    </div>
                                </section>
                                </a>
                            </div>
                        </div>    
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 rmp_plan_modal" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-success">
                                        <i class="{{ $labels['rmp']['icon'] }}"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            {{ $labels['rmp']['label'] }}
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 bmp_plan_modal" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-danger">
                                        <i class="{{ $labels['rmp']['icon'] }}"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            {{ $labels['bmp']['label'] }}
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>   
                        <div class="col-md-5 col-sm-5 col-xs-12 m-t-10 m-b-10 education-record-list" data-dismiss="modal" aria-hidden="true">
                            <div class="profile-nav alt profile-plan-div">
                                <section class="panel text-center profile-square" style="height: 191px">
                                    <div class="plan-user-heading alt wdgt-row label-inverse">
                                        <i class="{{ $labels['education_record']['icon'] }}"></i>
                                    </div>
                                    <div class="panel-body">
                                        <div class="wdgt-text">
                                            {{ $labels['education_record']['label'] }}
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // open rmp modal on click
    $(document).ready(function(){
        $(document).on('click','.rmp_plan_modal', function(){
            $('#rmpModal').modal('show');
            $('input[name=\'search_rmp_record\']').val('');
        });
        // FOR rmp back btn while view/edit
        $(document).on('click','.view-rmp-back-btn', function(){
            $('#rmpModal').modal('show');
        });
        // FOR bmp/rmp back btn while view/edit
        $(document).on('click','.plan-back-btn2', function(){
            $('#PlanRecordModal').modal('show');
        });
        // For rmp view modal submit
        $(document).on('click','.sbt-rmp-back-btn', function(){
            $('#rmpModal').modal('show');
        });
        //For bmp/rmp view modal submit
        $(document).on('click','.sbt-plan-back-btn', function(){
            $('#PlanRecordModal').modal('show');
        });
        $('#rmpModal').on('scroll',function(){
            $('.dpYears').datepicker('place')
        });

        $(document).on('click','.bmp_plan_modal', function(){
            $('input[name=\'search_bmp_record\']').val('');
            $('#BMPAddModal').modal('show');
        });
    });
</script> -->
<script type="text/javascript">
    $(document).on('click','.education-record-list',function(){

            $('.loader').show();
            $('body').addClass('body-overflow');
    
            /*$.ajax({
                type : 'get',
                url  : "{{ url('/service/daily-record/options') }}",  
                //dataType : 'json', 
                success:function(resp){
                    
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    $('#edu_records_list').append(resp);  */    
                    var service_user_id = "{{ $service_user_id }}";

                    $.ajax({
                        type: 'get',
                        url : "{{ url('/service/education-records') }}"+'/'+service_user_id,
                        success:function(resp2){
                            
                            if(isAuthenticated(resp2) == false){
                                return false;
                            }
                            $('.su-edu-records').html(resp2);
                            $('#educationRecordModal').modal('show');
                            $('.add-new-btn').click();          
                            $('.loader').hide();
                            $('body').removeClass('body-overflow');
                        }
                    });
                /*}
            });*/
        });
</script>
