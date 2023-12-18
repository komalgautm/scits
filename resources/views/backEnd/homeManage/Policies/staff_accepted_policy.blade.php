@extends('backEnd.layouts.master')

@section('title',':Policies & Procedure')

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
                                   <!--  <a href="{{ url('admin/home/policies/add') }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Policies <i class="fa fa-plus"></i>
                                        </button>
                                    </a>   -->  
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        
                                        <form method='post' action="{{ url('admin/home/policies/staff/accepted/'.$policy_id) }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/home/policies/staff/accepted/'.$policy_id) }}">
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
                                        <th>Staff Name</th>
                                        <th>Date</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($staff_list->isEmpty()) {
                                            echo '<tr style="text-align:center">
                                                    <td colspan="4">No record found.</td>
                                                  </tr>';
                                        } else {
                                            foreach ($staff_list as $key => $value) {
                                            
                                        ?>
                                        <tr class="">
                                            
                                            <td width="50%">{{ ucfirst($value->name) }}</td>
                                            <td>{{ date('m-d-Y h:i a', strtotime($value->updated_at))}}</td>
                                            <!--<td class="action-icn">

                                                <a href="" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                                
                                                <a href="" class="edit"><i data-toggle="tooltip" title="Staff Accepted Policies" class="fa fa-eye"></i></a>  
                                            </td>-->
                                        </tr>      
                                        <?php } } ?>                            
                                    </tbody>
                                </table>
                            </div>
                            @if($staff_list->links() !== null) 
                            {{ $staff_list->links() }}
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