@extends('backEnd.layouts.master')

@section('title',' Service User Care History')

@section('content')

<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <!-- <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header> -->
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <a href="{{ url('admin/service-users/care-history/add/'.$service_user_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Care History <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-users/care-history/'.$service_user_id) }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                    <option value="10" {{ ($limit == '10') ? 'selected': '' }}>10</option>
                                                    <option value="20" {{ ($limit == '20') ? 'selected': '' }}>20</option>
                                                    <option value="30" {{ ($limit == '30') ? 'selected': '' }}>30</option>
                                                    <!-- <option value="all" {{ ($limit == 'all') ? 'selected': '' }}>All</option> -->
                                                </select> records per page
                                            </label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/service-users/care-history/'.$service_user_id) }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" ></label>
                                            <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($su_care_history_results->isEmpty()){ ?>
                                            <?php
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No records found.</td>
                                                      </tr>';
                                            ?>
                                        <?php 
                                        } 
    									else
                                        {
                                            foreach($su_care_history_results as $key => $value) 
                                            {  ?>

                                        <tr>
                                            <td>{{ date('d M Y',strtotime($value->date)) }}</td>
                                            <td>{{ $value->title }}</td>
                                            
                                            <td class="action-icn"> <!-- data-toggle="modal" href="#su_care_history_edit" -->
                                                
                                                <a href="{{ url('admin/service-users/care-history/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/service-users/care-history/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>

                                                <?php //$user_id = base64_encode(convert_uuencode($value->id)); ?>
                                                
                                                <!-- <a href="{{ url('admin/service-users/send-set-pass-link/'.$value->id) }}" class="mail"><i data-toggle="tooltip" title="Send Credential Mail" class="fa fa-envelope-o"></i></a> -->
                                            </td>
                                            
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Showing 1 to 28 of 28 entries</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Prev</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div> -->
                            @if($su_care_history_results->links() !== null) 
                            {{ $su_care_history_results->links() }}
                            @endif

                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
<!--main content end-->

<!-- Add Service User Care History -->



<script>
$(document).ready(function() {

    $('.default-date-picker').datepicker({
        //format: 'yyyy-mm-dd'
         format: 'dd-mm-yyyy',
        // maxDate:'+13-02-2017'
        });
    });
</script>

<script>
/*    jQuery(document).ready(function() {
        EditableTable.init();
    });*/
</script>

<!-- <script>
    $(document).ready(function(){
        // get record list
        $(".edit_care").click(function(){
            var check = $(this).attr('care-id')
            alert(check); return false;
           
            // $('.loader').show();
            // $('body').addClass('body-overflow');

           
            $.ajax({
                type : 'get',
                type : 'get',
                url  : "{{ url('/system/health-records') }}",
                // dataType : 'json',

                success:function(resp){
                    
                    
                }
            });
            
        });
    });
</script> -->

@endsection