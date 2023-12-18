@extends('backEnd.layouts.master')
@section('title',' Company Charges')
@section('content')
<?php //echo $limit; die;?>

<style type="text/css">
 #editable-sample_filter > label {
   width:100%; 
 }   


 .action-icn a i {
    color:#1fb5ad;
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
                    <div class="adv-table editable-table">
                        <div class="clearfix">
                            <!-- <div class="btn-group">
                                <a href="system-admin/add">
                                    <button id="editable-sample_new" class="btn btn-primary">
                                        Add Company <i class="fa fa-plus"></i>
                                    </button>
                                </a>    
                            </div> -->
                            @include('backEnd.common.alert_messages')
                        </div>
                        <div class="space15"></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div id="editable-sample_length" class="dataTables_length">
                                    <form method='post' action="{{ url('admin/company-charges') }}" id="records_per_page_form">
                                        <label>
                                            <select name="limit"  size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
                                                <option value="10" <?php if($limit == '10'){ echo "selected";} ?>>10</option>
                                                <option value="20" <?php if($limit == '20'){ echo "selected";} ?>>20</option>
                                                <option value="30" <?php if($limit == '30'){ echo "selected";} ?>>30</option>
                                            </select> records per page
                                        </label>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form method='post' action="{{ url('admin/company-charges') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="dataTables_filter" id="editable-sample_filter">
                                        <label>Search: <input name="search" type="text" value="" aria-controls="editable-sample" class="form-control medium" placeholder="Search Range"></label>
                                        <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                       <!--  <a class="btn btn-primary" href="#" data-toggle="dropdown">
                                            <i class="fa fa-cog fa-fw"></i>
                                        </a> -->
                                        <ul class="dropdown-menu pull-right">
                                            <li>
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
                                        <th>Package Type</th>
                                        <th>Range</th>
                                        <th>Monthly Price</th>
                                        <th>Yearly Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($company_charges as $company_charge){ ?>
                                    <tr>
                                        <td><?php if($company_charge['package_type'] == 'S'){ echo "Silver";}elseif ($company_charge['package_type'] == 'G') { echo "Gold";}elseif($company_charge['package_type'] == 'P'){ echo "Platinum";}elseif ($company_charge['package_type'] == 'F') { echo "Free Trial"; }?></td>
                                        <td>{{ isset($company_charge['home_range'])? $company_charge['home_range'] : '' }}</td>
                                        <td>{{ isset($company_charge['price_monthly'])? '£'.$company_charge['price_monthly'] : '' }}
                                        </td>
                                        <td>{{ isset($company_charge['price_yearly'])? '£'.$company_charge['price_yearly'] : '' }}</td>
                                        <td class="action-icn">
                                            <a href="{{ url('admin/company-charge/edit').'/'.$company_charge['id'] }}" class="edit"><span style = "color: #000"><i data-toggle="tooltip" title="Edit" class="fa fa-edit fa-lg"></i></span></a>
                                        </td>
                                        <!-- <td class="action-icn">
                                            <a href="{{ url('admin/company-charge/edit').'/'.$company_charge['id'] }}" class="edit"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                        </td> -->
                                    </tr>
                                    <?php } ?>
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