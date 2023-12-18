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
                                
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-user/moods/'.$service_user_id) }}" id="records_per_page_form">
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
                                    <form method='get' action="{{ url('admin/service-user/moods/'.$service_user_id) }}">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" placeholder="Enter mood" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" ></label>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th class="emotion-size-fix">Emotion</th>
                                        <th>Description</th>
                                        <th>Suggestions</th>
                                        <th class="date-size-fix">Date</th>
                                        <th class="action-size-fix">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        if($su_moods->isEmpty()){ ?>
                                            <?php
                                                echo '<tr style="text-align:center">
                                                      <td colspan="4">No Record found.</td>
                                                      </tr>';
                                            ?>
                                        <?php 
                                        } else {
                                            foreach($su_moods as $key => $value) 
                                            {  
                                                $image = MoodImgPath.'/dummy.jpg';

                                                if(!empty($value->image))  {

                                                    $image = MoodImgPath.'/'.$value->image;
                                                }
                                            ?>

                                        <tr class="">
                                            <td><img src="{{ $image }}" height="40px" width="auto">  {{ $value->name }} </td>
                                            <td>{{ $value->description }}</td>
                                            <td>{{ $value->suggestions }}</td>
                                            <td>{{ date('d/m/Y H:i',strtotime($value->created_at)) }}</td>

                                            <td class="action-icn">
                                                <a href="{{ url('admin/service-user/mood/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Give Suggestion" class="fa fa-edit"></i></a>

                                                <a href="{{ url('admin/service-user/mood/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            
                            @if($su_moods->links() !== null) 
                            {{ $su_moods->links() }}
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