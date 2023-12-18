<!-- send Modification request Modal Start -->
<div class="modal fade" id="ModifyRequestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Modification Request </h4>
            </div>
            <form   data-pid='modify_request_edit' id="contact-form-data"  ng-app="myApp" ng-controller="validateController" name="ModiForm" >
          
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 m-t-5 text-right">Action</label>
                            <div class="col-md-9">
                                <select name="action" id="action" class="form-control" required="" ng-model="action">
                                    <option value="">Select Action</option>
                                    <option value="add">Add</option>
                                    <option value="edit">Edit</option>
                                    <option value="Delete">Delete</option>
                                    <option value="view">View</option>
                                </select>
                                <p>Select action to perform</p>
                           </div>
                        </div>
                        <!-- <input type="text" name="type_mod"> -->
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 m-t-5 text-right">Content</label>
                            <div class="col-md-9">
                                <textarea name="content" id="content" value="" rows="5" class="form-control" required="" ng-model="content" ></textarea>
                                <p>Enter the Content to modify</p>
                                <p ng-show="ModiForm.content.$error.required"></p>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-2 m-t-5 text-right">Reason</label>
                            <div class="col-md-9">
                                <textarea name="reason" value=""  id="reason" rows="5" class="form-control"  required="" ng-model="reason"></textarea>
                                <p>Enter the Reason</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer incen-foot">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                    <button type="button" class="btn btn-warning modify-req-btn submit-button-save"> Send Request </button>
                </div>  
            </form>
            <!-- <input type="text" class="val1" value="">
            <button type="button" class="btn btn-primary datasave">sub</button> -->

        
            <div class="row"></div>
        </div>
    </div>
</div>
<!-- send Modification request Modal end -->
<script>


$(document).ready(function() 
{
    $(".submit-button-save").click(function(e){            
        form_data = $("form#contact-form-data").serialize()
        $.ajax({
            url: "{{url('/send-modify-request')}}",
            type: "POST",
            data: form_data,
            success: function(data) 
            {
                if ($.isEmptyObject(data.error))
                {
                    handleSuccess(data.success);
                }
                else
                {
                    handleError(data.error);
                }
            }
        });
    });
});



    // $('.datasave').click(function(){
    //     var val1 = $('.val1').val();
    //     alert(val1);
    //     $.ajax({
    //         method: 'POST',
    //         url:"{{url('/send-modify-request')}}",
    //         data:{val1:123},
    //         success:function(data){
    //             console.log(data)
    //         }
    //     })
    // })
</script>

<script>

 
    // $( 'form#testForm' ).submit(function(event){
    //     event.preventDefault();
    //     alert("form submit");
    //     console.log("form submit");
    //     // var data = new FormData( $( 'form#testForm' )[ 0 ] );
    //     var formData = {
    //         name: $("#action").val(),
    //         email: $("#content").val(),
    //         superheroAlias: $("#reason").val(),
    //     };
    //     alert(formData);
    //     $.ajax( {
    //         // processData: false,
    //         // contentType: false,
    //         // async: false,
    //         // cache: false,
    //         // data: formData,
    //         // dataType: 'json',
    //         method : "POST",
    //         // type: $( this ).attr( 'method'),
    //         url: '{{ url("/send-modify-request") }}',
    //         success: function( feedback ){
    //             console.log( "the feedback from your API: " + feedback );
    //         }
    //     });
    // });

var app = angular.module('myApp', []);
app.controller('validateController', function($scope) {
    //$scope.content = 'John Doe';
    console.log($.param($scope.action));
    // $http({
    //     method : 'POST', 
    //     url : '{{ url("/send-modify-request") }}',
    //     data : $.param($scope.note),
    //     headers : {'Content-Type': 'application/x-www-form-urlencoded',
    //                            'x-csrf-token': CSRF_TOKEN}
    // });
});

</script>


