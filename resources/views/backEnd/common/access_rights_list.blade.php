<div class="label_selct">
  <div class="checkbox"> 
    <label><input name="access_id[]" class="select_all" value="172" checked="" type="checkbox">[ Select All ]</label>
  </div>
</div>

    <div class="form-group">
        <div class=" col-sm-10">
        <label>Dashboard</label>
          <?php  foreach($dashboard_rights as $value){ ?>
          <div class="checkbox"> 
            <label><input type="checkbox" name="access_id[]" value="{{ $value['id'] }}" {{ (in_array($value['id'],$available_rights)) ? 'checked':'' }} >{{ ucfirst($value['module_name']) }}</label>
          </div>
          <?php } ?>
        </div>
    </div>

  <?php foreach($access_rights as $management){ ?>
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
                    if(in_array($sub_modules['id'],$available_rights)){
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

            <label><input type="checkbox" class="acc_heading_chkbox" {{ ($selected == 'y') ? 'checked':'' }} > {{ ucfirst($module['module_name']) }}</label>
            <ul type="none" class="sub-checkbox">
                <?php  foreach($module['sub_modules'] as $sub_modules){ ?>

                <li><label><input type="checkbox" name="access_id[]" value="{{ $sub_modules['id'] }}" {{ (in_array($sub_modules['id'],$available_rights)) ? 'checked':'' }} >{{ ucfirst($sub_modules['submodule_name']) }}</label></li>
                
                <?php } ?>
            </ul>
          </div>
          <?php } ?>
         
        </div>
    </div>
  <?php } ?>           

<script type="text/javascript">
$(document).ready(function() {
    $('.acc_heading_chkbox').click(function(){
        
        if($(this).is(':checked')) { 
            $(this).parent().siblings('ul').find('input').prop('checked',true);
        } else{ 
            $(this).parent().siblings('ul').find('input').prop('checked',false);
        }
    });
});

$(document).ready(function() {
    $('.select_all').click(function(){
        if($(this).is(':checked')) { 
            $(this).closest('form').find('input').prop('checked',true);
        } else{ 
            $(this).closest('form').find('input').prop('checked',false);
        }
    });
});
</script>
