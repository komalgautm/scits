<!-- Petty Cash Modal -->
<div class="modal fade" id="addPettyCashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"> Petty Cash </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active logged-petty-btn" type="button"> Logged </button><!-- log-book-logged-btn -->
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    @include('frontEnd.common.popup_alert_messages')

                <form method="post" action="{{ url('/profile/petty_cash/add-cash') }}" id='petty-cash-form' enctype="multipart/form-data">
                    <div class="add-new-box risk-tabs custm-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="">
                                    <input name="title" type="text" value="Add petty cash" disabled class="form-control" placeholder=""  />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Available cash: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="">
                                    <input name="title" type="text" value="" disabled class="form-control petty_available_bal"   />
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Details: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="">
                                    <textarea  class="form-control detail-info-txt" rows="3" name="detail" ></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Amount: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="">
                                    <input name="amount" type="text"  class="form-control" placeholder=""  />
                                </div>
                            </div>
                        </div>

                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning submit-cash" type="button"> Submit </button>
                        </div>
                    </div>
                </form>

                <!-- logged plans -->
                <div class="logged-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Logged </h3>
                        </div>
                    <!-- alert messages -->
                    <!-- @include('frontEnd.common.popup_alert_messages') -->
                    <form id="edit-daily-logged-form" >
                        <div class="modal-space modal-pading logged-petty-reports text-center">
                            <!-- logged book list be shown here using ajax -->
                        </div>
                    </form>


                    <div class="modal-footer m-t-0 recent-task-sec">
                        <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <!-- <button class="btn btn-warning logged_daily_record_btn" type="button"> Confirm</button> -->
                    </div>
                </div>

                <div class="search-box risk-tabs custm-tabs">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="m-t-0 m-b-20 clr-blue fnt-20">Search</h3>
                    </div>

                    <!-- <div class="col-md-12 col-sm-12 col-xs-12 p-0 type-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Type: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                            <div class="select-style">
                                <select name="petty_srch_type">
                                    <option value='expnse_title' <?php echo 'selected';?>> Title </option>
                                    <option value='expnse_date'> Date </option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                   <!--  <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                            <input type="text" name="petty_title_search" class="form-control">
                        </div>
                    </div> -->

                    <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                        <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl text-right"> Date: </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                            <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears">
                                <input name="petty_date_srch" type="text"  value="" size="45" class="form-control" readonly="">
                                <span class="input-group-btn add-on">
                                    <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <form id="srchd-log-books-form" method="post">
                        <div class="modal-space modal-pading searched_petty_details text-center">
                        <!-- <div class="modal-space searched_expense_reports p-t-0" > -->
                        <!--searched Record List using ajax -->
                        </div>
                    </form>

                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning petty_srch_btn" type="button"> Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

<script>
    $(document).ready(function(){

        $('.add-petty-cash').click(function(){
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'get',
                url  : "{{ url('/profile/petty_cash/check-balance') }}",

                success : function(resp){
                    // console.log(resp);
                    if(isAuthenticated(resp) == false){
                        
                        return false;
                    }

                    $('.petty_available_bal').val(resp);

                    $('#addPettyCashModal').modal('show');

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            
        });
    });

</script>
<!--on submit, the modal remains still -->
<script>
    $('.submit-cash').click(function(){
        
            var amount = $('input[name=\'amount\']').val();
            var detail = $('textarea[name=\'detail\']').val();
            if( (amount == '') || (detail == '') ){
                return false;
            }  
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            var formdata = $('#petty-cash-form').serialize();
           
            $.ajax({
                type : 'post',
                url  : "{{ url('/profile/petty_cash/add-cash') }}",
                data : formdata,
                success : function(resp){
                    //alert(resp);
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
    
                    if(resp == 'true'){
                        $('input[name=\'amount\']').val('');
                        $('textarea[name=\'detail\']').val('');
                        $('.add-petty-cash').click();

                        $('span.popup_success_txt').text('Petty cash added successfully');
                        $('.popup_success').show();
                        setTimeout(function(){$('.popup_success').fadeOut()}, 5000);

                    } else{
                        $('span.popup_error_txt').text('{{ UNAUTHORIZE_ERR }}');
                        $('.popup_error').show();
                        setTimeout(function(){$('.popup_error').fadeOut()}, 5000);
                    }

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');

                    return false;
                }
            });
        
    });
</script>

<script>
   
/*--search by date---*/
    $(document).ready(function(){
    
        $('input[name=\'petty_title_search\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                return false;
            }
        });
        
        $('select[name=\'petty_srch_type\']').change(function(){

            $('.searched_petty_details').html('');
            var petty_title_search = $('input[name=\'petty_title_search\']');
            var petty_date_srch  = $('input[name=\'petty_date_srch\']');

            var type = $(this).val(); 
            if(type == 'expnse_date'){

                petty_date_srch.closest('.srch-field').show();
                petty_date_srch.removeClass('red_border');
                petty_title_search.closest('.srch-field').hide();
            }
            else{
                petty_title_search.closest('.srch-field').show();
                petty_title_search.removeClass('red_border');
                petty_date_srch.closest('.srch-field').hide();
            }            
        });

        $(document).on('click','.petty_srch_btn', function(){

            var petty_srch_type   = $('select[name=\'petty_srch_type\']');
            var petty_title_search = $('input[name=\'petty_title_search\']');
            var petty_date_srch = $('input[name=\'petty_date_srch\']');
            
            // Inputs
            var title_srch          = petty_title_search.val();
            var date_srch           = petty_date_srch.val();
            var petty_srch_type = petty_srch_type.val();

            title_srch = jQuery.trim(title_srch);
            title_srch = title_srch.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');

            // if(petty_srch_type == 'expnse_title'){

            //     if(title_srch == ''){

            //         petty_title_search.addClass('red_border');
            //         return false;
            //     } else{
            //         petty_title_search.removeClass('red_border');
            //     }
            // }
            // else{
                if(date_srch == ''){

                    petty_date_srch.addClass('red_border');
                    return false;
                } else{
                    petty_date_srch.removeClass('red_border');
                }
            // }

            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'post',
                //url  : "{{ url('/general/petty-cashes') }}"+'?search'+'&expnse_rep_title_srch='+title_srch+'&expnse_rep_date_srch='+date_srch+'&expnse_rep_srch_type='+expnse_rep_srch_type,
                url  : "{{ url('/profile/petty-cashes') }}" +'?search'+'&petty_title_search='+title_srch+'&petty_date_srch='+date_srch+'&petty_srch_type='+petty_srch_type,    

                success : function(resp){
                  
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == ''){
                        $('.searched_petty_details').html('No Reports found.');
                    } else{
                        $('.searched_petty_details').html(resp);
                    }
                    /*$('input[name=\'expnse_rep_title_srch\']').val('');
                    $('input[name=\'expnse_rep_date_srch\']').val('');*/
                    
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>

<!--logged -->
<script>
    $(document).ready(function(){

        $('.logged-petty-btn').click(function(){
            
            $('.loader').show();
            $('body').addClass('body-overflow');
        
            $.ajax({
                type : 'get',
                 url  : "{{ url('/profile/petty-cashes') }}" + '?logged',     
                success:function(resp) {
                    //alert(resp); 
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if (resp == '') {
                        $('.logged-petty-reports').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    } else {
                        $('.logged-petty-reports').html(resp);
                    }
                    //$('.logged-expense-reports').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>

<!-- Expense Report Details  -->
<script>
    $(document).ready(function(){

        //detail option
        $(document).on('click','.petty-detail', function(){
           
            var detail_btn = $(this);
            var expnse_rep_id = $(this).attr('expnse_rep_id');  


            //if edit button is already clicked then don't click detail button
            var edit_log_record_btn = detail_btn.closest('.pop-notification').find('.edit_log_record_btn');
             //alert(edit_log_record_btn);
            /*if(edit_log_record_btn) {
                alert(1); return false;
            } else {
                alert(2); return false;
            }*/
            if(edit_log_record_btn.hasClass('active')){
                
                // $('.edit_record_score_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_detail_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_record_id_'+service_user_daily_record_id).attr('disabled','disabled');
                $(this).closest('.cog-panel').find('.input-plusbox').removeClass('edit');
                $(this).closest('.cog-panel').find('.input-plusbox').addClass('view');
                edit_log_record_btn.removeClass('active');
                $(this).toggleClass('active');
                autosize($("textarea"));
                return false;    
            }

            $(this).closest('.cog-panel').find('.input-plusbox').toggle();
            $(this).closest('.cog-panel').find('.input-plusbox').toggleClass('view');
            $(this).toggleClass('active');
            $(this).closest('.pop-notifbox').removeClass('active');
            autosize($("textarea"));
            return false;
        });
    });
</script>

<!-- Pagination -->
<script>
    //pagination
    $(document).on('click','.petty_reports .pagination li',function(){

        var new_url = $(this).children('a').attr('href');
        if(new_url == undefined){
            return false;
        }
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'get',
            url  : new_url+'&logged',
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }
                if (resp == 0){
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {
                    $('.logged-petty-reports').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            }
        });
        return false;
    });
</script>

<!-- <script>
    $(function(){
        $('#petty-cash-form').validate({

            rules: {
                expense_title : "required",
                expense_detail: "required",
                expense_amount : {
                    required : true,
                    regex : /^[0-9',sSdD$€£.\s]/
                },
                receipt_file : "required",

            },
            messages: {
                expense_title : "This field is required", 
                expense_detail: "This field is required",
                expense_amount: {
                    required : "This Field is required",
                    regex : "Invalid Character",
                },
                receipt_file : "Receipt required",

            },
            submitHandler:function(form) {
                form.submit();
            }
        })
        return false;
    });
</script>
 -->

<script>
    //3 tabs script only for general admin
    $('.logged-box').hide();
    $('.search-box').hide();
    $('.logged-btn').removeClass('active');
    $('.search-btn').removeClass('active');

    $('.add-new-btn').on('click',function(){ 
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.add-new-box').show();

    });
    $('.logged-btn').on('click',function(){ //alert(1);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.logged-box').show();

    });
    $('.search-btn').on('click',function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.search-box').show();

    });
</script>