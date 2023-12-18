    
<!--Agenda & Meetings-->
<style type="text/css">

    .stf_select .error {
        margin-top:32px;
        position:absolute;
    }
    .selection .select2-selection--multiple .select2-selection__rendered .select2-search .select2-search__field {
        width:100% !important;
        /*border: 1px solid #f0f0f1 !important;*/
    }

</style>

<div class="modal fade" id="AgendaMeetingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agenda & Meetings</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
       
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn logged-agenda-btn" type="button"> Logged Files </button>
                        <button class="btn label-default search-btn" type="button"> Search </button>
                    </div>

                     <!-- Add new Details -->
                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 fnt-20 clr-blue rmp-details"> Add Details </h3>
                        </div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                       <form id="agenda_meeting" action="" method="POST">
                            
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0" id="grp-frm-class">
                                <label class="col-md-3 col-sm-1 p-t-7 text-right"> Title: </label>
                                <div class="col-md-9 col-sm-11 col-xs-12">
                                    <div class="input-group popovr">
                                        <input type="text" name="title" class="form-control title" required="">
                                    </div>
                                </div>
                            </div> 

                             <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 stf_select">
                                <label class="col-md-3 col-sm-1 p-t-7 text-right"> Staff Present: </label>
                                <div class="col-md-9 col-sm-11 col-xs-12">
                                    <div class="input-group popovr">
                                        <select class="select-present-user form-control users_list" multiple="multiple" id="records_list" style="width:100%;" name="attended_user_ids[]">
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                <option value="{{$user['id']}}">{{ $user['name'] }}</option>
                                            @endforeach    
                                        </select>
                                    </div>
                                </div>
                            </div>    

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 stf_select">
                                <label class="col-md-3 col-sm-1 p-t-7 text-right"> Staff Not Present: </label>
                                <div class="col-md-9 col-sm-11 col-xs-12">
                                    <div class="input-group popovr">
                                        <select class="select-present-user form-control users_list" multiple="multiple" style="width:100%;" name="not_attended_user_ids[]" id="">
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                <option value="{{$user['id']}}">{{ $user['name'] }}</option>
                                            @endforeach    
                                        </select>
                                       
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                                <label class="col-md-3 col-sm-1 p-t-7 text-right"> Notes: </label>
                                <div class="col-md-9 col-sm-11 col-xs-12">
                                    <div class="input-group popovr">
                                        <textarea type="text" name="notes" class="form-control" rows="3" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal-footer m-t-0 m-b-15 modal-bttm">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <button class="btn btn-warning sbt_add_meeting_btn" type="submit"> Confirm </button>
                            </div>
                        </form>
                    </div>

                    <!-- Logged Files -->
                    <div class="logged-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 fnt-20 clr-blue"> Logged Records </h3>
                        </div>
                         <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <div class="modal-space modal-pading logged-meeting-record">  
                                <!-- record shown using Ajax -->               
                        </div>
                        <div class="modal-footer m-t-0 recent-task-sec" style="visibility: hidden">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning sbt-edit-bmp-record" type="button"> Confirm</button>
                        </div>                      
                    </div>
                   
                   <!-- Search Box -->
                    <div class="search-box risk-tabs custm-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 fnt-20 clr-blue">Search</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">
                            <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Title: </label>
                            <div class="col-md-9 col-sm-9 col-xs-12 p-0 m-b-15 title">
                                <input type="text" name="search_meeting_record" class="form-control" maxlength="255">
                            </div>
                        </div>
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <form id="searched-meeting-records-form" method="post">
                            <div class="modal-space modal-pading searched-meeting-record text-center">
                            <!--searched Record List using ajax -->
                            </div>
                        </form>
                        <div class="modal-footer m-t-0 recent-task-sec">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning sbt-e-meeting-btn" type="button"> Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>


<!-- View/Edit Meeting Record Modal -->
<div class="modal fade" id="MeetingAgendaEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" data-target="#AgendaMeetingModal" data-toggle="modal" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title"> Meeting Agenda </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="edit_agenda_meeting" action="" method="POST">      
                       
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0" id="edit-grp-frm-class">
                            <label class="col-md-3 col-sm-1 p-t-7 text-right"> Title: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12">
                                <div class="input-group popovr">
                                    <input type="text" name="e_title" class="form-control title" required="">
                                </div>
                            </div>
                        </div> 

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 stf_select">
                            <label class="col-md-3 col-sm-1 p-t-7 text-right"> Staff Present: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12">
                                <div class="input-group popovr">
                                    <select class="select-absent-user form-control" multiple="multiple" id="" style="width:100%;" name="e_attended_user_ids[]">
                                        <option value=""></option>
                                        @foreach($users as $user)
                                            <option value="{{$user['id']}}">{{ $user['name'] }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                        </div>  

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 stf_select">
                            <label class="col-md-3 col-sm-1 p-t-7 text-right"> Staff Not Present: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12">
                                <div class="input-group popovr">
                                    <select class="select-absent-user form-control" multiple="multiple" style="width:100%;" name="e_not_attended_user_ids[]" id="">
                                        <option value=""></option>
                                        @foreach($users as $user)
                                            <option value="{{$user['id']}}">{{ $user['name'] }}</option>
                                        @endforeach    
                                    </select>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-3 col-sm-1 p-t-7 text-right"> Notes: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12">
                                <div class="input-group popovr">
                                    <textarea type="text" name="e_notes" class="form-control" rows="3" required="" id="agenda_inf"></textarea>
                                </div>
                            </div>
                        </div>
                    
                        <div class="modal-footer m-t-0 m-b-15 modal-bttm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="agenda_meeting_id" value="">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning sbt_edit_meeting_btn" type="submit" id="sbt-edit-dis"> Confirm </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- View/Edit Meeting Record Modal End -->

<script>
    $(".select-present-user").select2({
          dropdownParent: $('#AgendaMeetingModal'),
          placeholder: "Select User"
    });
    $(".select-absent-user").select2({
          dropdownParent: $('#MeetingAgendaEdit'),
          placeholder: "Select User"
    });
</script>


<script> 
    $(document).ready(function(){
        
        $('.sbt_add_meeting_btn').click(function(){
            $('#grp-frm-class').removeClass('form-group').addClass('div_space');
        });

        //add agenda record
        $(function(){    
            $("#agenda_meeting").validate({
                rules:{
                    "title":{
                        required:true
                    },
                    "attended_user_ids[]": {
                        required:true                    
                    },
                    /*"not_attended_user_ids[]": {
                        required:true
                        //equalTo : "#records_list"
                        //notEqual:"#records_list"
                    },*/
                    "notes":{
                        required:true
                    }
                },
                submitHandler:function(form) {

                    $('.loader').show();
                    $('body').addClass('body-overflow');

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: $('#agenda_meeting').serialize(),
                        url: "{{ url('staff/meeting/add') }}",
                        success: function(data){
                            if(isAuthenticated(data) == false) {
                                return false;
                            }

                           if(data == true) {
                            //alert(true); 
                            $('span.popup_success_txt').text(' Agenda added successfully');
                            $('.popup_success').show();
                            setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                            // $('input[name=\'title\']').val('');
                            // $('textarea[name=\'notes\']').val('');
                            $('.users_list').val([]).change();
                            $('#agenda_meeting')[0].reset();

                           }  else {
                            $('span.popup_error_txt').text('Error Occured');
                            $('.popup_error').show();
                            setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                           }

                            $('.loader').hide();
                            $('body').removeClass('body-overflow');
                        },
                        error: function(){
                            // alert(COMMON_ERROR);
                            alert("Some error occured, Please try again after sometime.");
                            $('.loader').hide();
                            $('body').removeClass('body-overflow');
                        }
                    });
                    return false;
                }
            });
        })
    });   
</script>

<script>
    //logged agenda records
    $(document).ready(function(){
        $(document).on('click','.logged-agenda-btn', function(){

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get', 
                url  : "{{ url('/staff/meetings') }}",
                success: function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    } if(resp == '') {
                         $('.logged-meeting-record').html('<div class="text-center p-b-20"style="width:100%"> No Records found. </div>');
                    } else {

                        $('.logged-meeting-record').html(resp);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });
    });
</script>



<script>
    //pagination of agendaMeeting
    $(document).ready(function(){

        $(document).on('click','#AgendaMeetingModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();

            if(page_no == '') {
                return false;
            }
            if(isNaN(page_no)) {
                var new_url = $(this).children('a').attr('href');
                page_no = new_url[new_url.length -1];
            }
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type : 'get',
                url  : "{{ url('/staff/meetings') }}"+"?page="+page_no,
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.logged-meeting-record').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>

<script>
    //delete agenda record
    $(document).ready(function(){
        $(document).on('click','.delete_agenda_record', function(){
            if(!confirm('{{ DEL_CONFIRM }}')){
                return false;
            }
            var meeting_id = $(this).attr('agenda_meeting_id');
            var this_record = $(this);

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'get',
                url : "{{ url('staff/meeting/delete/') }}"+'/'+meeting_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp ==1) {
                        this_record.closest('.meeting_record_delete').remove();
                        //show success delete message
                        $('span.popup_success_txt').text('Agenda record deleted successfully');                   
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else {
                        //show delete message error
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.pop-notifbox').removeClass('active');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>

<script>
    //view agenda record
    $(document).ready(function(){

        $(document).on('click','.edit_agenda_record', function(){
            var meeting_id = $(this).attr('agenda_meeting_id');
            getAgendaRecords(meeting_id);            
            $('#edit_agenda_meeting').find('input').attr('disabled',false);
            $('#edit_agenda_meeting').find('textarea').attr('disabled',false);
            $('#edit_agenda_meeting').find('select').attr('disabled',false);
            $('#sbt-edit-dis').attr('disabled',false);
            
        });

        $(document).on('click','.view_agenda_record', function(){
            var meeting_id = $(this).attr('agenda_meeting_id');

            getAgendaRecords(meeting_id);            

            $('#edit_agenda_meeting').find('input').attr('disabled',true);
            $('#edit_agenda_meeting').find('textarea').attr('disabled',true);
            $('#edit_agenda_meeting').find('select').attr('disabled',true);
            $('#sbt-edit-dis').attr('disabled',true);
        });

        function getAgendaRecords(meeting_id){
            
            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'get', 
                url : "{{ url('/staff/meeting/view/') }}"+'/'+meeting_id,
                dataTYpe : 'json',
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    if(response == true) {
                        var meeting_id        = resp['meeting_id'];
                        var title             = resp['title'];
                        var staff_present     = resp['staff_present'];
                        var staff_not_present = resp['staff_not_present'];
                        var notes             = resp['notes'];
                        $('input[name=\'agenda_meeting_id\']').val(meeting_id);
                        $('input[name=\'e_title\']').val(title);
                        $('select[name=\'e_attended_user_ids[]\']').val(staff_present);
                        $('select[name=\'e_not_attended_user_ids[]\']').val(staff_not_present);
                        $('textarea[name=\'e_notes\']').val(notes);

                        $(".select-absent-user").select2({
                              dropdownParent: $('#MeetingAgendaEdit'),
                              placeholder: "Select User"
                        });

                        $('#AgendaMeetingModal').modal('hide');
                        $('#MeetingAgendaEdit').modal('show');
                        setTimeout(function () {
                            var elmnt = document.getElementById("agenda_inf");
                            var scroll_height = elmnt.scrollHeight;
                            $('#agenda_inf').height(scroll_height);
                        },200);

                    } else {

                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.pop-notifbox').removeClass('active');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        }

    });

    /*$(document).ready(function(){
        $(document).on('click','.edit_agenda_record', function(){
            var meeting_id = $(this).attr('agenda_meeting_id');

            $('.loader').show();
            $('body').addClass('body-overflow');

            $.ajax({
                type: 'get', 
                url : "{{ url('/staff/meeting/view/') }}"+'/'+meeting_id,
                dataTYpe : 'json',
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    var response = resp['response'];
                    if(response == true) {
                        var meeting_id        = resp['meeting_id'];
                        var title             = resp['title'];
                        var staff_present     = resp['staff_present'];
                        var staff_not_present = resp['staff_not_present'];
                        var notes             = resp['notes'];
                        $('input[name=\'agenda_meeting_id\']').val(meeting_id);
                        $('input[name=\'e_title\']').val(title);
                        $('select[name=\'e_attended_user_ids[]\']').val(staff_present);
                        $('select[name=\'e_not_attended_user_ids[]\']').val(staff_not_present);
                        $('textarea[name=\'e_notes\']').val(notes);


                        // var options = "<option value=''></option>";
                        // <?php foreach($users as $user) { ?>

                        //     var user_id = "{{ $user['id'] }}";
                        //     var user_name = "{{ $user['name'] }}";
                        //     if($.inArray(user_id, staff_present) != -1){
                        //         var selected = 'selected';
                        //     } 

                        //     options += '<option value="'+user_id+'" '+selected+'>'+user_name+'</option>';
                        
                        // <?php } ?>
                        
                        // $('#records_list').html(options);

                        $(".select-absent-user").select2({
                              dropdownParent: $('#MeetingAgendaEdit'),
                              placeholder: "Select User"
                        });

                        $('#AgendaMeetingModal').modal('hide');
                        $('#MeetingAgendaEdit').modal('show');

                    } else {

                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.pop-notifbox').removeClass('active');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });*/
</script>

<script>    

    $('.sbt_edit_meeting_btn').click(function(){
        $('#edit-grp-frm-class').removeClass('form-group').addClass('div_space');
    });

    //edit agenda record
    $(function(){    
        $("#edit_agenda_meeting").validate({
            rules:{
                "e_title":{
                    required:true
                },
                "e_attended_user_ids[]": {
                    required:true
                },
                "e_not_attended_user_ids[]": {
                    required:true
                },
                "e_notes":{
                    required:true
                }
            },
            submitHandler:function(form) {

                $('.loader').show();
                $('body').addClass('body-overflow');

                $.ajax({
                    type: 'POST',
                    dataTYpe: 'json',
                    data: $('#edit_agenda_meeting').serialize(),
                    url: "{{ url('staff/meeting/edit') }}",
                    success: function(data){
                        if(isAuthenticated(data) == false) {
                            return false;
                        }
                        if(data == true) {
                            $('span.popup_success_txt').text(' Agenda edited successfully');
                            $('.popup_success').show();
                            setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                            if($('.logged-agenda-btn').hasClass('active')) {
                                $('.logged-agenda-btn').click();
                            } else {
                                update_search_meemting_record()
                            }


                            $('#MeetingAgendaEdit').modal('hide');
                            $('#AgendaMeetingModal').modal('show');
                        } else {
                            $('span.popup_error_txt').text('Error Occured');
                            $('.popup_error').show();
                            setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                        }

                        $('.loader').hide();
                        $('body').removeClass('body-overflow');
                    },
                    error: function() {
                      alert("Some error occured, Please try again after sometime.");
                    }
                });
                return false;
            }
        });
    })

    //when enter press on search box
    $('input[name=\'search_meeting_record\']').keydown(function(event) { 
        var keyCode = (event.keyCode ? event.keyCode : event.which);   
        if (keyCode == 13) {
            $('.sbt-e-meeting-btn').click();
            return false;
        }
    });

    //search meemting record
    $(document).on('click','.sbt-e-meeting-btn', function(){
        update_search_meemting_record()
        return false;
    });

    function update_search_meemting_record() {
        
        var search_input = $('input[name=\'search_meeting_record\']');
        var search = search_input.val();

        search = jQuery.trim(search);
        search = search.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');

        if(search == '') {
            search_input.addClass('red_border');
            return false;
        } else {
            search_input.removeClass('red_border');
        }

        var formdata = $('#searched-meeting-records-form').serialize();
       
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'post',
            url  : "{{ url('/staff/meetings') }}"+'?search='+search,
            data : formdata,
            success :function(resp) {
                 if(isAuthenticated(resp) == false){
                    return false;
                }
                if(resp == ''){
                    $('.searched-meeting-record').html('No Records found.');
                } else{
                    $('.searched-meeting-record').html(resp);
                }
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    }
</script>

