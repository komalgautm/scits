<!--  AddWeeklyMoney model start -->
<div class="modal fade" id="AddWeeklyMoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Set weekly allowance for service users</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12"> 
                      
                        <form id="deposit_weekly_amount" method="post" action="{{ url('weekly-allowance/update') }}">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">          
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-tb-10 clr-blue fnt-20"> Service User's List </h3>
                            </div>
                            <div class="service-list-serv">
                                <?php
                                    $total_su         = count($service_users);
                                    $pre_selected_su  = 0;
                                    
                                    foreach($service_users as $su_key => $value){
                                        
                                        $allowance_info = App\WeeklyAllowance::getAllowanceInfo($value['id']);
                                        if($allowance_info['status'] == 'A'){
                                            $pre_selected_su++;
                                        }
                                    }
                                ?>

                                <div class="selct-serv-all">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="all_su_select" value="" {{ ($total_su == $pre_selected_su) ? 'checked' : '' }} > Select All</label>
                                    </div>
                                </div>
                                <div class="sr_usr_list">
                                <ul style="list-style-type:none">
                                    @foreach($service_users as $su_key => $value)
                                        <?php 
                                        if(!empty($value['image'])){
                                            $user_image = $value['image'];
                                        } else{
                                            $user_image = 'default_user.jpg';
                                        }
                                        $allowance_info = App\WeeklyAllowance::getAllowanceInfo($value['id']);
                                        $allowance_amount = $allowance_info['amount'];
                                        $allowance_status = $allowance_info['status'];

                                        ?> 
                                        <li>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="allowance[{{ $su_key }}][status]" class="su" value="A" {{ ($allowance_status == 'A') ? 'checked' : '' }}>
                                                            <img src="{{ serviceUserProfileImagePath.'/'.$user_image }}" class="img-responsive1">{{ $value['name'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control m-t-10" name="allowance[{{ $su_key }}][amount]" placeholder="Enter Amount" value="{{ $allowance_amount }}" />
                                                </div>
                                                <input type="hidden" name="allowance[{{ $su_key }}][service_user_id]" value="{{ $value['id'] }}" >
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                                </div>
                            </div>
                            <label class="col-md-12 m-t-10"> Note: This money will be automatically added to all selected service user's My money on every week.</label>

                            <div class="modal-footer recent-task-sec p-b-5">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning" type="submit"> Confirm</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
<!--  AddWeeklyMoney model end -->

<script>
    $(document).on('click','#AddWeeklyMoney .all_su_select', function(){
        if($(this).is(':checked')) {
            $('#AddWeeklyMoney .su').prop('checked',true); 
        } else{
            $('#AddWeeklyMoney .su').prop('checked',false); 
        }
    });
    //$(".sr_usr_list").slimScroll({height:'500px'});
</script>

<!-- <script type="text/javascript">
    $(document).on('change','#select_allowance',function(){
        // alert(1);
        var select_allowance = $(this).val();
        alert(select_allowance);
        // $('#allowance').submit();
    });
</script>

<script type="text/javascript">
    $(document).on('change','#select_action',function(){
        var select_action = $(this).val();
        alert(select_action);
    });
</script> -->


