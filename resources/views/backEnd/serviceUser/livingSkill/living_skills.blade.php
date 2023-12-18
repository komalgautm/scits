@extends('backEnd.layouts.master')

@section('title',':LivingSkills')

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
                           
                                <a href="{{ url('admin/service-user/careteam/add/'.$service_user_id) }}">
                                    <button id="editable-sample_new" class="btn btn-primary">
                                        Add care member <i class="fa fa-plus"></i>
                                    </button>
                                </a>    
                            </div> -->
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    <form method='post' action="{{ url('admin/service-user/living-skills/'.$service_user_id) }}" id="records_per_page_form">
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
                                <form method='get' action="{{ url('admin/service-user/living-skills/'.$service_user_id) }}">
                                    <div class="dataTables_filter" id="editable-sample_filter">
                                        <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" placeholder="Search by title"></label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Score</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    if($su_living_skills->isEmpty()) {
                                        echo '<tr style="text-align:center">
                                                <td colspan="4">No record found.</td>
                                              </tr>';
                                    } else {
                                        foreach($su_living_skills as $key => $su_living_skill) {  
                                    ?>
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($su_living_skill['created_at'])) }}</td>
                                        <td>{{ ucfirst($su_living_skill['description']) }}</td>
                                        <td>{{ $su_living_skill['scored'] }}</td>
                                        <td class="action-icn">
                                            <a href="{{ url('admin/service-user/living-skill/view/'.$su_living_skill->id) }}"><i data-toggle="tooltip" title="View!" class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        @if($su_living_skills->links() !== null) 
                            {{ $su_living_skills->links() }}
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