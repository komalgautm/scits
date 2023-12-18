<?php 
    $home_id = Auth::user()->home_id;
    $company_id = App\Models\Home::where('is_deleted','0')->where('id',$home_id)->value('admin_id');
    $manager_info = App\Models\CompanyManagers::where('status','1')
                                        ->where('is_deleted','0')
                                        ->where('company_id',$company_id)
                                        ->first();
?>


<style type="text/css">
    .wrap-info.text-center > img#manager_id {
        max-height:90px;
        min-height:90px;
        max-width:90px;
        min-width:90px;
        object-fit:cover; 
        /*margin-bottom:15px;*/
    }
    .hadr{
        background-color: #1f88b5;
    }
    .hadr .hadr_txt{
        color:white;
    }
</style>
<!-- modal here -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="call_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header hadr">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title hadr_txt">Contact to Company Manager</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="wrap-all text-center">
                    <?php if(empty($manager_info)){ ?>
                        <div class="mail-pop">
                            <div class="col-xs-12">
                                <div class="wrap-info text-center">
                                    <p>No company manager available to take call </p>
                                </div>
                            </div>
                        </div>
                    <?php } else{ ?>
                        <div class="mail-pop">
                            <div class="col-xs-3">
                                <div class="wrap-info text-center">
                                    <!-- <i class="fa fa-user"></i> -->
                                    <?php $image  = managerImagePath.'/'.'default_user.jpg';
                                        
                                        if(!empty($manager_info->image)){
                                            $image = managerImagePath.'/'.$manager_info->image;
                                        } 
                                        
                                    ?>
                                    <img src="{{ $image }}" alt="No image" id="manager_id" >

                                    
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="wrap-info text-left icons-social">
                                    <p> <i class="fa fa-user"></i> &nbsp;{{isset($manager_info->name)? $manager_info->name : ''}} </p>
                                   
                                    <p> <i class="fa fa-envelope"></i> <a href="mailto:{{isset($manager_info->email)? $manager_info->email : ''}}">{{isset($manager_info->email)? $manager_info->email : ''}}</a> </p>

                                   
                                    <p class="text-phone"> <i class="fa fa-phone"></i> {{isset($manager_info->contact_no)? $manager_info->contact_no : ''}}</p>
                                </div>
                            </div>
                        </div>
                       
                    <?php } ?>
                </div>
            </div>
            <div class="modal-body email_error"></div>
        </div>
    </div>
</div>
<!-- modal here -->
