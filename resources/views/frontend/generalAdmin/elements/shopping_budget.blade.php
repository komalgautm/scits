<!--  AddWeeklyMoney model start -->
<div class="modal fade" id="AddShoppingBudget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Set shopping budget for service users</h4>
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <form id="deposit_shopping_budget" method="post" action="{{ url('shopping_budget/add') }}">
                        {{ csrf_field() }}
                        <div class="form-group col-md-12 col-sm-12 col-xs-12"> 
                               <div class="form-group cross-icn">
                                    <label class="col-md-3 control-label">Allowance</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="select_allowance" id="select_allowance">
                                            <option value="">Select Allowance</option>
                                            <option value="Shopping Budget">Shopping Budget</option>
                                            <option value="Key Work Sessions">Key Work Sessions</option>                 
                                        </select>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">          
                           <div class="form-group cross-icn">
                                <label class="col-md-3 control-label">Action</label>
                                <div class="col-md-6">
                                
                                    <select class="form-control" name="action" id="select_action">
                                        <option value="">Select Action</option>
                                        <option value="Add">Add</option>
                                        <option value="Sub">Subtract</option>                 
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">          
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-tb-10 clr-blue fnt-20"> Service User's List </h3>
                            </div>
                            <div class="service-list-serv">
                                <div class="selct-serv-all">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="all_su_select" value=""> Select All</label>
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
                                            ?> 
                                        <li>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="allowance[{{ $su_key }}][service_user_id]" class="su" value="{{ $value['id'] }}">
                                                            <img src="{{ serviceUserProfileImagePath.'/'.$user_image }}" class="img-responsive1">{{ $value['name'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control m-t-10" name="allowance[{{ $su_key }}][amount]" placeholder="Enter Amount" value="" />
                                                </div>
                                                <!-- <input type="hidden" name="allowance[{{ $su_key }}][service_user_id]" value="{{ $value['id'] }}" > -->
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <label class="col-md-12 m-t-10"> Note: This money will be automatically added/subtracted to all selected service user's My money.</label>

                            <div class="modal-footer recent-task-sec p-b-5">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning" type="submit">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</div>
<!--  AddWeeklyMoney model end -->


<script>
    $(function(){
        $("#deposit_shopping_budget").validate({

            rules:{
                select_allowance       : "required",
                action                 : "required",
            },
            messages: {
                select_allowance : "This field is required",
                action           :   "This field is required",
            },
             submitHandler: function (form) {
              form.submit();
          }
        })
    });
</script>

<script>
    $(document).on('click','#AddShoppingBudget .all_su_select', function(){
        if($(this).is(':checked')) {
            $('#AddShoppingBudget .su').prop('checked',true); 
        } else {
            $('#AddShoppingBudget .su').prop('checked',false); 
        }
    });
    //$(".sr_usr_list").slimScroll({height:'500px'});
</script>

