
<link rel="stylesheet" href="{{ url('public/frontEnd/css/file-uploader/css/jquery.fileupload.css') }}">
<link rel="stylesheet" href="{{ url('public/frontEnd/css/file-uploader/css/jquery.fileupload-ui.css') }}">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
    <link rel="stylesheet" href="{{ url('public/frontEnd/css/file-uploader/css/jquery.fileupload-noscript.css') }}">
</noscript>
<noscript>
    <link rel="stylesheet" href="{{ url('public/frontEnd/css/file-uploader/css/jquery.fileupload-ui-noscript.css') }}">
</noscript>

<!-- fancybox -->
<link rel="stylesheet" href="{{ url('public/frontEnd/css/fancy-box/jquery.fancybox.min.css') }}">
<script src="{{ url('public/frontEnd/css/fancy-box/jquery.fancybox.min.js') }}"></script>
<script src="{{ url('public/frontEnd/js/sweetalert.min.js') }}"></script>

<!--File Manager -->
<div class="modal fade" id="PoliProcModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Policies & Procedures </h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <!-- <button class="btn label-default active risk-add-btn show-upload" type="button"> Add New </button>
                        <button class="btn label-default risk-logged-btn logged-plans" type="button"> Logged Files </button>
                        <button class="btn label-default risk-search-btn" type="button"> Search </button> -->
                        <button class="btn label-default add-new-btn show-upload active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn logged-plans" type="button"> To Agree </button>
                        <button class="btn label-default logged-btn accept-plans" type="button"> Agreed </button>
                        <button class="btn label-default search-btn" type="button"> Search </button>
                    </div>

                    <!-- Add new Details -->
                    <div class="add-new-box risk-tabs">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Add New - Details </h3>
                        </div>

                        <!-- <a href="image.jpg" data-fancybox data-caption="My caption">
                            <img src="thumbnail.jpg" alt="" />click
                        </a> -->

                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')

                        <!-- 1st field -->
                        <!-- <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                                <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <input type="text" name="file_title" required class="form-control add_title" placeholder="title" />
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- 2nd field -->
                        <div class="col-md-12 col-sm-12 col-xs-12 hide-upload custom-margin">
                            <form id="fileupload1" action="" method="POST" enctype="multipart/form-data">
                      
                                <!-- The table listing the files available for upload/download -->
                                <div class="cus-height">
                                    <table role="presentation" class="table table-striped">
                                        <tbody class="files">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="CUSTOM-TEXT">
                                    <p>Click add files and navigation to the file location in the open file dialogue.</p>
                                </div>
                                <div class="row fileupload-buttonbar modal-footer m-t-0">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success add_files_btn">
                                            <i class="fa fa-plus"></i>
                                            <span>Add files...</span>
                                            <!-- <input type="file" name="files[]" multiple id="inputImageUpload" > -->
                                        </span>
                                        <input type="file" name="su_files[]" multiple id="inputImageUpload" style="display:none" >
                                        
                                        <button type="submit" class="btn btn-primary start submit_files_btn"> <!--   start -->
                                            <i class="fa fa-upload"></i>
                                            <span>Start upload</span>
                                        </button>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="reset" class="btn btn-warning cancel_full_upload">
                                            <!-- <i class="glyphicon glyphicon-ban-circle"></i> -->
                                            <i class="fa fa-ban"></i>
                                            <span>Cancel upload</span>

                                        </button>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    
                                </div>
                            </form>
                        </div> 
                    </div>

                    <!-- Logged Files -->
                    <div class="logged-box risk-tabs file-logged-box">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="m-t-0 m-b-20 clr-blue fnt-20 "> Policies files</h3>
                        </div>
                        <!--logged files list shown here!-->
                        <!-- alert messages -->
                        @include('frontEnd.common.popup_alert_messages')
                        <div class="col-md-12 col-sm-12 col-xs-12 logged-plans-list">     
                        <!-- Logged files shown using ajax -->
                        </div>
                    </div>
                   
                   <!-- Search Box -->
                    <div class="search-box risk-tabs">
                        <form method="post" action="" id="files_search_form">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Search </h3>
                            </div>

                            <!-- 1st field -->
                            <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                                    <label class="col-md-1 col-sm-1 col-xs-12 p-t-7"> Title: </label>
                                    <div class="col-md-11 col-sm-11 col-xs-12 r-p-0">
                                        <div class="input-group popovr  m-l-10">
                                            <input type="text" name="search_file_title" class="form-control" placeholder="Enter Title" maxlength="255"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="searched-logged-files cus-height" style="padding-left:34px">
                            <!-- Using Ajax -->
                            </div>

                            <div class="modal-footer m-t-0  recent-task-sec"> <!-- p-b-0 -->
                                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-warning file_details_submit search_files_btn" type="button"> Confirm </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>


<div class="modal fade" id="PolicyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close mdl-back-btn" href="#PoliProcModal" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title="Back"></i>
                </a>
                <h4 class="modal-title"> Update Policy File </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="add-new-box risk-tabs custm-tabs">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd service-user-list"> 
                    <form method="post" action="" id="update_policy_form" enctype="multipart/form-data">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">
                            <label class="col-md-4 col-sm-2 col-xs-12 p-t-7 text-right"> Choose File: </label>
                                <div class="col-md-6 col-sm-10 col-xs-12 p-t-7">
                                    <!-- <div class="select-bi" style="width:100%;float:left;"> -->
                                        <!-- <select class="select-field form-control" required id="records_list" style="width:100%;" name="category_id">
                                            <option value="">Select Category</option>
                                            <option value="SER_DEL_REC">Daily Record</option>
                                            <option value="SER_HEL_REC">Health Record</option>
                                            <option value="SER_EDU_REC">Education / Training</option>
                                            <option value="SER_LIV_SKIL">Living Skills</option>
                                        </select> -->
                                        <!-- <input type="file" name="file" value="" id="file_upload"> -->
                                    <!-- </div> -->
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-upload"></i> Upload</span>
                                        <input name="file" value="" id="file_upload" type="file">
                                    </span>
                                </div>
                        </div>          
                        <div class="form-group modal-footer m-t-0 modal-bttm">
                            <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <input type="hidden" name="policy_id" value="" id="policy_id">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-warning submit-su-log" type="submit"> Confirm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // start butoon i.e. upload all files
    $(document).ready(function(){
      
        var names = [];
        var file_index = 0;

        $(document).on('click','.submit_files_btn', function(){
            

            
            var formData = new FormData();
         
            var total_files = names.length;
            if(total_files == 0){ // if no image is available to upload in list then do not run ajax
                return false;
            }
            /* console.log(names);
             console.log(total_files);*/

            var no_image = 0;
            for(var i = 0; i < total_files; i++ ){
                
                //sending files from the names array
                formData.append('files['+i+']', names[i]);

                if(names[i] != '') { //checking if keys are not empty
                    no_image++;
                }
            }

            // if no image is available to upload in list then do not run ajax
            if(no_image == 0) {
                return false;
            }
            $('#PoliProcModal .progress-bar-success').css('width','100%');
            //formData.append('service_user_id', "{{ Auth::user()->id }}");
            $('#PoliProcModal .submit_files_btn').attr('disabled',true);

            $.ajax({
                url : "{{ url('/policies/add-multiple') }}",
                type : 'post',
                data:  formData,
                dataType : "json",
                processData : false,
                contentType : false,
                cache : false,
                success : function(resp) {
                    //console.log(resp);
                    //alert('get');
                    if(isAuthenticated(resp) == false) {
                        $('#PoliProcModal .progress-bar-success').css('width','0%');
                        return false;
                    }

                    $(resp).each(function(index) {
                        var data = $(this);
                        //console.log(data);
                        var response  = data[0].response;
                        var save_id   = data[0].save_id;
                        var file_index_value = data[0].file_index;
                        var file_name = data[0].file_name;
                        var row = $("tr[file_index='"+file_index_value+"']");

                        if(response == true){    
                            
                            row.attr('save_id',save_id);
                            row.find('p.name').text(file_name);
                            row.find('.file_actions').html('<button class="btn btn-danger delete delete_file_btn" > <i class="fa fa-trash"></i> <span>Delete</span> </button>');
                            row.find('.progress-striped').remove();
                            names[file_index_value] = ''; //remove this image from image names array
                            //$('#inputImageUpload').val('');
                            //names = [];

                        } else{ 
                            row.find('.error').text("{{ COMMON_ERROR }}");
                            row.find('.progress-bar-success').css('width','0%');
                        } 
                    });

                    $('#PoliProcModal .submit_files_btn').attr('disabled',false);

                }
            });
        return false;
        });

        // cancel and remove all the files which was in upload list. 
        $(document).on('click','.cancel_full_upload', function(){
            names = [];
            file_index = 0;
            $('.files').html('');
            return false;
        });

        // click on add file button > open select files
        $('.add_files_btn').click(function(){
            $("#inputImageUpload").click();
        });

        // when new files are selected on clicking on add files button
        $("#inputImageUpload").change(function(){
            
            var input = $(this)[0];
            var files = $(input.files);
            var invalid     = 0;

            files.each(function(index){
                
                var inp         = $(this);
                var filename    = inp.prop('name');
                var filename_arr= filename.split('.');
                var ext         = filename_arr.pop();
                ext             = ext.toLowerCase();
                
                if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'pdf' || ext == 'doc' || ext == 'docx' || ext == 'wps') {

                    var filesize = inp.prop('size'); //bytes
                    var unit = 'B';
                    
                    if(filesize > 1048576){
                        filesize = filesize/1048576;
                        filesize = filesize.toFixed(2);
                        unit = 'MB';                    
                    } else if(filesize > 1024){
                        filesize = filesize/1024;
                        filesize = filesize.toFixed(2);
                        unit = 'KB';
                    } 
                    names.push(input.files[index]);

                    var reader = new FileReader();
                    reader.onload = function (e) 
                    {      

                        if(ext == 'jpg' || ext == 'jpeg' || ext == 'png') {

                            var preview = '<span class="preview"><image width="80" height="60" src="'+e.target.result+'" alt="No preview" /></span>';
                            var td_class = '';

                        } else if(ext == 'pdf') {
                            var preview = '<span class="preview" style="font-size:55px"><i class="fa fa-file-pdf-o"></i></span>';
                            var td_class = 'padding-top:0px';

                        } else if(ext == 'doc' || ext == 'docx'  || ext == 'wps' ) {
                            var preview = '<span class="preview" style="font-size:55px"><i class="fa fa-file-word-o"></i></span>';
                            var td_class = 'padding-top:0px';
                            
                        } else{
                            var preview = '<span class="preview"><image width="80" height="60" src="'+e.target.result+'" alt="No preview2" /></span>';
                            var td_class = 'padding-top:0px';
                        }

                      $('.files').append('<tr class="template-upload fade in" file_index="'+file_index+'" save_id="" > <td style="'+td_class+'"> '+ preview +' </td> <td > <p class="name">'+filename+'</p> <strong class="error text-danger"></strong> </td> <td> <p class="size">'+filesize + unit +'</p> <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div> </td> <td  class="file_actions"> <button class="btn btn-primary start_btn"> <i class="fa fa-upload"></i> <span>Start</span> </button> <button class="btn btn-warning cancel_btn"> <i class="fa fa-ban"></i> <span>Cancel</span> </button> </td> </tr>');
                      file_index++;
                   };
                   reader.readAsDataURL(input.files[index]); 
                } else{ 
                    invalid = 1;
                }
            });
        
            if(invalid == 1){ //if any of the selected file was not of following formats then show this message.
                alert('Only .jpg,jpeg,png,pdf,doc,docx,wps formats are allowed.')
            }
        });        
        
        //SINGLE FILE UPLOAD
        
        // upload single file
        $(document).on('click','.start_btn', function(){

            var file_category_id = $('select[name=\'file_category\']').val();
            if(file_category_id == ''){
                $('select[name=\'file_category\']').parent().addClass('red_border');
                return false;
            } else{
                $('select[name=\'file_category\']').parent().removeClass('red_border');                
            }

            var row = $(this).closest('tr');
            var file_name = row.find('p.name').text();
            var file_index_value = row.attr('file_index');
            
            var formData = new FormData();
            formData.append('file', names[file_index_value]);
            formData.append('file_category_id', file_category_id);
            formData.append('user_id', "{{Auth::user()->id}}");
            row.find('.progress-bar-success').css('width','100%');

            $.ajax({
                url : "{{ url('/policies/add-single') }}",
                type : 'post',
                data:  formData,
                dataType : "json",
                processData : false,
                contentType : false,
                cache : false,
                success : function(resp) {

                    if(isAuthenticated(resp) == false){
                        row.find('.progress-bar-success').css('width','0%');
                        return false;
                    }

                    var response = resp['response'];
                    var save_id  = resp['save_id'];
                    var file_name  = resp['file_name'];

                    if(response == true){ 
                        
                        row.find('.progress-striped').remove();
                        row.attr('save_id',save_id);
                        row.find('p.name').text(file_name);

                        names[file_index_value] = ''; //remove this image from image names array
                                                
                        row.find('.file_actions').html('<button class="btn btn-danger delete delete_file_btn" > <i class="fa fa-trash"></i> <span>Delete</span> </button>');
                     
                    } else{ 
                        row.find('.progress-bar-success').css('width','0%');
                        alert('{{ COMMON_ERROR }}');
                    }
                }
            });
        return false;
        });

        //cancel file which is in the upload list and is not uploaded yet
        $(document).on('click','.cancel_btn', function(){
            
            var row = $(this).closest('tr');
            var file_name = row.find('p.name').text();
            file_index_value = row.attr('file_index');
            //names.pick_and_remove(file_index_value);

            names[file_index_value] = '';
            //console.log(names[file_index_value]);           
            row.fadeOut();           
            return false;
        });
            

        // delete uploaded files (delete file from db and remove it from upload list)           
        $(document).on('click','.delete_file_btn', function(){ //alert(2);
            var row = $(this).closest('tr');
            var save_id = row.attr('save_id');
            var file_index = row.attr('file_index');
            
            if(!confirm('{{ DEL_CONFIRM }}')){
                return false;
            }

            $.ajax({
                url : "{{ url('/policies/delete') }}"+'/'+save_id,
                type : 'get',
                success:function(resp){ 
                    if(isAuthenticated(resp) == false){
                        return false;
                    }

                    if(resp == 'true'){
                        row.fadeOut(); 
                        $('.active_record').closest('.delete-file').remove();

                        //show success delete message
                        $('span.popup_success_txt').text('Policy Deleted Successfully');                   
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                    } else{
                        $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);

                        //alert('Some error occured. Please try again after some time.');
                    }
                }
            });
            return false;
        });
    });
</script>

<script>
    //in logged btn click get data
    $(document).ready(function(){
        $(document).on('click','.logged-plans', function(){

            $('.loader').show();
            $('body').addClass('body-overflow');

            $('.hide-upload').hide();
            // $('.logged-plans-confirm-btn').hide();
            //var user_id = "{{ Auth::user()->id }}";
            $.ajax({
                type : 'get',
                //url  : "{{ url('/policies') }}"+'?logged=logged',
                url  : "{{ url('/policies') }}"+'?not-accepted',
                success : function(resp){  
                    // alert(resp); return false;
                    if(isAuthenticated(resp) == false){
                        return false;
                    } 
                    if(resp == ''){
                        $('.logged-plans-list').html("<p style='text-align:center'>No Files found.</p>");
                    } else{
                        $('.logged-plans-list').html(resp);
                    }

                    $("[data-fancybox]").fancybox({
                        // Options will go here
                    });

                    // $('input[name=\'search\']').val('');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });

        $(document).on('click','.accept-plans', function(){

            $('.loader').show();
            $('body').addClass('body-overflow');

            $('.hide-upload').hide();
            // $('.logged-plans-confirm-btn').hide();
            //var user_id = "{{ Auth::user()->id }}";
            $.ajax({
                type : 'get',
                url  : "{{ url('/policies') }}"+'?accepted',
                success : function(resp){  
                    // alert(resp); return false;
                    if(isAuthenticated(resp) == false){
                        return false;
                    } 
                    if(resp == ''){
                        $('.logged-plans-list').html("<p style='text-align:center'>No Files found.</p>");
                    } else{
                        $('.logged-plans-list').html(resp);
                    }

                    $("[data-fancybox]").fancybox({
                        // Options will go here
                    });

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });

        return false;
    });
</script>

<script>
    //click search btn
    $(document).ready(function(){

        $('input[name=\'search_file_title\']').keydown(function(event) { 
            var keyCode = (event.keyCode ? event.keyCode : event.which);   
            if (keyCode == 13) {
                $('.search_files_btn').click();
                return false;
                //$('.search_files_btn').click();        
            }
        });
        
        $(document).on('click','.search_files_btn', function(){

            // alert(1); return false;
            var search = $('input[name=\'search_file_title\']').val();
            // var search_file_category = $('select[name=\'search_file_category\']').val();
            search = jQuery.trim(search);

            if(search == ''){
                $('input[name=\'search_file_title\']').addClass('red_border');
                return false;
            } else{
                $('input[name=\'search_file_title\']').removeClass('red_border');
            }

            // July28
            /*if(search == '' || search == '0'){
                $('input[name=\'search_file_title\']').addClass('red_border');
                return false;
            } else{
                $('input[name=\'search_file_title\']').removeClass('red_border');
            }

            if(search_file_category == ''){
                $('input[name=\'search_file_category\']').parent().addClass('red_border');
                return false;
            } else{
                $('input[name=\'search_file_category\']').parent().removeClass('red_border');
            }*/
         
            $('.loader').show();
            $('body').addClass('body-overflow');
            
            $.ajax({
                type : 'get',
                url  : "{{ url('/policies') }}"+'?search='+search,
                success : function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    //alert(resp);
                    if(resp == ''){
                        $('.searched-logged-files').html("<p style='text-align:center'>No Files found.</p>");
                    } else{
                        $('.searched-logged-files').html(resp);
                    }
                    $('input[name=\'search\']').val('');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        return false;
        });
    });
</script>

<script>
    //delete a row
    $(document).ready(function(){
    
        $(document).on('click','.delete-logged-file', function(){
            //alert('d');
            var logged_file_id = $(this).attr('logged_file_id');
            
            $(this).addClass('active_record');
    
            $('.loader').show();
            $('body').addClass('body-overflow');
            $.ajax({
                type : 'get',
                url  : "{{ url('/policies/delete') }}"+'/'+logged_file_id,
                //data : { 'logged_file_id' : logged_file_id, '_token' : file_token },
                success : function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    // alert(resp); return false;

                    if(resp == 'true') {
                        $('.active_record').closest('.delete-file').remove();
                        //show success delete message
                        $('span.popup_success_txt').text('File Deleted Successfully');                   
                        $('.popup_success').show();
                        setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
                    } else{

                        //show delete message error
                        $('span.popup_error_txt').text('Error Occured');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;
        });

        $('.show-upload').click(function(){
            $('.hide-upload').show();
        });
    });
</script>

<!-- <script>
    //pagination of file manager
    $(document).on('click','.file_mngr_paginate .pagination li',function(){
        var new_url = $(this).children('a').attr('href');
        if(new_url == undefined){
            return false;
        }
        
        // $('.loader').show();
        // $('body').addClass('body-overflow');

        $.ajax({
            type : 'get',
            url  : new_url,
            success:function(resp){
                $('.logged-plans-list').html(resp);
                //$('#healthmodal').modal('show');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });
</script> -->
<script>
    //pagination of bmp
    $(document).ready(function(){
        //$(document).on('click','.bmp_paginate .pagination li', function(){
        $(document).on('click','#PoliProcModal .pagination li', function(){
    
            var page_no = $(this).children('a').text();
            if(page_no == '') {
                return false;
            }
            if(isNaN(page_no)) {
                var new_url = $(this).children('a').attr('href');
                page_no = new_url[new_url.length -1];
            }

            //determine is this is a accepted/not accepted
            //$('#PoliProcModal .logged-btn').
            //$('#PoliProcModal .logged-plans').

                if($('#PoliProcModal .logged-plans').hasClass('active')) {
                    var tab_name = 'not-accepted';                    
                
                } else if($('#PoliProcModal .accept-plans').hasClass('active')) {
                    var tab_name = 'accepted';                    

                } /*else {
                    $('.search_files_btn').click();
                }*/

            // $('.loader').show();
            // $('body').addClass('body-overflow');
            // logged-plans-list
            $.ajax({
                type : 'get',
                url  : "{{ url('/policies') }}"+"?"+tab_name+"&page="+page_no,
                success : function(resp) {
                    if(isAuthenticated(resp) == false) {
                        return false;
                    }
                    $('.logged-plans-list').html(resp);

                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
            return false;

        });
    });
</script>

<script>
    $(document).on("click",".accept_policy", function(){
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        var id = $(this).attr('file_id');
        
         swal({
          title: "Are you sure?",
          text: "You have read and understood the policy and documentation!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            $.ajax({
            url:"{{url('policy/accept')}}"+"/"+id,
            type:"GET",
            success: function(resp){
                
                if(isAuthenticated(resp) == false){
                   return false;
                }
                if($('#PoliProcModal .logged-plans').hasClass('active')) {
                    $('.logged-plans').click();
                } else if($('#PoliProcModal .accept-plans').hasClass('active')) {
                    $('.accept-plans').click();
                } else {
                    $('.search_files_btn').click();
                }

                $('.loader').hide();
                $('body').removeClass('body-overflow');

                $('span.popup_success_txt').text('Policy accepted Successfully');                   
                $('.popup_success').show();
                setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
            },
            error: function(){
                $('.loader').hide();
                $('body').removeClass('body-overflow');

                //show delete message error
                $('span.popup_error_txt').text("{{ COMMON_ERROR }}");
                $('.popup_error').show();
                setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
            }
        });
        return false;
                
            }else{
                $('.loader').hide();
                return false;
            }
        });
       });

</script>

<script>
    $(document).on("click",".del_policy", function(){
        var row = $(this).closest('.delete-file');

        if(!confirm('{{ DEL_CONFIRM }}')){
            return false;
        }

        $('.loader').show(); 
        $('body').addClass('body-overflow');

        var id = $(this).attr('file_id');
        $.ajax({
            url:"{{url('policy/delete')}}"+"/"+id,
            type:"GET",
            success: function(resp){

                if(isAuthenticated(resp) == false){
                   return false;
                }

                //$('.logged-plans').click();
                row.fadeOut(); 
                $('.loader').hide();
                $('body').removeClass('body-overflow');

                $('span.popup_success_txt').text('Policy deleted Successfully');                   
                $('.popup_success').show();
                setTimeout(function(){$(".popup_success").fadeOut()}, 5000);
            },
            error: function(){
                $('.loader').hide();
                $('body').removeClass('body-overflow');

                //show delete message error
                $('span.popup_error_txt').text('{{ COMMON_ERROR }}');
                $('.popup_error').show();
                setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
            }
        });
        return false;
    });
</script>

<script>
    $(document).ready(function(){
        $(document).on('click','.edit_policy', function() {
            // alert('1'); return false;
            var policy_id = $(this).attr('policy_id');
            $('#file_upload').val('');
            $('#policy_id').val(policy_id);
            $('#PoliProcModal').modal('hide');
            $('#PolicyUpdateModal').modal('show');
            
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(function(){    
            $("#update_policy_form").validate({
                rules:{
                    "file":{
                        required:true
                    }
                },
                submitHandler:function(form) {

                    $('.loader').show();
                    $('body').addClass('body-overflow');
                    // $('#file_upload').val();
                    // var file = $('#update_policy_form').serialize()
                    var da = new FormData($("#update_policy_form")[0]);
                    // alert(da); //return false;
                    $.ajax({
                        type: 'POST',
                        //dataType: 'json',
                        // data: $('#update_policy_form').serialize(),
                        url: "{{ url('policy/update') }}",
                        data:  da,
                        // type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(isAuthenticated(data) == false) {
                                return false;
                            }
                           
                            if(data == '1') {
                           
                                $('span.popup_success_txt').text('Policy Updated Successfully.');
                                $('.popup_success').show();
                                setTimeout(function(){$(".popup_success").fadeOut()}, 5000);

                                $('#PolicyUpdateModal').modal('hide');
                                $('#PoliProcModal').modal('show');

                                if($('#PoliProcModal .logged-plans').hasClass('active')) {
                                    $('.logged-plans').click();
                                } else if($('#PoliProcModal .accept-plans').hasClass('active')) {
                                    $('.accept-plans').click();
                                } else {
                                    $('.search_files_btn').click();
                                }

                            }  else if(data == '2'){
                                $('span.popup_error_txt').text('Error Occured');
                                $('.popup_error').show();
                                setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                           }

                            $('.loader').hide();
                            $('body').removeClass('body-overflow');
                        },
                        error: function(){
                            alert("{{ COMMON_ERROR }}");
                        }
                    });
                    return false;
                }
            });
        })
    });
</script>

<script>
    $(document).ready(function() {

        $("#file_upload").change(function(){ 
            
            var img_name = $(this).val();
            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
                if(ext =="jpg" || ext =="jpeg" || ext =="png" || ext =="pdf" || ext =="doc" || ext =="docx" || ext =="wps")
                {
                    input=document.getElementById('file_upload');
                    /*if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#img_upload").removeAttr("src");
                      alert("file size should be at least 10KB and upto 2MB");
                      return false;
                    }
                    else
                    {*/
                      // readURL(this);
                    //}   
                }
               else
                {
                    $(this).val('');
                    alert('Only .jpg,jpeg,png,pdf,doc,docx,wps formats are allowed.');
                }
            }
            return true;
        }); 
    });
</script>

ss