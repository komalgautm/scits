@extends('backEnd.layouts.master')

@section('title',':Placement plan')

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
                                
                                    <a href="placement-plan/add">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Target  <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/placement-plan') }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/placement-plan') }}">
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
                                        <th>Target</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($targets->isEmpty()){ 
                                            echo '<tr style="text-align:center">
                                                  <td colspan="5">No Target found.</td>
                                                  </tr>';
                                            ?>
                                        <?php 
                                        } 

                                        else
                                        {
                                            foreach($targets as $key => $value) 
                                            {?>
                                        <tr class="">
                                            <td>{{ $value->task }}</td>
                                            <td>{{ $value->date }}</td>
                                            <td>{{ $value->description }}</td>
                                            <?php 
                                                $status = '';
                                                if(($value->status == 0) && ($value->date >= $today))
                                                {
                                                    $status = 'Active';
                                                } 
                                                else if($value->status == 1)
                                                {
                                                    $status = 'Completed';                                         
                                                } 
                                                else if(($value->status == 0) && ($value->date <= $today))
                                                {
                                                    $status = 'Pending';                                            
                                                }
                                                else{} 
                                            ?>
                                            <td>{{ $status }}</td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/placement-plan/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit!" class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/placement-plan/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete!" class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Showing 1 to 28 of 28 entries</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Prev</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div> -->
                            @if($targets->links() !== null) 
                            {{ $targets->links() }}
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

@endsection