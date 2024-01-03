<style>
.srch_bar{
  width: 400px; height: 20px;
  padding: 10px;
  float: left;
  width: 50%;
}
.add_job_btn{
  background-color: #1f88b5;
  padding: 5px 1px;
  color: #fff;
  border-radius: 5px;
  font-size: 15px;
  width: 100px;
  float: left;
  margin-top: 7px;
  text-align: center;
}
.view_btns{
  float: left;
  width: 33%;
  margin-top: 12px;
}
.icon_n_ttle{
  width: 36%;
}
.rec_icon{
  float: left;
  width: 3.5%;
  padding-top: 15px;
}
.rec_pge_ttle{
  float: left;
  width: 90%;
}
</style>
@include('rotaStaff.components.header')
<head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> </head>
<body>
  <div class = "icon_n_ttle">
      <div class = "rec_icon">
        <i class = "fa fa-users fa-lg"></i>
      </div>
      <div class = "rec_pge_ttle">
        <h1>Jobs</h1>
      </div>
  </div>
<ul class="nav nav-tabs rotas" id="myTab" role="tablist"> 
  <li class="nav-item" role="presentation">
    <a href = "{{ url('/recruitment') }}"> <button class="nav-link" id="activerotas-tab" data-bs-toggle="tab"
    data-bs-target="#activerotas" type="button" role="tab" aria-controls="activerotas"
    aria-selected="true">My Recruitment</button></a>
  </li>
  <li class="nav-item" role="presentation">
    <a href = "{{ url('/jobs') }}"> <button class="nav-link" id="oldrotas-tab" data-bs-toggle="tab" data-bs-target="#oldrotas"
    type="button" role="tab" aria-controls="oldrotas" aria-selected="false">Jobs</button></a>
  </li>
  <li class="nav-item" role="presentation">
    <a href = "{{ url('/permissions') }}"> <button class="nav-link" id="createrota-tab" data-bs-toggle="tab" data-bs-target="#createrota"
    type="button" role="tab" aria-controls="createrota" aria-selected="false">Permissions</button></a>
  </li>
</ul>

<div>
  <div class = "srch_bar" >
    <input type = "text" value placeholder = "Search vacant jobs." class="srch_bar">
  </div>
  <div class = "view_btns">
    <input type="radio" id="show_flled_jobs>" name="drone" value="show_flled_jobs" checked />
    <label for="huey">Show filled jobs</label> &nbsp&nbsp&nbsp
    <i class = "fa fa-table-cells"></i> <a href="{{ url('/123') }}">Grid View &nbsp&nbsp&nbsp</a>
    <i class = "fa list-ul"></i> <a href="{{ url('/123') }}">List View</a>
  </div>
  <div class="add_job_btn">
    <a href="{{ url('/create-jobs') }}"> Add job</a>
  </div>
</div>
</body>