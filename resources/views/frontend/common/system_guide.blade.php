<!--systen guide Modal -->



<?php

    if(!empty($guide_tag)){

        //echo $guide_tag; 

    } else{

        $guide_tag = 'sys_mngmt';

        //echo $guide_tag; 

    }

?>

    <div class="modal fade" id="System_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title"> FAQ</h4>

                </div>



                <div class="modal-body" >

                    <div class="row">

                        <div class="form-group col-md-12 col-sm-12 col-xs-12 serch-btns text-right">

                            <button class="btn label-default add-new-btn active" type="button">  View </button>

                            <button class="btn label-default logged-btn active system_guide_categories" type="button"> Categories </button>

                            <button class="btn label-default search-btn active search_btn" type="button "> Search </button>

                        </div>

                        <!-- <div class="below-divider"></div> -->

                        <div class="add-new-box risk-tabs custm-tabs">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20" id="category_name">

                                    Category

                                 </h3>

                            </div>



                            <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">

                                <form id="frequently_askd_ques">

                                    <div class="modal-space modal-pading asked_ques">

                                    <!-- FAQ list be shown here using ajax -->

                                    </div>

                                </form>

                            </div>

                         </div>

                        <!-- alert messages -->

                            @include('frontEnd.common.popup_alert_messages')



                    <!--categories -->

                    <div class="logged-box risk-tabs custm-tabs">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20"> Categories </h3>

                            </div>

                        <!-- alert messages -->

                        @include('frontEnd.common.popup_alert_messages')

                        <form id="edit-daily-logged-form">

                            <div class="modal-space modal-pading logged-plan-shown categories-list">

                                <!-- category list be shown here using ajax -->

                            </div>

                        </form>

                    </div>



                    <div class="search-box risk-tabs custm-tabs">

                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <h3 class="m-t-0 m-b-20 clr-blue fnt-20">Search</h3>

                            </div>



                            <div class="col-md-12 col-sm-12 col-xs-12 p-0 srch-field">

                                <label class="col-md-2 col-sm-2 col-xs-12 p-t-7 cus-lbl"> Question: </label>

                                <div class="col-md-9 col-sm-9 col-xs-12 m-b-15 title">

                                    <input type="text" name="search_question" class="form-control search_question_name" maxlength="255"> 

                                </div>

                            </div>

                             <div class="form-group col-md-12 col-sm-12 col-xs-12 p-0 add-rcrd">

                                <form id="resulted_ques">

                                    <div class="modal-space modal-pading resulted_ques">

                                    <!-- FAQ list be shown here using ajax -->

                                    </div>

                                </form>

                                <div class="modal-footer m-t-0 p-b-0 recent-task-sec">

                                    <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>

                                    <button class="btn btn-warning search_ques_btn" type="button"> Confirm</button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@include('frontEnd.common.system_guide_categories')



<script>

//for search button

    

    $('input[name=\'search_question\']').keydown(function(event) { 

        var keyCode = (event.keyCode ? event.keyCode : event.which);   

        if (keyCode == 13) {

            return false;

        }

    });



    $(document).on('click','.search_ques_btn', function(){

       

        var search_input = $('input[name=\'search_question\']');

        var search_ques = search_input.val();



        if(search_ques==""){

            $('.search_question_name').addClass('red_border');

            return false;

        } else{

            $('.search_question_name').removeClass('red_border');

        }



        search_ques = jQuery.trim(search_ques);

        search_ques = search_ques.replace(/[&\/\\#,+()$~%.'":*?<>^@{}]/g, '');



        var formdata = $('#resulted_ques').serialize();

        $('.loader').show();

        $('body').addClass('body-overflow');

        

        $.ajax({

            type : 'get',       

            url:"{{ url('/system-guide/search') }}"+"/"+search_ques,

            data:formdata,

            success : function(resp3){

                if(isAuthenticated(resp3) == false){

                    return false;

                }

                if(resp3 == ''){

                    $('.resulted_ques').html('<div class="text-center p-b-20" style="width:100%">No questions found.</div>');

                } else{

                    $('.resulted_ques').html(resp3);

                }

                $('.loader').hide();

                $('body').removeClass('body-overflow');

            }

        });

        return false;

    });

</script>



<script>

    // for showing questions in first tab

    $(document).ready(function(){

        $(document).on('click','.system_guide',function(){

           

           $('.loader').show();

           $('body').addClass('body-overflow');



           $.ajax({

                type:"get",

                dataType:"json",

                url:"{{ url('/system-guide/faq/view') }}"+"/"+ "{{ $guide_tag }}",

                success: function(resp){



                    if(isAuthenticated(resp) == false) {

                        return false;

                    }



                    var category_name = resp['category_name']; 

                    var html          = resp['content'];

                    $('#category_name').text(category_name);



                    if(html == ""){

                        $('.asked_ques').html('<div class="text-center p-b-20" style="width:100%">No queries found.</div>');

                    }  else{

                         $('.asked_ques').html(html);

                    }



                    $('#System_guide').modal('show');



                    $('.loader').hide();

                    $('body').removeClass('body-overflow');

                }

           });

        });

    });



    //for showing the categories in second tab

    $(document).ready(function(){

        $(document).on('click','.system_guide_categories',function(){

            $('.loader').show();



            $.ajax({

                type:"get",

                url: "{{ url('/system-guide/category/logged') }}",

                success:function(resp1){

                    if(resp1 == ""){

                        $('.categories-list').html('<div class="text-center p-b-20" style="width:100%">No Category Found </div>');

                    } else{

                        $('.categories-list').html(resp1);

                    }

                    $('.loader').hide();

                }

            });

        });

    });

</script>