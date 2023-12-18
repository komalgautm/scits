@extends('backEnd.layouts.master')
@section('title',' Incentive ')
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
                                    <a href="{{ url('admin/earning-scheme/incentive/add/'.$earning_category_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Incentive  <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                <div class="btn-group pull-right">
                                    <!-- <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button> -->
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/earning-scheme/incentive/'.$earning_category_id) }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                    <option value="10" {{ ($limit == '10') ? 'selected': '' }}>10</option>
                                                    <option value="20" {{ ($limit == '20') ? 'selected': '' }}>20</option>
                                                    <option value="30" {{ ($limit == '30') ? 'selected': '' }}>30</option>
                                                </select> records per page
                                            </label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/earning-scheme/incentive/'.$earning_category_id) }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" maxlength="255"></label>    
                                            <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Stars Required</th>
                                        <th>Status</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($incentives->isEmpty())   
                                        {
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No incentive found.</td>
                                                      </tr>';
                                        } 

                                        else
                                        {
                                            foreach($incentives as $key => $value) 
                                            {  ?>

                                        <tr class="">
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->stars }}</td>
                                            <?php 
                                                $status = '';
                                                if($value->status == 1)
                                                {
                                                    $status = 'Active';
                                                } 
                                                else if($value->status == 0)
                                                {
                                                    $status = 'Inactive';                                         
                                                } 
                                                
                                                else{} 
                                            ?>
                                            <td>{{ $status }}</td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/earning-scheme/incentive/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit!" class="fa fa-edit"></i></a>
                                                <a href="{{ url('admin/earning-scheme/incentive/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete!" class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>

                            <!-- <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Showing 1 to 28 of 28 entries</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Prev</a></li><li class="next"><a href="#">Next → </a></li></ul></div></div></div> -->


                            @if($incentives->links() !== null) 
                            {{ $incentives->links() }}
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

    <!--script for this page only-->
<!-- <script src="{{ url('public/backEnd/js/table-editable.js') }}"></script> -->

<!-- END JAVASCRIPTS -->


@endsection