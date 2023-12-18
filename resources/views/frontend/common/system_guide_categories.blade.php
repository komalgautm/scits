<!--Category Modal -->

<div class="modal fade" id="System_guide_categories" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

   <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <a id="vw-r-pln-bkc-btn" class="close mdl-back-btn back_button" href="" data-toggle="modal" data-dismiss="modal" aria-hidden="true">

                    <i class="fa fa-arrow-left" title=""></i>

                </a>

                

                <h4 class="modal-title" > System Guide </h4>

            </div>

            <div class="modal-body" >

                <div class="row">

                    <!-- <div class="below-divider"></div> -->

                    <div class="add-new-box risk-tabs custm-tabs">

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20 " id="categories_name">

                                    Category

                                 </h3>

                            </div>





                            <form id="frequently_askd_ques">

                                <div class="modal-space modal-pading category_vise_ques">

                                <!-- FAQ list be shown here using ajax -->

                                </div>

                            </form>

                            <div class="modal-footer m-t-0 p-b-0 recent-task-sec">

                                <button class="btn btn-default category_cancel" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>

                            </div>

                        </div>

                     </div>

                    <!-- alert messages -->

                    @include('frontEnd.common.popup_alert_messages')

                </div>

            </div>

        </div>

    </div>

</div>



<script>

    $(document).ready(function(){

         $(document).on('click','.category_click_modal',function(){

            //alert(1); //return false;

            $('.loader').show();

            $('body').addClass('body-overflow');

            var category_id = $(this).attr('category_id');



           $.ajax({

                type:"get",

                dataType:"json",

                url:"{{ url('/system-guide/faq/view') }}"+"/"+category_id,

                success: function(resp){



                    if(isAuthenticated(resp) == false) {

                        return false;

                    }



                    var category_name = resp['category_name']; 

                    var html          = resp['content'];

                    $('#categories_name').text(category_name);



                    if(html == ""){

                        $('.category_vise_ques').html('<div class="text-center p-b-20" style="width:100%">No Questions Found Related To This Category.</div>');

                    }  else{

                         $('.category_vise_ques').html(html);

                    }



                    $('#System_guide_categories').modal('show');

                    $('#System_guide').modal('hide');



                    $('.loader').hide();

                    $('body').removeClass('body-overflow');

                }

           });

        });

    });



    $(document).ready(function(){

        $('#System_guide_categories .back_button').click(function(){

            $('.loader').show();

            $('#System_guide_categories').modal('hide');

            $('.loader').hide();

            $('#System_guide').modal('show');

        });

    });

</script>