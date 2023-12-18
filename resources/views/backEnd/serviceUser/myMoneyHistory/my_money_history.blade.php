@extends('backEnd.layouts.master')

@section('title',' Service User My Money History')

@section('content')

<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <!-- <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header> -->
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <h4>Available Money = £{{$my_money_balance}}</h4>
                                   <!-- < a href="{{ url('admin/service-users/care-history/add/'.$service_user_id) }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Care History <i class="fa fa-plus"></i>
                                        </button>
                                    </a> -->
                                </div>
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-users/care-history/'.$service_user_id) }}" id="records_per_page_form">
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
                               <!--  <div class="col-lg-6">
                                    <form method='get' action="{{ url('admin/service-users/care-history/'.$service_user_id) }}">
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
                                        <th>Date</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                        <th width="20%">Detail</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($su_my_money->isEmpty()){ ?>
                                            <?php
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No records found.</td>
                                                      </tr>';
                                            ?>
                                        <?php 
                                        } 
    									else
                                        {
                                            foreach($su_my_money as $key => $value) { 
                                                if($value->txn_type == 'D'){
                                                    $txn_type = 'Deposit';
                                                } else {
                                                    $txn_type = 'Withdraw';
                                                }
                                            ?>
                                        <tr>
                                            <td>{{ date('d M, Y',strtotime($value->created_at)) }}</td>
                                            <td>{{ $txn_type }}</td>
                                            <td>£{{ $value->txn_amount }}</td>
                                            <td>£{{ $value->balance }}</td>
                                            <td>{{ ucfirst($value->description) }}</td>
                                            
                                                                
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            @if($su_my_money->links() !== null) 
                            {{ $su_my_money->links() }}
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