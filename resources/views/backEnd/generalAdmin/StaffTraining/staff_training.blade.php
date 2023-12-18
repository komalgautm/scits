@extends('backEnd.layouts.master')

@section('title',' Staff Training')

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
                                <a href="rota-shift/add">
                                    <button id="editable-sample_new" class="btn btn-primary">
                                        Add Shift Plan<i class="fa fa-plus"></i>
                                    </button>
                                </a>    
                            </div> -->
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    <form method='post' action="{{ url('admin/general-admin/staff/training') }}" id="records_per_page_form">
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
                                <form method='get' action="{{ url('admin/general-admin/staff/training') }}">
                                    <div class="dataTables_filter" id="editable-sample_filter">
                                        <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" maxlength="255" placeholder="Enter Training Name"></label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Training Name</th>
                                    <th>Training Provider</th>
                                    <!-- <th>Month</th> -->
                                    <th>Training Year</th>
                                    <th width="20%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if($training->isEmpty())   {
                                            echo '<tr style="text-align:center">
                                                  <td colspan="4">No records found.</td>
                                                  </tr>';
                                    } else {
                                        foreach($training as $key => $value) {
                                            //$month = date('M', strtotime($value->training_month));
                                        ?>

                                            <tr class="">
                                                <td>{{ ucfirst($value->training_name) }}</td>
                                                <td>{{ ucfirst($value->training_provider) }}</td>
                                                <td>{{ $value->training_year }}</td>
                                                <td class="action-icn">
                                                    <a href="{{ url('admin/general-admin/staff/training-view/'.$value->id) }}" class="edit"><span style = "color: #000";><i data-toggle="tooltip" title="View Training" class="fa fa-eye fa-lg"></i></span></a>
                                                </td>

                                                <!-- <td class="action-icn">
                                                    <a href="{{ url('admin/general-admin/staff/training-view/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="View Training" class="fa fa-eye"></i>
                                                    </a>
                                                </td> -->
                                            </tr>
                                            <?php }
                                        } ?>
                              
                                </tbody>
                            </table>
                        </div>
                        
                        @if($training->links() !== null) 
                        {{ $training->links() }}
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