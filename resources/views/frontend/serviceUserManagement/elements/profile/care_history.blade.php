<head>
      <link href="{{ url('public/backEnd/js/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
    .file-name-main
    {
        float: left;
        width: 100%;
    }
    .file-name-main a
    {
        display: inline-block;
    }
    .file-name-a
    {
        width: 290px;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
    }
    .file-arrow
    {
        color: red;
    }
</style>

<!-- 2nd Tab - listing of care history -->
<div id="job-history" class="tab-pane" >
    <div class="row">
        <div class="col-md-12">
            <div class="timeline-messages">
                <h3>Care history timeline<a href="#" class="btn btn-white clr-them-green plus-ryt" data-toggle="modal" data-target="#care_history_"> <i class="fa fa-plus plus-icn"></i></a>  </h3>
             <div id="care_val">
                <?php $i=1; foreach($care_history as $care) {

                    $su_h_file = App\Models\ServiceUserCareHistoryFile::su_history_files($care->id);
                    // echo "<pre>"; print_r($su_h_file); die;
                ?>
                <div class="msg-time-chat">
                    <div class="message-body msg-in">
                        <span class="arrow"></span>
                        <div class="text">
                            <div class="first">
                                {{ date('d M Y', strtotime($care->date)) }}
                            </div>
                            <div class="second bg-timeline-{{ $i }}">{{ $care->title }}</div>
                            <span class="edit-icn"> 
                                <a href="" class="care_history_edit_btn" care_history_id="{{ $care->id }}" care_history_date="{{ date('d-m-Y', strtotime($care->date)) }}" care_history_desc="{{ $care->description }}" care_history_file="{{ $su_h_file }}"><i class="fa fa-pencil profile"></i></a>
                            </span>
                            
                        </div>
                    </div>
                </div>
                <?php 
                // ($i > 5) ? $i = 1 : $i++;   
                if ($i > 5) {
                    $i = 1;
                    break;
                } else {
                    $i++;
                } 
                } ?>
                </div>
               
            </div>
        </div>
    </div>
</div>

<!--Add Care history popup -->
<div class="modal fade" id="care_history_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Care History</h4>
            </div>
            <div class="modal-body">
                <div class="row">         
            <form id='add_care_history' enctype="multipart/form-data">
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Title :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="text" class="form-control" name="title" maxlength="255" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2nd field -->
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">                            
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                            <!-- data-date-viewmode="years" -->
                                <div  data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears" onclick="get_show_cal()"> 
                                    <input name="date" type="text" readonly value="" size="16" class="form-control" maxlength="10">
                                    <span class="input-group-btn add-on">
                                        <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">                            
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Details: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <textarea class="form-control" name="description" maxlength="1000" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> File :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="file" id="care_history_file" name="files[]" val="" multiple="multiple">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-bttm m-t-0">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning" type="button" onclick="get_add_care_val()"> Submit </button>
                    </div>
                </div>
            </form>
            </div>           
        </div>
    </div>
</div>

<!--Edit Care history popup -->
<div class="modal fade" id="edit_care_history_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a href="" style="font-size:18px; padding-right:8px;" class="close del-care-hist-btn" edit-care-history-id=""><i class="fa fa-trash" title="Delete"></i></a>

                <h4 class="modal-title">Edit Care History</h4>
            </div>
            <div class="modal-body">
                <div class="row">         
            <form id="edit_care_history" enctype="multipart/form-data">
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Title :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <input type="text" class="form-control edit-care-history-title" name="title" value="" maxlength="255" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2nd field -->
                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">                            
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Date: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <!-- data-date-viewmode="years" -->
                                <div data-date-format="dd-mm-yyyy" data-date=""  class="input-group date dpYears"> 
                                    <input name="date" type="text" readonly="" class="form-control edit-care-history-date" value="" maxlength="10" />
                                    <span class="input-group-btn add-on">
                                        <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel datepicker-sttng">                            
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> Details: </label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">
                                    <textarea class="form-control edit-care-history-desc" name="description" maxlength="1000" rows="5" id="care_hist_inf"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0">
                            <label class="col-md-2 col-sm-1 col-xs-12 p-t-7"> File :</label>
                            <div class="col-md-9 col-sm-11 col-xs-12 r-p-0">
                                <div class="input-group popovr">

                                    <div class="file_data">
                                       
                                    </div>
                                   <!--  <input type="file" id="care_history_file" name="files[]" val="" multiple="multiple"> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer modal-bttm m-t-0">
                        <input type="hidden" name="care_history_id" value="" class="edit-care-history-id">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                        <button class="btn btn-warning" type="button" onclick="get_care_history()"> Submit </button>
                    </div>
                </div>
            </form>
            </div>           
        </div>
    </div>
 </div>

<script>
// while edit time data fetch
    $(document).ready(function(){
        $('.care_history_edit_btn').click(function(){

            var care_history_id   = $(this).attr('care_history_id');
            var care_history_date = $(this).attr('care_history_date');
            var care_history_desc = $(this).attr('care_history_desc');
            var title             = $(this).closest('.text').find('.second').text();
            var su_his_file       = $(this).attr('care_history_file');
            // alert(su_his_file);
            var obj = JSON.parse(su_his_file);
            var len = obj.length;
            // alert(len);
            var file_name = 0;
            var html = '';
            var url  = "{{ suCareHistoryFilePath }}"+'/';
            var del_url = "{{ url('/service/care-history/delete-file/') }}"
            for(var i = 0; i < len; i++) {
                file_name = obj[i].file;
                console.log(file_name);
                //href="`+url+file_name+`"
                var file_id   = obj[i].id;

                html += `<div class="file-name-main">
                                <a href="`+url+file_name+`" class="file-name-a wrinkled" data-fancybox data-caption="`+file_name+`">`+file_name+`</a> 
                                <a href="`+del_url+`/`+file_id+`" class="file-arrow" file_id="`+file_id+`">
                                    <span><i class="fa fa-times fa-fw"></i></span>
                                </a>
                            </div>
                        </div>`;
                //file_name++;
                // alert(file_name);
                //var file_id   = obj[i].id;
                //console.log(file_id);
                // alert(file_id);
            }
            $('.file_data').html(html);

            $('.edit-care-history-id').val(care_history_id);
            $('.edit-care-history-title').val(title);
            $('.edit-care-history-date').val(care_history_date);
            $('.edit-care-history-desc').val(care_history_desc);
            $('.del-care-hist-btn').attr('edit-care-history-id',care_history_id);
            $('#edit_care_history_').modal('show');

            setTimeout(function () {
                var elmnt = document.getElementById("care_hist_inf");
                var scroll_height = elmnt.scrollHeight;
                console.log(scroll_height);
                $('#care_hist_inf').height(scroll_height);
            },200);
            return false;
        });
    });
</script>

<script>
//deleting care history
    $(document).ready(function(){
        $('.del-care-hist-btn').click(function(){

            if(confirm('Do you want to delete this care history?')){
                var care_history_id = $(this).attr('edit-care-history-id');   
                window.location = "{{ url('/service/care_history/delete') }}"+'/'+care_history_id;
            }else{
                return false;
            }
        });
    });
   
    /*$(document).ready(function(){
        $('.del-care-hist-btn').click(function(){

            var care_history_id = $(this).attr('edit-care-history-id');
            var history_token = $('input[name=\'_token\']').val();

            $.ajax({
                type: 'post',  
                url : "{{ url('/service/care_history/delete') }}"+'/'+care_history_id,
                data: {'care_history_id': care_history_id, '_token': history_token},
                success : function(resp){
                        $('#edit_care_history_').modal('hide');
                        alert(resp);
                        location.reload();
                        //show success delete message
                        // $('span.popup_success_txt').text('Care History Deleted Successfully');                   
                        // $('.popup_success').show();
                        // setTimeout(function(){$(".popup_success").fadeOut()}, 5000);   
                }
            });
           return false;
        });
    });*/
</script>

<script>
    //Add care history validations
    $(function() {
        $("#add_care_history").validate({
            rules: {
                
                title: {
                    required: true,  
                    regex: /^[a-zA-Z0-9'"-=+,.&# \n]{1,200}$/
                },
                date: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "This field is required.",  
                    regex: "Special charecters are not allowed."          
                },
                date: {
                    required: "This field is required.",
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>


<script>
    //Edit care history validations
    $(function() {
        $("#edit_care_history").validate({
            rules: {
                
                title: {
                    required: true,  
                    regex: /^[a-zA-Z0-9'"-=+,.&# \n]{1,200}$/
                },
                date: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "This field is required.",  
                    regex: "Special charaters are not allowed."
                },
                date: {
                    required: true
                }
            },
            submitHandler: function(form) {
              form.submit();
            }
        })
        return false;   
    });
</script>

<script>
    //cancel btn in add care history
    $(document).ready(function(){  
        $(document).on('click','.cancel-btn',function(){
            $('#add_care_history').find('input').val('');
            $('label.error').hide();
            var token = "{{ csrf_token() }}";
            $('input[name=\'_token\']').val(token);
        });
    });
</script>


<script>
    $(document).ready(function() {

      function readURL(input) 
        {
            if (input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function (e) 
                    {
                        //$('#old_image').attr('src', e.target.result).width(150).height(170);
                        $('#old_image').attr('src', e.target.result);
                    };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#care_history_file").change(function(){ 
            
            var img_name = $(this).val();
            if(img_name != "" && img_name!=null)
            {
                var img_arr=img_name.split('.');
                var ext = img_arr.pop();
                ext     = ext.toLowerCase();
                if(ext =="jpg" || ext =="jpeg" || ext =="png" || ext =="pdf" || ext =="doc" || ext =="docx" || ext =="wps")
                {
                    input=document.getElementById('care_history_file');
                    /*if(input.files[0].size > 2097152 || input.files[0].size <  10240)
                    {
                      $(this).val('');
                      $("#img_upload").removeAttr("src");
                      alert("file size should be at least 10KB and upto 2MB");
                      return false;
                    }
                    else
                    {*/
                      readURL(this);
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
<script>
    function get_care_history()
    {
        var token='<?php echo csrf_token();?>'
    $.ajax({  

      type:"POST",
      url:"{{url('/service/care_history/edit')}}",
      data:new FormData( $("#edit_care_history")[0]),
      async : false,
      contentType : false,
      cache : false,
      processData: false,
      success:function(data)
      {
        console.log(data);
        $('#edit_care_history_').modal('hide');
        if($.trim(data)=="done")
        {
            $(window).scrollTop(0);
           $('.ajax-alert-suc') .show();
           $('.msg').text("Care History updated successfully.");
           $(".ajax-alert-suc").fadeOut(5000);
           location.reload();
        }
        if($.trim(data)=="unauth")
        {
            $('.ajax-alert-err') .show();
            $('.msg').text("<?php echo COMMON_ERROR;?>");
            $(".ajax-alert-err").fadeOut(5000);
        }
        else if($.trim(data)=="error"){
            $('.ajax-alert-err') .show();
            $('.msg').text("Care History could not be updated.");
            $(".ajax-alert-err").fadeOut(5000);
        }
        else
        {
            $('#care_val').html(data);
            $(window).scrollTop(0);
            $('.ajax-alert-suc') .show();
            $('.msg').text("Care History updated successfully.");
            $(".ajax-alert-suc").fadeOut(5000);
        }
        
      }  
      
    });
    }
</script>
<script>
    function get_care_history_btn_val(id_val)
    {
        // alert()
        // return false;
        var care_history_id   = $('#care_history_id_'+id_val).val();
        var care_history_date = $('#care_history_date_'+id_val).val();
        var care_history_desc = $('#care_history_desc_'+id_val).val();
        var title             = $('#title_'+id_val).val();
        var su_his_file       = $('#care_history_file_'+id_val).val();
        // alert(su_his_file);
        // return false;
        var obj = JSON.parse(su_his_file);
        var len = obj.length;
        // alert(len);
        var file_name = 0;
        var html = '';
        var url  = "{{ suCareHistoryFilePath }}"+'/';
        var del_url = "{{ url('/service/care-history/delete-file/') }}"
        for(var i = 0; i < len; i++) {
            file_name = obj[i].file;
            console.log(file_name);
            //href="`+url+file_name+`"
            var file_id   = obj[i].id;

            html += `<div class="file-name-main">
                            <a href="`+url+file_name+`" class="file-name-a wrinkled" data-fancybox data-caption="`+file_name+`">`+file_name+`</a> 
                            <a href="`+del_url+`/`+file_id+`" class="file-arrow" file_id="`+file_id+`">
                                <span><i class="fa fa-times fa-fw"></i></span>
                            </a>
                        </div>
                    </div>`;
            //file_name++;
            // alert(file_name);
            //var file_id   = obj[i].id;
            //console.log(file_id);
            // alert(file_id);
        }
        $('.file_data').html(html);

        $('.edit-care-history-id').val(care_history_id);
        $('.edit-care-history-title').val(title);
        $('.edit-care-history-date').val(care_history_date);
        $('.edit-care-history-desc').val(care_history_desc);
        $('.del-care-hist-btn').attr('edit-care-history-id',care_history_id);
        $('#edit_care_history_').modal('show');

        setTimeout(function () {
            var elmnt = document.getElementById("care_hist_inf");
            var scroll_height = elmnt.scrollHeight;
            // console.log(scroll_height);
            $('#care_hist_inf').height(scroll_height);
        },200);
        return false;

    }
</script>

<script>
   function get_add_care_val()
   {
    var token='<?php echo csrf_token();?>'
    $.ajax({  

      type:"POST",
      url:"{{url('/service/care_history/add/')}}/<?php echo $service_user_id;?>",
      data:new FormData( $("#add_care_history")[0]),
      async : false,
      contentType : false,
      cache : false,
      processData: false,
      success:function(data)
      {
        console.log(data);
        $('#care_history_').modal('hide');
        
        if($.trim(data)=="unauth")
        {
            $('.ajax-alert-err') .show();
            $('.msg').text("<?php echo COMMON_ERROR;?>");
            $(".ajax-alert-err").fadeOut(5000);
        }
        else{
            $('#care_val').html(data);
            $(window).scrollTop(0);
            $('.ajax-alert-suc') .show();
            $('.msg').text("Care History added successfully.");
            $(".ajax-alert-suc").fadeOut(5000);

        }
        
      }  
      
    });
   }
</script>
<!-- <<<<<<< HEAD -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script type="text/javascript">
   function get_show_cal()
   {
    // cons("fgfgfg")
    $('.datepicker-days').show();
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 -->