@extends('backEnd.layouts.master')

@section('title',':Service User Contacts')

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
                               
                                    <a href="{{ url('admin/service-users/contacts/add/'.$service_user_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Contact <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-users/careteam/'.$service_user_id) }}" id="">
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
                                    <form method='get' action="{{ url('admin/service-users/contacts/'.$service_user_id) }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" placeholder="Enter Name" ></label>
                                            <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Relation</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if($care_team->isEmpty()){
                                            echo '<tr style="text-align:center">
                                                  <td colspan="5">No Contacts found.</td>
                                                  </tr>';
                                        } else {
                                            foreach($care_team as $key => $value) 
                                            {  
                                                $image = contactsPath.'/default_user.jpg';
                                                if(!empty($value->image)){
                                                    $image = contactsPath.'/'.$value->image;
                                                }
                                        ?>

                                        <tr class="">
                                           
                                            <td> <img src = "{{ $image }}" height="50px" width="auto"></td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->job_title_id }}</td>
                                            <td>{{ $value->phone_no }}</td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/service-users/contacts/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit!" class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/service-users/contacts/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete!" class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($care_team->links() !== null) 
                            {{ $care_team->links() }}
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