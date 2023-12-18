@extends('backEnd.layouts.master')

@section('title',':Moods')

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
                                    <a href="{{ url('admin/mood/add') }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Mood <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        
                                        <form method='post' action="{{ url('admin/moods') }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/moods') }}">
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
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($mood_list->isEmpty()) {
                                            echo '<tr style="text-align:center">
                                                    <td colspan="4">No mood found.</td>
                                                  </tr>';
                                        } else {
                                            foreach ($mood_list as $key => $value) {
                                                $image = env('APP_URL').MoodImgPath.'/dummy.jpg';
                                                if(!empty($value->image)) {
                                                    $image = env('APP_URL').MoodImgPath.'/'.$value->image;
                                                }
                                        ?>
                                        <tr class="">
                                            
                                            <td>{{ ucfirst($value->name) }}</td>
                                            <td><img src="{{ $image }}" alt="No mood" height="50px" width="auto"></td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/mood/edit/'.$value->id) }}" class="edit"><span style = "color: #000"><i data-toggle="tooltip" title="Edit" class="fa fa-edit fa-lg"></i></span></a>
                                                <a href="{{ url('admin/mood/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o fa-lg"></i></span></a>
                                            </td>

                                            <!-- <td class="action-icn">
                                                <a href="{{ url('admin/mood/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/mood/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                            </td> -->
                                        </tr>      
                                        <?php } } ?>                            
                                    </tbody>
                                </table>
                            </div>
                            @if($mood_list->links() !== null) 
                            {{ $mood_list->links() }}
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