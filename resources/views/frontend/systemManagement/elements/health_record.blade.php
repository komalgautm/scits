<!-- Health Records -->
<div class="modal fade" id="healthmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> System Management - {{ $labels['health_record']['label'] }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="events-list health-record-list">
                        <!-- health record list by ajax -->
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- <ul cla ss="pagination">
                            <li><a href="#">«</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">»</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>

            <div class="modal-footer m-t-0">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                <!-- <button class="btn btn-warning" type="button"> Confirm </button> -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // get record list
        $(".health_record").click(function(){
            $('.loader').show();
            $('body').addClass('body-overflow');
           
            $.ajax({
                type : 'get',
                url  : "{{ url('/system/health-records') }}",
                success:function(resp){
                    if(isAuthenticated(resp) == false){
                        return false;
                    }
                    if(resp == '') {
                        $('.health-record-list').html('<div class="text-center p-b-20" style="width:100%"> No Records found. </div>');    
                    } else {
                        $('.health-record-list').html(resp);
                    }

                    // $('.health-record-list').html(resp);
                    $('#healthmodal').modal('show');
                    $('.loader').hide();
                    $('body').removeClass('body-overflow');
                }
            });
        });
    });
</script>

<script>
    //pagination of health record
    $(document).on('click','#healthmodal .pagination li',function(){
        var new_url = $(this).children('a').attr('href');
        if(new_url == undefined){
            return false;
        }
        
        $('.loader').show();
        $('body').addClass('body-overflow');

        $.ajax({
            type : 'get',
            url  : new_url,
            success:function(resp){
                if(isAuthenticated(resp) == false){
                    return false;
                }

                $('.health-record-list').html(resp);
                $('#healthmodal').modal('show');
                $('.loader').hide();
                $('body').removeClass('body-overflow');
            }
        });
        return false;
    });
</script>
