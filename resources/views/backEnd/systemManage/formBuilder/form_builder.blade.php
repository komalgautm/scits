@extends('backEnd.layouts.master')
@section('title',': Form Builder')
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
                                    <a href="form-builder/add">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Form <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/form-builder') }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                    <option value="10" {{ ($limit == '10') ? 'selected': '' }}>10</option>
                                                    <option value="20" {{ ($limit == '20') ? 'selected': '' }}>20</option>
                                                    <option value="30" {{ ($limit == '30') ? 'selected': '' }}>30</option>
                                                    <!-- <option value="all" {{ ($limit == 'all') ? 'selected': '' }}>All</option> -->
                                                </select>
                                            </label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/form-builder') }}">
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
                                        <th>Title</th>
                                       <!--  <th>Icon</th> -->
                                        <!-- <th>Details</th>  -->
                                        <th width="20%">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                       
                                        <?php
                                        if($forms->isEmpty())   {
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No Form found.</td>
                                                      </tr>';
                                        } 

                                        else
                                        {
                                            // echo "<pre>";
                                            // print_r($forms);
                                            foreach($forms as $key => $value) 
                                            {  ?>

                                        <tr class="">
                                            <td>{{ $value->title }}</td>
                                            <?php $strlen = strlen($value->detail); ?>
                                            <!-- <td>
                                                <?php 
                                                    if($strlen > 150){ 
                                                        echo substr($value->detail,0,150).'...';
                                                    } else{
                                                        echo substr($value->detail,0,150);
                                                    }
                                                ?>
                                            </td>  -->
                                            <td class="action-icn">
                                                <a href="{{ url('admin/form-builder/edit/'.$value->id) }}" class="edit"><span style = "color: #000;"><i data-toggle="tooltip" title="Edit" class="fa fa-edit fa-lg"></i></span></a>
                                                <a href="{{ url('admin/form-builder/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete!" class="fa fa-trash-o fa-lg"></i></a>
                                            </td>

                                            <!-- <td class="action-icn">
                                               <a href="{{ url('admin/form-builder/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>

                                              <a href="{{ url('admin/form-builder/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete!" class="fa fa-trash-o"></i></a>
                                            </td> -->
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>

                            @if($forms->links() !== null) 
                            {{ $forms->links() }}
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