<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use App\ServiceUserCalendarEvent;

class PlanBuilder extends Model
{
    protected $table = 'plan_builder';  

    public static function showFormWithValue($su_calendar_event_id = null) {

 		$su_event = ServiceUserCalendarEvent::select('su_calendar_event.id as su_calendar_event_id','su_calendar_event.title','su_calendar_event.plan_builder_id','su.id as su_id', 'su_calendar_event.formdata','u.id as user_id','u.user_name as user_name')
						->join('service_user as su', 'su.id', 'su_calendar_event.service_user_id')
						->where('su_calendar_event.id', $su_calendar_event_id)
						->leftJoin('user as u','u.id', 'su_calendar_event.user_id')
						//->where('home_id', $home_id)
						->first()
						->toArray();
		// echo "<pre>";
		// print_r($su_event);
		// die;
		$su_calendar_event_id = $su_event['su_calendar_event_id'];
		$form_values		  = $su_event['formdata'];
		$plan_builder_id	  = $su_event['plan_builder_id'];
		
		if(!empty($form_values)) {
	   		$form_values = json_decode($form_values);

	    	$plan = PlanBuilder::where('id', $plan_builder_id)->first();
	    	//echo '<pre>'; print_r($plan); die;  
	    	if(!empty($plan)) {
	    		$plan->pattern = json_decode($plan->pattern);
	    	
	    		$formdata = '';
	            $total_fields = 0;

		        foreach($form_values as $key => $value){
	                $form_column     = $key; 
	                $form_column_val = $value;

	                foreach ($plan->pattern as $key => $value) {
		            	
		            	$field_label = $value->label;
		                $column_name = $value->column_name;
		                $field_type  = $value->column_type;  
						

		                if($column_name == $form_column){

		                    $field_value = $form_column_val;  
	                        $total_fields++;

	                        if($field_type == 'Textbox'){ 
	                            $formdata .= '
	                                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
	                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
	                                                <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-0 p-t-5 text-right"> '.$field_label.': </label>
	                                                <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
	                                                    <div class="input-group popovr">
	                                                        <input name="formdata['.$column_name.']" value="'.$field_value.'" type="text" class="form-control edit_event" disabled="" />
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>';
	                        
	                        } else if($field_type == 'Selectbox'){
	                            $options = '';
	                            $option_name = '';
	                            $option_value = '';
	                            $opt = '';
	                            $j = 0;
	                            ///alert(option_count);
	                            //for($i=1; $i <= $option_count; $i++){
	                            foreach($value->select_options as $select_option){
	                                //echo '<pre>'; print_r($select_option);
	                                $select_option = (array)$select_option;
	                                //print_r($se['option_name']); die;

	                                $option_name    = $select_option['option_name'];
	                                //$option_value   = $select_option['option_value'];
	                                
	                                $selected = '';
	                                if($form_column_val == $option_name){
	                                    $selected = 'selected';
	                                } 

	                                //if( ($option_name !== '') && ($option_value !== '') ) {            
	                                    $options .= '<option value="'.$option_name.'" '.$selected.'>'.$option_name.'</option>';

	                                    $opt .= '<input type="hidden" name="formdata['.$key.'][select_options]['.$j.'][option_name]" value="'.$option_name.'">';
	                                    $j++;
	                                //}
	                        	}

	                            $formdata .= '
	                                <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
	                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 ">
	                                        <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-0 p-t-5 text-right"> '.$field_label.': </label>
	                                        <div class="col-md-10 col-sm-10 col-xs-10 r-p-0">
	                                            <div class="select-style">
	                                                <select name="formdata['.$column_name.']" disabled="" class="edit_event">
	                                                    '.$options.'
	                                                </select>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>'; 

	                        } else if($field_type == 'Textarea'){
	                            $formdata .='
	                                <div class="col-md-12 col-sm-12 col-xs-12 cog-panel p-0 r-p-15">
	                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
	                                        <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-0 p-t-5 text-right"> '.$field_label.': </label>
	                                        <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
	                                            <div class="input-group popovr">
	                                                <textarea name="formdata['.$column_name.']" class="form-control edit_event" disabled="" >'.$field_value.'</textarea>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>';

	                        } else if($field_type == 'Date'){
	                            $formdata .='
	                                <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng p-0">      
	                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
	                                        <label class="col-md-2 col-sm-2 col-xs-12 r-p-0 p-0 p-t-5 text-right"> '.$field_label.': </label>
	                                        <div class="col-md-10 col-sm-10 col-xs-12 r-p-0">
	                                            <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
	                                                <input name="formdata['.$column_name.']" readOnly type="text" value="'.$field_value.'" size="16" class="form-control edit_event" disabled="">
	                                                <span class="input-group-btn add-on">
	                                                    <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
	                                                </span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>';

	                        } else{
	                            $formdata .='';
	                        }
		                }
		            }

		        }
		    }
            $result['response']     = true;    
            //$result['form_id']    = $form->id;
            //$result['id']			= $su_event['su_calendar_event_id'];
            //$result['detail']     = $form->detail;
            $result['pattern']     	= $formdata;
    	} else{ 
            $result['response']     = false;
        }

        $result['title'] = $su_event['title'];
        $result['user_name'] = $su_event['user_name'];
            
        return $result;  
    }
    
    public static function getPlanPatternWithValue($su_calendar_event_id = null) {
    	
    	$su_event = ServiceUserCalendarEvent::select('su_calendar_event.id as su_calendar_event_id','su_calendar_event.title','su_calendar_event.plan_builder_id','su.id as su_id', 'su_calendar_event.formdata')
						->join('service_user as su', 'su.id', 'su_calendar_event.service_user_id')
						->where('su_calendar_event.id', $su_calendar_event_id)
						//->where('home_id', $home_id)
						->first();
				// 		->toArray();
		$plan_pattern = '';
		
		if(!empty($su_event)){

			$su_calendar_event_id = $su_event->su_calendar_event_id;
			$form_values		  = $su_event->formdata;
			$plan_builder_id	  = $su_event->plan_builder_id;
			
			if(!empty($form_values)) {

		   		$form_values = json_decode($form_values);
		   		$plan 		 = PlanBuilder::where('id', $plan_builder_id)->first();
		    	
		    	if(!empty($plan)) {
		    		$plan_pattern = json_decode($plan->pattern);
                    //echo '<pre>'; print_r($form_values); die;
		    	
		    		foreach($plan_pattern as $p_key => $pattern){
		    			$patrn_column_name = $pattern->column_name;
                        
                        //if(is_array($form_values)){
                        foreach($form_values as $key => $value) {

							$formdata_column_name  = $key;
							$formdata_column_value = $value;
				            // echo $formdata_column_value; die;
				            
							if($formdata_column_name == $patrn_column_name) { 
								$plan_pattern[$p_key]->value = $formdata_column_value;
							}
						}
                        
                        if(!isset($plan_pattern[$p_key]->value)){
                            $plan_pattern[$p_key]->value = '';
                        }
						
		    		}
		        }
		    }
		}
		//echo '<pre>'; print_r($plan_pattern); die;
		return $plan_pattern; 
    }
    
}