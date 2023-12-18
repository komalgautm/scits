@extends('backEnd.layouts.master')

@section('title',' System Admins')

@section('content')

<?php
    if($del_status == '0') { //regular users
        $page_url = url('admin/system-admins');
    } else { //archive users
        $page_url = url('admin/system-admins/'.'?user=archive');
    }
?>

<style type="text/css">
#editable-sample_filter > label {
width: 80%; 
}

.btn-group {
margin:0px 0px 10px 0px;
}

.action-icn a i {
color:#1fb5ad;    
}


.action-icn a .fa-trash-o {
color:#FF0000;    
}

    
</style>



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
                            @if($del_status == '0')
                            <div class="btn-group">
                                <a href="system-admin/add">
                                    <button id="editable-sample_new" class="btn btn-primary">
                                        Add Company <i class="fa fa-plus"></i>
                                    </button>
                                </a>    
                            </div>
                            @endif
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    <form method='post' action="{{ $page_url }}" id="records_per_page_form">
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
                                <form method='post' action="{{ $page_url }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="dataTables_filter" id="editable-sample_filter">
                                        <label>Search: <input name="search" type="text" value="{{ $search }}" aria-controls="editable-sample" class="form-control medium" placeholder="Search Admin"></label>
                                        <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        <a class="btn btn-primary" href="#" data-toggle="dropdown">
                                            <i class="fa fa-cog fa-fw"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                @if($del_status == '0')
                                                    <a href="{{ url('admin/system-admins/'.'?user=archive') }}">
                                                    Archive User </a>
                                                @else
                                                    <a href="{{ url('admin/system-admins') }}">
                                                    Regular User </a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Admin Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if($system_admins->isEmpty()){ ?>
                                        <?php
                                            echo '<tr style="text-align:center">
                                                  <td colspan="4">No system admin found.</td>
                                                  </tr>';
                                        ?>
                                    <?php 
                                    } 

                                    else
                                    {
                                        foreach($system_admins as $key => $value) 
                                        { 
                                            ?>

                                    <tr class="">
                                        <td>{{ $value->company }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td class="transform-none">{{ $value->email }}</td>
                                        
                                        <td class="action-icn">
                                            @if($del_status == '0')
                                            <a href="{{ url('admin/system-admin/homes/'.$value->id) }}"><i data-toggle="tooltip" title="Homes" class="fa fa-home"></i></a>

                                            <a href="{{ url('admin/system-admin/edit/'.$value->id) }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                           
                                           <a href="{{ url('admin/system-admin/send-set-pass-link/'.$value->id) }}" class="send-set-pass-link-btn-admin" id="{{ $value->id }}"><i class="fa fa-envelope-o" data-toggle="tooltip" title="Send Credential Mail"></i></a>

                                            <!-- <a href="{{ url('admin/users/access-rights/'.$value->id) }}" class="right"s><i data-toggle="tooltip" title="User Rights" class="fa fa-legal"></i></a> -->

                                            <a href="{{ url('admin/system-admin/delete/'.$value->id) }}" class="delete"><i data-toggle="tooltip" title="Delete" class="fa fa-trash-o"></i></a>
                                            @else
                                                <a href="{{ url('admin/system-admin/edit/'.$value->id.'?del_status='.$del_status) }}" class="edit"><i data-toggle="tooltip" title="View" class="fa fa-eye"></i></a>
                                            @endif
                                            <a href="{{ url('admin/system-admin/package/detail/'.$value->id) }}"><i class="fa fa-file-powerpoint-o" data-toggle="tooltip" title="Current Package"></i></a>
                                        
                                        </td>
                                    </tr>
                                    <?php } } ?>
                              
                                </tbody>
                            </table>
                        </div>
                        
                        @if($system_admins->links() !== null) 
                            {{ $system_admins->appends(request()->input())->links() }}
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

<!--script for this page only-->

<script>
    $('document').ready(function(){
        $('.send-set-pass-link-btn-admin').click(function(){

            var system_admin_id = $(this).attr('id');
            $('.loader').show();
            $.ajax({
                type:'get',
                url : '{{ url('admin/system-admin/send-set-pass-link') }}'+'/'+system_admin_id,
                success:function(resp){
                   alert(resp); 
                   $('.loader').hide();
                }
            });
            return false;
        });
    });
</script>

@endsection