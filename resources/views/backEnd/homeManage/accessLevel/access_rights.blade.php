@extends('backEnd.layouts.master')
@section('title',' Access Level Rights')
@section('content')
	
 <!--main content start-->
<section id="main-content" class="">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        {{ $access_level_right->name }} - access rights
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" action="{{ url('admin/home/access-level/rights/update') }}" method="post">
                                @include('backEnd/common/access_rights_list')
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="access_level_id" value="{{ $access_level_right->id }}">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ url('admin/home/access-levels') }}">
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $('.acc_heading_chkbox').click(function(){
        
        if($(this).is(':checked')) { 
            $(this).parent().siblings('ul').find('input').prop('checked',true);
        } else { 
            $(this).parent().siblings('ul').find('input').prop('checked',false);
        }
    });
});
</script>
@endsection