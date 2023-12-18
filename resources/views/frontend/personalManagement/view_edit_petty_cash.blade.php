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

                <form method="post" id='edit-petty-cash-form' action="{{ url('/profile/petty-cash/edit') }}" enctype="multipart/form-data" >
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
            var petty_rep_id = $(this).attr('petty_rep_id');

           // alert(expnse_rep_id);
            $('.loader').show();
            $.ajax({
                type :  'get',
                url  :  "{{ url('/profile/petty-cash/view') }}"+'/'+petty_rep_id,
                
                success: function(resp) {
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                     $('.loader').hide();
                    if(resp != '') {

                        $('.view-expnse-form').html(resp);
                        $('#addPettyCashModal').modal('hide');
                        $('.modal-name').text('View Petty Cash Detail');
                        $('#vePettyCashModal').modal('show');
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
            $('#addPettyCashModal').modal('show');
            $('.logged-btn').click();

        });
        //for cancel button on view petty details
        $(document).on('click', '#petty_cancel', function(){

            $('#vePettyCashModal').modal('hide');
            $('#addPettyCashModal').modal('show');
            $('.logged-btn').click();

        });
    });
</script>