<!-- Earning Target set Modal start -->
<div class="modal fade" id="EarningTargetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Earning Target</h4>
            </div>
            <form method="post" action="{{ url('/service/earning/set-target') }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-5 m-t-10">Change Service user Earning Target</label>
                            <div class="col-md-5">
                                <div class="select-style medium-select">
                                    <select name="target">
                                        <option value="0">Select Target</option>
                                        <?php for($i=1;  $i<=20; $i++){ ?>
                                        <option value="{{ $i * 5 }}" {{ ($earning_target == $i * 5) ? 'selected':'' }} >{{ $i * 5 }}%</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer incen-foot">
                    <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save-target-btn">Save changes</button>
                </div>  
            </form>
            <div class="row"></div>
        </div>
    </div>
</div>
<!-- Earning Target set Modal end -->

<script>
    $(document).ready(function(){
        $('.trgt-chn-btn').on('click',function(){
            $('#EarningTargetModal').modal('show');
        });

        $('.save-target-btn').click(function(){
            var target = $('select[name=\'target\']').val();
            
            if(target == '0'){
                $('select[name=\'target\']').parent().addClass('red_border');
                return false;    
            } else{
                $('select[name=\'target\']').parent().removeClass('red_border');                    
                return true;
            }
        });
    });
</script>