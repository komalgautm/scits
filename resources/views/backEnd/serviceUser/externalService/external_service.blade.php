@extends('backEnd.layouts.master')

@section('title',':External Service')

@section('content')

<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">

                                <div class="btn-group">
                                    <a href="{{ url('admin/service-user/external-service/add/'.$service_user_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add External Service <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>

                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-user/external-service/'.$service_user_id) }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/service-user/external-service/'.$service_user_id) }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" placeholder="Enter Company Name"></label>
                                            <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Contact Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        if($su_ext_service->isEmpty()){ ?>
                                            <?php
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No Contact found.</td>
                                                      </tr>';
                                            ?>
                                        <?php 
                                        } 

                                        else
                                        {
                                            foreach($su_ext_service as $key => $value) 
                                            {  ?>

                                        <tr >
                                            <td class="user_name">{{ $value->company_name }}</td>
                                            <td class="user_name">{{ $value->contact_name }}</td>
                                            <td class="transform-none" style="text-transform: none;">{{ $value->email }}</td>
                                            <td class="user_name">{{ $value->phone_no }}</td>
                                            <?php 
                                                /*$access_level = '';
                                                if($value->access_level == 1)
                                                {
                                                    $access_level = 'System Admin';
                                                } 
                                                else if($value->access_level == 2)
                                                {
                                                    $access_level = 'Line Manager';                                         
                                                } 
                                                else if($value->access_level == 3)
                                                {
                                                    $access_level = 'Staff';                                            
                                                }
                                                else{}*/ 
                                            ?>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/service-user/external-service/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/service-user/external-service/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Showing 1 to 28 of 28 entries</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Prev</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div> -->
                            @if($su_ext_service->links() !== null) 
                            {{ $su_ext_service->links() }}
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

<script>
    $('document').ready(function(){
        $('.send-set-pass-link-btn').click(function(){

            var send_btn = $(this);
            var user_id = send_btn.attr('id');
        
            $('.loader').show();

            $.ajax({
                type:'get',
                url : '{{ url('admin/users/send-set-pass-link') }}'+'/'+user_id,
                success:function(resp){

                    if(resp == true){
                        
                        var usr = send_btn.closest('tr').find('.user_name').text();
                        alert('Email sent to '+usr+' successfully');
                    
                    } else{
                        alert('{{ COMMON_ERROR }}');
                    }
                    $('.loader').hide();
                }
            });
            return false;
        });
    });
</script>

@endsection