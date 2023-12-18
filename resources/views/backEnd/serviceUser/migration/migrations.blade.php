@extends('backEnd.layouts.master')
@section('title',' Migrations')
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
                            <div class="clearfix m-b-10">
                                <div class="btn-group">
                                    <a href="{{ url('admin/service-users/migration/send-request/'.$service_user_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Send Migration Request <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6"> <?php $limit = 0; $search = ''; ?>
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-users/migrations/'.$service_user_id) }}" id="records_per_page_form">
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
                                <!-- <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/label/view') }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" ></label>
                                        </div>
                                    </form>
                                </div> -->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Service User</th>
                                        <th>From (Home)</th>
                                        <th>To (Home)</th>
                                        <th>Request Made On</th>
                                        <th>Request Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                         if($migrations->isEmpty()) {
                                            echo '<tr style="text-align:center">
                                                      <td colspan="6">No Records found.</td>
                                                      </tr>';
                                         }else{
                                         foreach($migrations as $value){
                                            if($value['status'] == 'P'){
                                                $status = 'Pending';
                                            } else if($value['status'] == 'C'){
                                                $status = 'Cancelled';
                                            } else if($value['status'] == 'A'){
                                                $status = 'Accepted';
                                            } else if($value['status'] == 'R'){
                                                $status = 'Rejected';
                                            } else{
                                                $status = '';                                            
                                            }
                                        ?>
                                        <tr >
                                            
                                            <td>{{ $value['su_name'] }}</td>
                                            <td>{{ $value['pre_home_name'] }}</td>
                                            <td>{{ $value['new_home_name'] }}</td>
                                            <td>{{ date('d-m-Y g:i a',strtotime($value['created_at'])) }}</td>
                                            <td>{{ $status }}</td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/service-users/migration/view/'.$value['id']) }}" class="edit"><i data-toggle="tooltip" title="View detail" class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>                                                                               
                                    </tbody>
                                </table>
                            </div>
                            
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