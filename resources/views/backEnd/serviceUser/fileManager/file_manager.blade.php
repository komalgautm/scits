@extends('backEnd.layouts.master')

@section('title',' File Manager')

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
                                <a href="{{ url('admin/service-user/file-manager/add/'.$service_user_id) }}">
                                    <button id="editable-sample_new" class="btn btn-primary">
                                        Add Files <i class="fa fa-plus"></i>
                                    </button>
                                </a>    
                            </div>
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    
                                    <form method='post' action="{{ url('admin/service-user/file-managers/'.$service_user_id) }}" id="records_per_page_form">
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
                                <form method='get' action="{{ url('admin/service-user/file-managers/'.$service_user_id) }}">
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
                                    <th>Category</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if($file_query->isEmpty()) {
                                        echo '<tr style="text-align:center">
                                                <td colspan="4">No file found.</td>
                                              </tr>';
                                    } else {
                                        foreach ($file_query as $key => $value) {
                                            $file = ServiceUserFilePath.'/'.$service_user_id.'/'.$value->file;
                                    ?>
                                    <tr class="">
                                        <td>{{ $value->category_name }}</td>
                                        <td><a class="wrinkled" href="{{ $file }}" target="_blank"> 
                                        <span>{{ ucfirst($value->file) }}</span> </a></td>
                                        <td>{{ date('m-d-Y', strtotime($value->created_at))}}</td>
                                        <td class="action-icn">
                                          <!--   <a href="{{ url('admin/mood/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a> -->

                                            <a href="{{ url('admin/service-user/file-manager/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>      
                                    <?php } } ?>                            
                                </tbody>
                            </table>
                        </div>
                        @if($file_query->links() !== null) 
                        {{ $file_query->links() }}
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