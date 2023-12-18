<!-- View or Edit Petty Cash Modal -->
<div class="modal fade" id="vePettyCashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <a class="close expense-logged-arrow mdl-back-btn" href="" data-toggle="modal" data-dismiss="modal" data-target="">
                    <i class="fa fa-arrow-left" title=""></i>
                </a>
                <h4 class="modal-title modal-name">  </h4>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <!-- <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">
                        <button class="btn label-default add-new-btn active" type="button"> Add New </button>
                        <button class="btn label-default logged-btn active logged-expense-btn" type="button"> Logged </button>
                        <button class="btn label-default search-btn active" type="button"> Search </button>
                    </div> -->

                    @include('frontEnd.common.popup_alert_messages')

                <form method="post" id='edit-petty-cash-form' action="{{ url('/general/petty-cash/edit') }}" enctype="multipart/form-data" >
                    <div class="view-expnse-form">
                        <!-- Ajax used to view the petty cash record -->
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div>

<!-- View Expenditure Report -->
<script>
    $(document).ready(function(){

        $(document).on('click','.view-expnse-rep', function(){
            
            var expnse_rep_id = $(this).attr('expnse_rep_id');

            $.ajax({
                type :  'get',
                url  :  "{{ url('/general/petty-cash/view') }}"+'/'+expnse_rep_id,
                
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp != '') {

                        $('.view-expnse-form').html(resp);
                        $('#pettyCashModal').modal('hide');
                        $('.modal-name').text('View Expense Report');
                        $('#vePettyCashModal').modal('show');
                        
                        setTimeout(function () {
                            autosize($("textarea"));
                        },200);
                        
                    } else {

                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                }
            });
        });

        $(document).on('click', '.expense-logged-arrow', function(){

            $('#vePettyCashModal').modal('hide');
            $('#pettyCashModal').modal('show');
            $('.logged-btn').click();

        });
    });
</script>

<script>

    $(document).on('change', "#edit_file_upload", function()
    { 
        var file_name = $(this).val();

        file_array = file_name.split('.');
        ext = file_array.pop();
        ext = ext.toLowerCase();
        if(ext == 'jpg' || ext =="jpeg" || ext =="gif" || ext =="png" || ext =="pdf"|| ext =="doc"|| ext =="docx"|| ext =="wps"){
            
            input = document.getElementById('edit_file_upload');
            
            if(input.files[0].size > 10240000 || input.files[0].size < 10240){

                $(this).val('');
                // $("#img_upload").removeAttr("src");
                alert("image size should be at least 10KB and upto 10MB");
                return false;
            }   
        }  else {

                $(this).val('');
                alert('Please select .jpg, .png, .gif, .pdf .wps or .doc file format type.');
        }
    }); 
</script>

<script>
    $(document).ready(function(){
        
        $(document).on('click','.edit-expnse-rep', function(){
            var expnse_rep_id = $(this).attr('expnse_rep_id');

            $.ajax({
                type :  'get',
                url  :  "{{ url('/general/petty-cash/view') }}"+'/'+expnse_rep_id,
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp != '' ) {

                        $('.view-expnse-form').html(resp);
                        $('#pettyCashModal').modal('hide');
                        $('.expnse-fields').attr('disabled', false);
                        $('.modal-name').text('Edit Expense Report'); 
                        $('#vePettyCashModal').modal('show');
                        
                        setTimeout(function () {
                            autosize($("textarea"));
                        },200);
                    } else  {
                        $('span.popup_error_txt').text('Some Error Occurred. Please try again later.');
                        $('.popup_error').show();
                        setTimeout(function(){$(".popup_error").fadeOut()}, 5000);
                    }
                }
            });
        });
    });
</script>

<script>
    $(function(){
        $('#edit-petty-cash-form').validate({

            rules: {
                expense_title : "required",
                expense_detail: "required",
                expense_amount : {
                    required : true,
                    regex : /^[0-9',sSdD$€£.\s]/
                },
                //receipt_file : "required",

            },
            messages: {
                expense_title : "This field is required", 
                expense_detail: "This field is required",
                expense_amount: {
                    required : "This Field is required",
                    regex : "Invalid Character",
                },
                //receipt_file : "Receipt required",

            },
            submitHandler:function(form) {
                form.submit();
            }
        })
        return false;
    });
</script>

<!-- <script>
    $(document).ready(function(){

        $(document).on('click','.daily-rcd-head', function(){
            $(this).next('.daily-rcd-content').slideToggle();
            $(this).find('i').toggleClass('fa-angle-down');
            $('.input-plusbox').hide();
        });
    });
</script> -->
<!-- <script>
    //when click on plus button then details of the record will be shown below the record
    $('.input-plusbox').hide();
    $(document).on('click','.input-plus',function(){
        $(this).closest('.cog-panel').find('.input-plusbox').toggle();
    });
</script>