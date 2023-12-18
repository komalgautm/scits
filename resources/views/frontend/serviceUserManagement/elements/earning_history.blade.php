<!-- Modal -->
<div class="modal fade" id="EarningHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Earning History</h4>
            </div>
            <div class="earn-hist-body">
                <div class="earnHistScroller">
                    
                    @foreach($earn_history as $value)
                    <div class="his-main">
                    <p class="earn-hist-date"> {{ $value['date'] }}</p>
                        <p>{{ $value['message'] }}</p>
                    </div>
                    @endforeach
                </div>
                @if($total_stars > 0)
                <div class="col-md-12 col-sm-12 col-xs-12 remove-star-btn text-right">
                    <a href="{{ url('/service/earning-scheme/star/remove/'.$service_user_id) }}" class="btn btn-danger remove-earn-str-btn"> Remove A Star </a>
                </div>
                @endif
            
            </div>
            <!-- <div class="modal-footer incen-foot">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            <div class="row"></div>
        </div>
    </div>
</div>

<!-- remove Star Detail modal start -->
<div class="modal fade" id="removeStarDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Star Remove Detail </h4>
            </div>
            <form method="post" action="{{ url('/service/earning-scheme/star/remove/'.$service_user_id) }}" id="saveStarRemoveDetail">
                <div class="modal-body">
                    <div class="row">

                        <!-- s -->

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-1 m-t-5 text-right">Detail</label>
                            <div class="col-md-10">
                                <textarea name="star_remove_detail" value="" rows="5" class="form-control" maxlength="1000"></textarea>
                                <p>Enter the details to remove star</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer incen-foot">

                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-primary save-earn-star-remove-detail"> Save </button><!-- remove-star-btn -->
                </div>  
            </form>
            <div class="row"></div>
        </div>
    </div>
</div>
<!-- remove Star Detail nodal end -->

<script>
    $(document).ready(function(){
        $('.view-star-history').on('click',function(){
            $('#EarningHistoryModal').modal('show');
        });

        $('.remove-earn-str-btn').on('click',function(){
            
            $('#EarningHistoryModal').modal('hide');
            $('#removeStarDetail').modal('show');
            return false;
        });

        /*$('.remove-earn-str-btn').on('click',function(){
            if(confirm('Are You sure you want to remove a star ?')) {
                return true;
            } else{
                return false;
            }
        });*/

    });
</script>
<script>
    //earn history scroller
    $(".earnHistScroller").slimScroll({height:'400px'});
</script>
