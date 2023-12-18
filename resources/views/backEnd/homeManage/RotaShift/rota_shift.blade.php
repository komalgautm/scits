@extends('backEnd.layouts.master')

@section('title',' Rota Shift')

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
                                    <a href="rota-shift/add">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Shift Plan <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/home/rota-shift') }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                    <option value="10" {{ ($limit == '10') ? 'selected': '' }}>10</option>
                                                    <option value="20" {{ ($limit == '20') ? 'selected': '' }}>20</option>
                                                    <option value="30" {{ ($limit == '30') ? 'selected': '' }}>30</option>
                                                </select> Records per page
                                            </label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/home/rota-shift') }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" maxlength="255"></label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Shift Type</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($rota_shifts->isEmpty())   {
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No records found.</td>
                                                      </tr>';
                                        } else {
                                            foreach($rota_shifts as $key => $value) 
                                            {  
                                                if(!empty($value->start_time)) {
                                                    if($rota_time_format == '12') {
                                                        if($value->start_time <= 12) { 
                                                            $start_time = $value->start_time.'am'; 
                                                        } else { 
                                                            $start_time = $value->start_time-12;
                                                            $start_time = $start_time.'pm';
                                                        }
                                                    } else {
                                                        $start_time = $value->start_time;
                                                    }
                                                   
                                                } else{
                                                    $start_time = '';
                                                }

                                                if(!empty($value->end_time)) {
                                                    if($rota_time_format == '12') {
                                                        if($value->end_time <= 12)
                                                        { 
                                                            $end_time = $value->end_time.'am'; 
                                                        } else {
                                                            $end_time = $value->end_time-12;
                                                            $end_time = $end_time.'pm';
                                                        }
                                                    } else {
                                                        $end_time = $value->end_time;
                                                    }
                                                } else{
                                                    $end_time = '';
                                                }
                                            ?>

                                                <tr class="">
                                                    <td>{{ ucfirst($value->name) }}</td>
                                                    <td>{{ $start_time }}</td>
                                                    <td>{{ $end_time }}</td>
                                                    <td class="action-icn">
                                                        <a href="{{ url('admin/home/rota-shift/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="View Shift Plan" class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ url('admin/home/rota-shift/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete Shift Plan" class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php }
                                            } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($rota_shifts->links() !== null) 
                            {{ $rota_shifts->links() }}
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