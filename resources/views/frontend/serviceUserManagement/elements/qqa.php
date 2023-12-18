<div class="modal fade" id="qqaReviewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title qqa-review-title">QQA Review</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="{{ url('/service/placement-plan/add-qqa-review') }}">
                        <div class="col-md-12 col-sm-12 col-xs-12 cog-panel">
                            <div class="form-group p-0 col-md-12 col-sm-12 col-xs-12 add-rcrd">
                                <label class="col-md-12 col-sm-12 col-xs-12 p-t-7 detail-info-label"></label>
                                <div class="col-md-12 col-sm-12 col-xs-12 r-p-0">
                                    <div class="input-group popovr">
                                        <textarea name="qqa_review" class="form-control detail-info-txt " rows="5" maxlength="1000"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer modal-bttm m-t-0">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="service_user_id" value="{{ $service_user_id }}">
                            <input type="hidden" name="placement_plan_id" value="">
                            <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning save-qqa-review" type="submit"> Confirm </button>
                        </div>
                    </form>
                </div>
            </div>           
        </div>
    </div>
</div>