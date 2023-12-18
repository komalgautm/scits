$(document).ready(function(){
	
    $('.select_limit').change(function(){
        $('#records_per_page_form').submit();
    });

    $(".delete").on("click", function(){ 
        return confirm("Do you want to delete it ?");
    });

    
    $('.dpYears').datepicker({
        //maxDate: '2013-10-10'
    }).on('changeDate', function(e){
        if (e.viewMode === 'days') {
            $(this).datepicker('hide');
        }
    });

    autosize($("textarea"));
    
});    
