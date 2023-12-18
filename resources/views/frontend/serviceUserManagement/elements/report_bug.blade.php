<!-- send bug report model -->
<div class="modal fade" id="reportBugModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cancel-btn" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Send Bug Report </h4>
            </div>
            <div class="modal-body nrml-txt-clr">
                <div class="row">
                <form method="post" action="{{ url('/bug-report/add') }}" >
                    
                    <div class="ticket-add">
                        <div class="form-group col-md-12 co-sm-12 col-xs-12">
                            <label class="col-md-2 col-sm-2 p-t-7 p-l-0 p-r-0"> Title: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 p-0">
                                <input type="text" class="form-control" name="title" value="Bug Report"  readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group col-md-12 co-sm-12 col-xs-12q">
                            <label class="col-md-2 col-sm-2 p-t-7 p-l-0 p-r-0"> Description: </label>
                            <div class="col-md-10 col-sm-10 col-xs-12 p-0">
                                <textarea rows="4" class="form-control txtarea" name="message" >I have found following bug in the website. Please resolve this.
Bug Name: {{ $bug_report['err'] }},
Bug Url: {{ $bug_report['path'] }}</textarea> 
                                <p style="padding:10px 0px 0px">Note: This report can be viewed in support ticket</p>
                            </div>
                        </div>
                        <div class="modal-footer tkt-ftr m-t-0 recent-task-sec">
                            <?php
                               $path = $bug_report['path'];
                               if(strpos($path,'/admin') !== false) {
                                    $user_id = Session::get('scitsAdminSession')->id;
                                    $website_end = 'backend';
                               } else {
                                    $user_id = Auth::user()->id;
                                    $website_end = 'frontend'; 
                               }
                            ?>
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <input type="hidden" name="website_end" value="{{ $website_end }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button class="btn btn-default cancel-btn" type="button" data-dismiss="modal" aria-hidden="true"> Cancel </button>
                            <button class="btn btn-warning" type="submit">Send Report </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>       
        </div>
    </div>
</div>