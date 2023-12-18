<style>
    .parentFlexInput {
        display: flex;
    }

    .ml-2 {
        margin-left: 20px;
    }

    .parentFlexInput input {
        width: 100px;
    }
</style>
<!-- Petty Cash Modal -->
<div class="modal fade" id="pettyCashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"> Petty Cash </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active logged-expense-btn" type="button"> Logged </button><!-- log-book-logged-btn -->
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div>

                    @include('frontEnd.common.popup_alert_messages')

                    <form method="post" action="{{ url('/general/petty-cash/add') }}" id='petty-cash-form' enctype="multipart/form-data">
                        <div class="add-new-box risk-tabs custm-tabs">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Title: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="">
                                        <input type="text" class="form-control" placeholder="" name="expense_title" />
                                    </div>
                                    <p class="help-block"> Enter the Title of Expense made and add details below.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Available cash: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="">
                                        <input name="title" type="text" value="" disabled class="form-control petty_available_bal" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Details: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="">
                                        <textarea class="form-control detail-info-txt" rows="3" name="expense_detail"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-2 col-sm-1 col-xs-12 p-t-7 text-right"> Amount: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="">
                                        <input name="expense_amount" type="text" class="form-control" placeholder="" />
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-1 col-xs-12 text-right"> Receipt: </label>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <div class="">
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-upload"></i> Upload</span>
                                        <input name="receipt_file" id="file_upload" class="receipt" type="file">
                                    </span>
                                </div>
                            </div>
                        </div> -->

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                <label class="col-md-2 col-sm-1 col-xs-12 text-right"> Receipt: </label>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 100px;">
                                            <img src="" alt="No File" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; min-width: 150px; min-height: 100px; line-height: 20px;"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <!-- <input name="image" type="file" class="default" id="img_upload"/> -->
                                                <input name="receipt_file" id="file_upload" class="receipt" type="file">
                                            </span>
                                            <!-- <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>Remove</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group modal-footer m-t-0 modal-bttm">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-warning submit-expense-report" type="submit"> Submit </button>
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
                        <form id="edit-daily-logged-form">
                            <div class="modal-space modal-pading logged-expense-reports text-center">
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

                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 type-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Type: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                <div class="select-style">
                                    <select name="expnse_rep_srch_type">
                                        <option value='expnse_title' <?php echo 'selected'; ?>> Title </option>
                                        <option value='expnse_date'> Date </option>
                                        <option value='expnse_amount'> Amount </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                                <input type="text" name="expnse_rep_title_srch" class="form-control"><!-- id="log-book-datepicker" -->
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Date: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15">
                                <div data-date-viewmode="" data-date-format="dd-mm-yyyy" data-date="" class="input-group date dpYears">
                                    <input name="expnse_rep_date_srch" type="text" value="" size="45" class="form-control" readonly="">
                                    <span class="input-group-btn add-on">
                                        <button class="btn clndr btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Amount: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                                <div class="parentFlexInput">
                                    <div>
                                        <input type="number" name="expnse_rep_amount1_srch" class="form-control">

                                    </div>
                                    <div class="ml-2">
                                        <input type="number" name="expnse_rep_amount2_srch" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="srchd-log-books-form" method="post">
                            <div class="modal-space modal-pading searched_expense_reports text-center">
                                <!-- <div class="modal-space searched_expense_reports p-t-0" > -->
                                <!--searched Record List using ajax -->
                            </div>
                        </form>

                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning expnse_rep_srch_btn" type="button"> Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    autosize($("textarea"));
    $('.petty-cash').click(function() {
        $('.loader').show();
        $('body').addClass('body-overflow');
        $.ajax({
            type: 'get',
            url: "{{ url('/general/petty_cash/check-balance') }}",

            success: function(resp) {

                if (isAuthenticated(resp) == false) {
                    return false;
                }
                $('.petty_available_bal').val(resp);
                $('#pettyCashModal').modal('show');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#file_upload").change(function() {
            var file_name = $(this).val();
            file_array = file_name.split('.');
            ext = file_array.pop();
            ext = ext.toLowerCase();
            if (ext == 'jpg' || ext == "jpeg" || ext == "gif" || ext == "png" || ext == "pdf" || ext == "doc" || ext == "docx" || ext == "wps") {
                input = document.getElementById('file_upload');

                if (input.files[0].size > 10240000 || input.files[0].size < 10240) {
                    $(this).val('');
                    // $("#file_upload").removeAttr("src");
                    alert("image size should be at least 10KB and upto 2MB");
                    return false;
                }
            } else {
                $(this).val('');
                alert('Please select .jpg, .png, .gif, .pdf .wps or .doc file format type.');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        today = new Date;
        $('#log-book-datetimepicker').datetimepicker({
            format: 'dd-mm-yyyy',
            // endDate: today,
            // minView : 2

        }).on("change.dp", function(e) {
            var currentdate = $(this).data("datetimepicker").getDate();
            var newFormat = currentdate.getDate() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getFullYear() + " " + currentdate.getHours() + ":" + currentdate.getMinutes();
            $('.log-book-datetime').val(newFormat);
        });

        $('#log-book-datetimepicker').on('click', function() {
            $('#log-book-datetimepicker').datetimepicker('show');
        });

        $("#logBookModal").scroll(function() {
            $('#log-book-datetimepicker').datetimepicker('place')
        });

        $('#log-book-datetimepicker').on('change', function() {
            $('#log-book-datetimepicker').datetimepicker('hide');
        });
    });
</script>

<script>
    //click search btn
    $('input[name=\'expnse_rep_date_srch\']').closest('.srch-field').hide();
    $('input[name=\'expnse_rep_amount1_srch\']').closest('.srch-field').hide();
    $('input[name=\'expnse_rep_amount2_srch\']').closest('.srch-field').hide();

    $(document).ready(function() {

        /*$( "#logBookModal" ).scroll(function() {
            $('#log-book-datepicker').datepicker('place')
        });*/

        $('input[name=\'expnse_rep_title_srch\']').keydown(function(event) {
            var keyCode = (event.keyCode ? event.keyCode : event.which);
            if (keyCode == 13) {
                $('.expnse_rep_srch_btn').click();
                return false;
            }
        });

        $('select[name=\'expnse_rep_srch_type\']').change(function() {

            $('.searched_expense_reports').html('');
            var expnse_rep_title_srch = $('input[name=\'expnse_rep_title_srch\']');
            var expnse_rep_date_srch = $('input[name=\'expnse_rep_date_srch\']');
            var expnse_rep_amount1_srch = $('input[name=\'expnse_rep_amount1_srch\']');
            var expnse_rep_amount2_srch = $('input[name=\'expnse_rep_amount2_srch\']');

            var type = $(this).val();
            if (type == 'expnse_date') {

                expnse_rep_date_srch.closest('.srch-field').show();
                expnse_rep_date_srch.removeClass('red_border');
                expnse_rep_title_srch.closest('.srch-field').hide();
                expnse_rep_amount1_srch.closest('.srch-field').hide();
                expnse_rep_amount2_srch.closest('.srch-field').hide();
            } else if (type == 'expnse_amount') {

                expnse_rep_amount1_srch.closest('.srch-field').show();
                expnse_rep_amount2_srch.closest('.srch-field').show();
                expnse_rep_amount1_srch.removeClass('red_border');
                expnse_rep_amount2_srch.removeClass('red_border');
                expnse_rep_title_srch.closest('.srch-field').hide();
                expnse_rep_date_srch.closest('.srch-field').hide();
            } else {

                expnse_rep_title_srch.closest('.srch-field').show();
                expnse_rep_title_srch.removeClass('red_border');
                expnse_rep_date_srch.closest('.srch-field').hide();
                expnse_rep_amount1_srch.closest('.srch-field').hide();
                expnse_rep_amount2_srch.closest('.srch-field').hide();
            }
        });

        $(document).on('click', '.expnse_rep_srch_btn', function() {

            var expnse_rep_srch_type = $('select[name=\'expnse_rep_srch_type\']');
            var expnse_rep_title_srch = $('input[name=\'expnse_rep_title_srch\']');
            var expnse_rep_date_srch = $('input[name=\'expnse_rep_date_srch\']');
            var expnse_rep_amount1_srch = $('input[name=\'expnse_rep_amount1_srch\']');
            var expnse_rep_amount2_srch = $('input[name=\'expnse_rep_amount2_srch\']');

            // Inputs
            var title_srch = expnse_rep_title_srch.val();
            var date_srch = expnse_rep_date_srch.val();
            var amount1 = expnse_rep_amount1_srch.val();
            var amount2 = expnse_rep_amount2_srch.val();
            var expnse_rep_srch_type = expnse_rep_srch_type.val();



            title_srch = jQuery.trim(title_srch);
            title_srch = title_srch.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');

            if (expnse_rep_srch_type == 'expnse_title') {

                if (title_srch == '') {

                    expnse_rep_title_srch.addClass('red_border');
                    return false;
                } else {
                    expnse_rep_title_srch.removeClass('red_border');
                }
            } else if (expnse_rep_srch_type == 'expnse_date') {

                if (date_srch == '') {
                    expnse_rep_date_srch.addClass('red_border');
                    return false;
                } else {
                    expnse_rep_date_srch.removeClass('red_border');
                }
            } else {
                if (amount1 == '') {
                    expnse_rep_amount1_srch.addClass('red_border');
                    return false;
                } else {
                    expnse_rep_amount1_srch.removeClass('red_border');
                }

                if (amount2 == '') {
                    expnse_rep_amount2_srch.addClass('red_border');
                    return false;
                } else {
                    expnse_rep_amount2_srch.removeClass('red_border');
                }
            }

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'post',
                url: "{{ url('/general/petty-cashes') }}" + '?search' + '&expnse_rep_title_srch=' + title_srch + '&expnse_rep_date_srch=' + date_srch + '&expnse_rep_srch_type=' + expnse_rep_srch_type + '&expnse_rep_amount1_srch=' + amount1 + '&expnse_rep_amount2_srch=' + amount2,

                success: function(resp) {

                    if (isAuthenticated(resp) == false) {
                        return false;
                    }
                    if (resp == '') {
                        $('.searched_expense_reports').html('No Reports found.');
                    } else {
                        $('.searched_expense_reports').html(resp);
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

<script>
    $(document).ready(function() {

        $('.logged-expense-btn').click(function() {

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'get',
                url: "{{ url('/general/petty-cashes') }}" + '?logged',
                success: function(resp) {
                    if (isAuthenticated(resp) == false) {
                        return false;
                    }

                    if (resp == '') {
                        $('.logged-expense-reports').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');
                    } else {
                        $('.logged-expense-reports').html(resp);
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
    $(document).ready(function() {

        //detail option
        $(document).on('click', '.expense-detail', function() {

            var detail_btn = $(this);
            var expnse_rep_id = $(this).attr('expnse_rep_id');
            //if edit button is already clicked then don't click detail button
            var edit_log_record_btn = detail_btn.closest('.pop-notification').find('.edit_log_record_btn');
            /*if(edit_log_record_btn) {
                alert(1); return false;
            } else {
                alert(2); return false;
            }*/
            if (edit_log_record_btn.hasClass('active')) {

                // $('.edit_record_score_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_detail_'+service_user_daily_record_id).attr('disabled','disabled');
                // $('.edit_record_id_'+service_user_daily_record_id).attr('disabled','disabled');
                $(this).closest('.cog-panel').find('.input-plusbox').removeClass('edit');
                $(this).closest('.cog-panel').find('.input-plusbox').addClass('view');
                edit_log_record_btn.removeClass('active');
                $(this).toggleClass('active');
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
    $(document).on('click', '.expense_reports_paginate .pagination li', function() {

        var new_url = $(this).children('a').attr('href');
        if (new_url == undefined) {
            return false;
        }

        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type: 'get',
            url: new_url + '&logged',
            success: function(resp) {
                if (isAuthenticated(resp) == false) {
                    return false;
                }
                if (resp == 0) {
                    $('span.popup_error_txt').text('Error Occured');
                    $('.popup_error').show();
                } else {
                    $('.logged-expense-reports').html(resp);
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            }
        });
        return false;
    });
</script>

<script>
    $(function() {
        $('#petty-cash-form').validate({

            rules: {
                expense_title: "required",
                expense_detail: "required",
                expense_amount: {
                    required: true,
                    regex: /^[0-9',sSdD$€£.]/
                },
                receipt_file: "required",

            },
            messages: {
                expense_title: "This field is required",
                expense_detail: "This field is required",
                expense_amount: {
                    required: "This field is required",
                    regex: "This field should contain numbers only",
                },
                receipt_file: "Receipt required",

            },
            submitHandler: function(form) {
                form.submit();
            }
        })
        return false;
    });
</script>


<script>
    //3 tabs script only for general admin
    $('.logged-box').hide();
    $('.search-box').hide();
    $('.logged-btn').removeClass('active');
    $('.search-btn').removeClass('active');

    $('.add-new-btn').on('click', function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.add-new-box').show();

    });
    $('.logged-btn').on('click', function() { //alert(1);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.logged-box').show();

    });
    $('.search-btn').on('click', function() {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        $(this).closest('.modal-body').find('.risk-tabs').hide();
        $(this).closest('.modal-body').find('.search-box').show();

    });
</script>


<!-- <script>
    //cog icon on click event - options show
    $(document).ready(function(){ 
        $(document).on('click','.settings', function(){
            $(this).find('.pop-notifbox').toggleClass('active');
            $(this).closest('.cog-panel').siblings('.cog-panel').find('.pop-notifbox').removeClass('active');
        });
        $(document).on('click',function(e){
            e.stopPropagation();
            var $trigger = $(".settings");
            if($trigger !== e.target && !$trigger.has(e.target).length){
                $('.pop-notifbox').removeClass('active');
            }
        });
    });
</script>
 <script>
    $('.petty-cash').click(function(){
        
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'get',
                url  : "{{ url('/general/petty_cash/check-balance') }}",

                success : function(resp){
                  
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
</script>
 -->