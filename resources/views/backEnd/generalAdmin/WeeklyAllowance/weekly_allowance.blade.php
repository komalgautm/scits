@extends('backEnd.layouts.master')

@section('title',' Weekly Allowance')

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
                                <!-- <div class="btn-group">
                                    <a href="javascript:;">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                        <i class="fa fa-money"></i>
                                        </button>
                                    </a>    
                                </div> -->
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/general-admin/allowance/weekly') }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/general-admin/allowance/weekly') }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" maxlength="255" placeholder="Enter Service User Name"></label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Service User</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!-- <th width="20%">Actions</th> -->
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($weekly_allowance->isEmpty())   {
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No records found.</td>
                                                      </tr>';
                                        } else {
                                            foreach($weekly_allowance as $key => $value) { 
                                                $date = date('d M, Y', strtotime($value->created_at));
                                                if($value->status == 'A') {
                                                    $status = 'Allowed'; 
                                                } else {
                                                    $status = 'Not Allowed';
                                                }
                                            ?>

                                                <tr class="">
                                                    <td>{{ ucfirst($value->name) }}</td>
                                                    <td>£{{ $value->amount }}</td>
                                                    <td>{{ $status }}</td>
                                                    <td>{{ $date }}</td>

                                                <!--    <td class="action-icn">
                                                        <a href="{{ url('admin/general-admin/allowance/weekly/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Weekly Allowance" class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr> -->
                                                <?php }
                                            } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($weekly_allowance->links() !== null) 
                            {{ $weekly_allowance->links() }}
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