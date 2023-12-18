@extends('backEnd.layouts.master')
@section('title',' Labels')
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
                                    <a href="{{ url('admin/homelist/add') }}">
                                        <button id="editable-sample_new" class="btn btn-primary">
                                            Add Home <i class="fa fa-plus"></i>
                                        </button>
                                    </a>    
                                </div> -->
                                @include('backEnd.common.alert_messages')
                            </div>
                            <div class="space15"></div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/homelist') }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                    <option value="10" {{ ($limit == '10') ? 'selected': '' }}>10</option>
                                                    <option value="20" {{ ($limit == '20') ? 'selected': '' }}>20</option>
                                                    <option value="30" {{ ($limit == '30') ? 'selected': '' }}>30</option>
                                                </select> records per page
                                            </label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div> -->
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
                                        <th>Default label</th>
                                        <th>New label</th>
                                        <th>Icons</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($labels as $label)
                                        <tr >
                                            <td>{{ $label['name'] }}</td>
                                            <td>{{ isset($label['renamed']['name']) ? $label['renamed']['name'] : '' }}</td>
                                            
                                            <?php $new_icon = '';
                                            if(isset($label['renamed']['icon'])){
                                                if(!empty($label['renamed']['icon'])){
                                                    $new_icon = $label['renamed']['icon'];
                                                }
                                            } ?>
                                            <td class="action-icn">
                                                <a><i class="{{ !empty($new_icon) ? $new_icon : $label['icon'] }}"></i></a>
                                            </td>
                                            <td class="action-icn">
                                                <a href="{{ url('admin/label/view/'.$label['tag']) }}" class="edit"><span style = "color: #000"><i data-toggle="tooltip" title="Edit" class="fa fa-edit fa-lg"></i></span></a>
                                            </td>
                                            <!-- <td class="action-icn">
                                                <a href="{{ url('admin/label/view/'.$label['tag']) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                            </td> -->
                                        </tr>
                                        @endforeach                                                                               
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