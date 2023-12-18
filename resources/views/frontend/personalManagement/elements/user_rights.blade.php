<style>
    label.dash {
    color: #1f88b5;
    font-size: 20px;
    margin-bottom: 20px;
}
 .dashData {
    margin-bottom: 10px !important;
    display: inline-block !important;
    color: #4c4c46 !important;
    font-weight: 700 !important;
    font-size: 14px !important;
}
.panel{
    box-shadow:unset !important;
}
#map-canvas{
    height:200px;
    width: 200px;
}
.position-center{
    width: 100%;
}
.dashFlex {
    display: flex;
    justify-content: space-between;
}
.unsetCheck{
    margin:unset !important;
}
</style>
<div id="manager_access_rights" class="tab-pane">

    <div class="row">

        <div class="col-lg-12">

            <section class="panel">

                <div class="panel-body">

                    <div class="position-center">

                        <form role="form" action="" method="post">

                            <div class="form-group">

                               

                               <div class="form-group">

                                <div class=" col-sm-12 col-lg-12">

                                <label class="dash">Dashboard</label>
                                <div class="dashFlex"> 


                                  <?php  foreach($dashboard as $value){ ?>
                                   
                                  <div class="checkbox unsetCheck"> 

                                    <label class="dashData"><input type="checkbox" name="access_id[]" value="{{ $value['id'] }}" {{ (in_array($value['id'],$user_rights)) ? 'checked':'' }} disabled="">{{ ucfirst($value['module_name']) }}</label>

                                  </div>


                                  <?php } ?>
                                  </div>

                                </div>

                            </div>

                    

                          <?php foreach($managements as $management){ ?>

                            <div class="form-group">

                                <div class=" col-sm-10">

                                <label>{{ ucfirst($management['name']) }}</label>

                                  <?php foreach($management['module_list'] as $module){ ?>

                                  <div class="checkbox"> 

                                    <!-- name="module_code[]" value="{{ $module['module_code'] }}" -->

                                        <?php

                                        $chekd_checkbx = 0;

                                        $total_checkbx = 0;

                                        foreach($module['sub_modules'] as $sub_modules){

                                            if(in_array($sub_modules['id'],$user_rights)){

                                                $chekd_checkbx++; 

                                            }

                                            $total_checkbx++;

                                        }

                                    

                                        if($total_checkbx == $chekd_checkbx){

                                            $selected = 'y';

                                        } else{

                                            $selected = 'n';

                                        }

                                    

                                          ?>



                                    <label><input type="checkbox" class="acc_heading_chkbox" {{ ($selected == 'y') ? 'checked':'' }} disabled=""> {{ ucfirst($module['module_name']) }}</label>

                                    <ul type="none" class="sub-checkbox">

                                        <?php  foreach($module['sub_modules'] as $sub_modules){ ?>



                                        <li><label><input type="checkbox" name="access_id[]" value="{{ $sub_modules['id'] }}" {{ (in_array($sub_modules['id'],$user_rights)) ? 'checked':'' }} disabled="">{{ ucfirst($sub_modules['submodule_name']) }}</label></li>

                                        

                                        <?php } ?>

                                    </ul>

                                  </div>

                                  <?php } ?>

                                 

                                </div>

                            </div>

                          <?php } ?>



                            </div>

                        </form>

                    </div>

                </div>

            </section>

        </div>

    </div>

</div>



