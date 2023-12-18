@extends('backEnd.layouts.master')

@section('title',':Risk')

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
    <!-- page start -->
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    <form method='post' action="{{ url('admin/service-user/risks/'.$service_user_id) }}" id="records_per_page_form">
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
                                <form method='get' action="{{ url('admin/service-user/risks/'.$service_user_id) }}">
                                    <div class="dataTables_filter" id="editable-sample_filter">
                                        <label>Search: <input name="search" type="text" placeholder="Enter title" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" ></label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    if($risks_query->isEmpty()){ ?>
                                        <?php
                                            echo '<tr style="text-align:center">
                                                  <td colspan="4">No Record found.</td>
                                                  </tr>';
                                        ?>
                                    <?php 
                                    } else {
                                        foreach($risks_query as $key => $value) 
                                        {   if(empty($value->created_at)) {
                                                $date = '';
                                            } else {
                                                $date = date('d F Y',strtotime($value->created_at));
                                            }

                                            if($value->status == '2') {
                                                $status = 'Live Risk';
                                            } else if($value->status == '1') {
                                                $status = 'Historic Risk';
                                            } else {
                                                $status = 'No Risk';
                                            }

                                        ?>

                                    <tr class="">

                                        <td>{{ $value->description }}</td>
                                        <td>{{ $status }}</td>
                                        <td>{{ $date }}</td>

                                        <td class="action-icn">
                                            <a href="{{ url('admin/service-user/risk/view/'.$value->id.'?risk=risk_change') }}" class="edit"><i data-toggle="tooltip" title="Risk Change" class="fa fa-plus-square"></i></a>
                                            <a href="{{ url('admin/service-user/risk/view/'.$value->id.'?risk=rmp_risk') }}" class="edit"><i data-toggle="tooltip" title="RMP" class="fa fa-meh-o"></i></a>
                                            <a href="{{ url('admin/service-user/risk/view/'.$value->id.'?risk=inc_risk') }}" class="edit"><i data-toggle="tooltip" title="Incident Report" class="fa fa-bolt"></i></a>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                              
                                </tbody>
                            </table>
                        </div>
                        
                        @if($risks_query->links() !== null) 
                            {{ $risks_query->links() }}
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end -->
    </section>
</section>
<!--main content end-->

@endsection