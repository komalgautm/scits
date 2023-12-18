@extends('backEnd.layouts.master')

@section('title',':DailyLog')

@section('content')

@php
function write_to_console($data) {

$console = 'console.log(' . json_encode($data) . ');';
$console = sprintf('<script>%s</script>', $console);
echo $console;
}
write_to_console($su_log_book_records);

@endphp


<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
 
.label-danger.add-new-comment {
 background:#1fb5ad;   
} 

.btn.btn-primary {
  background:#1fb5ad; 
  border:#1fb5ad;    
}

.span.glyphicon.glyphicon-calendar {
 background:#1fb5ad;    
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
                                <div class="col-lg-4">
                                    <div id="editable-sample_length" class="dataTables_length">
                                        <form method='post' action="{{ url('admin/service-user/logbooks/'.$service_user_id) }}" id="records_per_page_form">
                                            <label>
                                                <select name="limit" size="1" aria-controls="editable-sample" class="form-control xsmall select_limit">
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

                                <div class="col-lg-4">
                                    <!-- <a href="{{ url('/admin/service-user/logbook/download?end=2021-12-16&start=2021-12-14&format=pdf&service_user_id='.$service_user_id) }}" target="_blank" class="btn label-danger add-new-comment active" style="color:white;" onclick="pdf()">Download Pdf</a>
                                    <a href="{{ url('/admin/service-user/logbook/download?end=2021-12-16&start=2021-12-14&format=csv&service_user_id='.$service_user_id) }}" target="_blank" class="btn label-danger add-new-comment active" style="color:white;" onclick="csv()">Download Csv</a> -->
                                  <div class="pdf-csv-file-export-main-area">  
                                    <a id='pdf' target="_blank" class="btn label-danger add-new-comment active" style="color:white;" onclick="pdf()">PDF Export</a>
                                    <a id='csv' target="_blank" class="btn label-danger add-new-comment active" style="color:white;" onclick="csv()">CSV Export</a>
                                  </div>   
                                </div>
                                <div class="col-lg-4">
                                    <form method='get' action="{{ url('admin/service-user/logbooks/'.$service_user_id) }}" id="form1">
                                        <div class="dataTables_filter" id="editable-sample_filter">
                                            <label>Search: <input name="search" type="text" value="{{ $date_value }}" aria-controls="editable-sample" class="form-control medium" placeholder="Search by title"></label>
                                            <!-- <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>   -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <!-- <form role="form" method="get" action="{{ url('admin/service-user/logbooks/'.$service_user_id) }}" id="form2"> -->
                                    
                                <div class="col-md-12" style="margin-bottom:30px;">
                                 <div class="row">   
                                    <label class="col-md-3">Start Date: <input name="datePicker" class="form-control" id="datepicker1" value="{{$date_value}}" readonly disabled > </label>
                                    <label class="col-md-3">End Date: <input name="datePicker2" class="form-control" id="datepicker2" value="{{$date_value}}" readonly disabled > </label>
                                    <div class="col-md-2">
                                     <button id="submit_button" class="btn btn-primary" style="margin-top:19px;" form="form2">Submit</button>
                                    </div>
                                        <label class="col-md-4">
                                        Category:
                                            <div class="form-select-lg">
                                                <select class="form-control sel_design_layout" style="min-width:200px;" id="select_category" name="category" required/>
                                                    <option disabled selected value> -- select an option -- </option>
                                                    @foreach ($categorys as $key )
                                                    <option value="{{$key['id']}}">{{ $key['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </label>   
                                    </div>
                                </div>
                                    
                                <!-- </form> -->
                            </div>



                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Staff Name</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($su_log_book_records->isEmpty()) {
                                            echo '<tr style="text-align:center">
                                                <td colspan="4">No record found.</td>
                                              </tr>';
                                        } else {
                                            foreach ($su_log_book_records as $key => $su_log_book_record) {
                                        ?>
                                                <tr>
                                                    <td>{{ date('d F Y', strtotime($su_log_book_record['created_at'])) }}</td>
                                                    <td>{{ ucfirst($su_log_book_record['staff_name']) }}</td>
                                                    <td>{{ $su_log_book_record['title'] }}</td>
                                                    <td>{{ $su_log_book_record['category_name'] or 'N/A' }}</td>
                                                    <td class="action-icn">
                                                        <a href="{{ url('admin/service-user/logbook/view/'.$su_log_book_record->id) }}"><i data-toggle="tooltip" title="View!" class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                            @if($su_log_book_records->links() !== null)
                            {{ $su_log_book_records->appends(request()->query())->links() }}
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

<!-- DatePicker Initalization -->
<script>
    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap',
        format: 'dd-mm-yyyy'
    });

    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap',
        format: 'dd-mm-yyyy'
    });

</script>

<script>
    $('select').on('change', function() {
        let category_id = $(this).val();
        let dataParams=getUrlVars();
        let paramObj = {};
        if(dataParams.start_date)
        {
            paramObj['start_date'] = dataParams.start_date;
        }
        if(dataParams.end_date)
        {
            paramObj['end_date'] = dataParams.end_date;
        }
        paramObj['category_id'] = category_id;
        window.location.href = window.location.pathname+"?"+$.param(paramObj);
});
</script>



<!-- DateField Filter Logs -->
<script>
    $("#submit_button").click(function(){
        newFormat = get_dates()[0];
        newFormat2 = get_dates()[1];
        let categoy_id=$("#select_category").val();

        if(newFormat && newFormat2)
        {
            let paramObj = {'start_date':newFormat, 'end_date':newFormat2};
            if(categoy_id)
            {
                paramObj['category_id'] = categoy_id;
            }
            window.location.href = window.location.pathname+"?"+$.param(paramObj);
        }
            
        else if(newFormat)
        {
            let paramObj = {'start_date':newFormat};
            if(categoy_id)
            {
                paramObj['category_id'] = categoy_id;
            }
            window.location.href = window.location.pathname+"?"+$.param(paramObj);
        }
            
        else if(newFormat2)
        {
            let paramObj = {'end_date':newFormat2};
            if(categoy_id)
            {
                paramObj['category_id'] = categoy_id;
            }
            window.location.href = window.location.pathname+"?"+$.param(paramObj);
        }
        else{

        }
            

    });

</script>


<!-- PDF AND CSV Function -->

<script>
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    $( document ).ready(function() {
        let dateParams=getUrlVars();
        if(dateParams.start_date) {
            var d = new Date(dateParams.start_date);
            var newFormat =  ("0" + d.getDate()).slice(-2)+ "-" + ("0"+(d.getMonth()+1)).slice(-2) +'-'+d.getFullYear();
            $('#datepicker1').val(newFormat);
        }
        if(dateParams.end_date) {
            var d = new Date(dateParams.end_date);
            var newFormat =  ("0" + d.getDate()).slice(-2)+ "-" + ("0"+(d.getMonth()+1)).slice(-2) +'-'+d.getFullYear();
            $('#datepicker2').val(newFormat);
        }
        if(dateParams.category_id) {
            $('select').val(dateParams.category_id);
        }
    });
    function get_dates()
    {
        var selected_category = $("#select_category").val();
        var start_date = $("#datepicker1").val();
        if(start_date == '')
        {
            newFormat = null;
        }
        else{
            var start_date_str = start_date.split("-");
            var d = new Date(start_date_str[2], start_date_str[1]-1, start_date_str[0]);
            var newFormat = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2);
        }
        

        var end_date = $("#datepicker2").val();

        if(end_date == '')
        {
            newFormat2 = null;
        }
        else{
            var end_date_str = end_date.split("-");
            var d1 = new Date(end_date_str[2], end_date_str[1]-1, end_date_str[0]);
            var newFormat2 = d1.getFullYear() + "-" + ("0"+(d1.getMonth()+1)).slice(-2) + "-" + ("0" + d1.getDate()).slice(-2);
        }

        if(d > d1 && end_date != '')
        {
            newFormat = newFormat2;
        }

        if(selected_category && start_date == '' && end_date == '')
        {
            newFormat = null;
        }
        else if(start_date == '' && end_date == '')
        {
            var d2 = new Date();
            newFormat = d2.getFullYear() + "-" + ("0"+(d2.getMonth()+1)).slice(-2) + "-" + ("0" + d2.getDate()).slice(-2);
        }
        else{

        }

        return [newFormat, newFormat2, selected_category];
    }
function pdf()
    {
        var start = get_dates()[0];
        var end = get_dates()[1];
        var category_id = parseInt(get_dates()[2]);
        var link = document.getElementById("pdf");
        let url=`{{ url('/admin/service-user/logbook/download?end=${end}&start=${start}&category_id=${category_id}&format=pdf&service_user_id='.$service_user_id) }}`;
        url=url.replaceAll('&amp;','&')
        link.setAttribute("href", url);
        return false;

    }

function csv()
    {
        var start = get_dates()[0];
        var end = get_dates()[1];
        var link = document.getElementById("csv");
        let url=`{{ url('/admin/service-user/logbook/download?end=${end}&start=${start}&format=csv&service_user_id='.$service_user_id) }}`;
        url=url.replaceAll('&amp;','&')
        link.setAttribute("href", url);
        return false;

    }
</script>

@endsection