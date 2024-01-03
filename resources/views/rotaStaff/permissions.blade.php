@include('rotaStaff.components.header')
<style>
.top_text{
 margin-top:15
}
.elgble_emplyees_btn{
 background: #1f88b5;
 padding: 5px 1px;
 color: #fff;
 border-radius: 5px;
 font: 15px;
 width: 240px;
 text-align: center;
 margin-top: 15px;
}
.table_text{
 font: 10
}
.tbl_val{
 position:relative;
}
.rec_perms_init_1{
  position:absolute;
  bottom: 160px;
  left: 147px;
}
.rec_perms_init_2{
  position:absolute;
  bottom: -40px;
  left: 147px;
}
.rec_perms_init_3{
  position:absolute;
  bottom: -241px;
  left: 147px;
}
.tble{
  margin-top: 15px;
}
.icon_n_ttle{
  width: 36%;
}
.rec_icon{
  float: left;
  width: 10%;
  margin-top: 15px;
}
.rec_pge_ttle{
  float: left;
  width: 90%;
}
</style>
<head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> </head>
<body>
  <div class = "icon_n_ttle">
    <div class = "rec_icon">
      <i class = "fa fa-users fa-lg"></i>
    </div>
    <div class = "rec_pge_ttle">
      <h1>Permissions</h1>
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

<div class = "top_text">
  <span style = "font-size: 22">Users with access</span> <br>
  <span style = "font-size: 16">Grant anybody in your business access to see Turbo Talent Navigator. Only Admins can grant access or view this page. Individuals
  added here will also be able to see and create new jobs.</span>
</div>

<div class="elgble_emplyees_btn">
  <a href="{{ url('/123') }}"> Select eligible employees</a>
</div>

<div class = "tble">
<table style = font-size:14;>
  <tr> <td>User</td> <td>Role</td> </tr>
  <tr> <td>
  <div class = "tbl_val">
    <svg width = "100" height = "120" xmlns="http://www.w3.org/2000/svg" version="1.1"><circle cx="33" cy="75" r="15" stroke="rgb(31 136 181)" stroke-width="30" fill="none"></svg>
  </div>
  <div class = "rec_perms_init_1">
    CB
  </div>
    <p>Craig Birch</p> service manager</p> 
    <td>Admin</td> </tr>
    <tr> <td>
  <div class = "tbl_val">
    <svg width = "100" height = "120" xmlns="http://www.w3.org/2000/svg" version="1.1"><circle cx="33" cy="75" r="15" stroke="rgb(31 136 181)" stroke-width="30" fill="none"></svg>
  </div>
  <div class = "rec_perms_init_2">
    MC
  </div>
    <p>Michael Carter</p> Director & Development manager</p>
    <td>Admin</td> </tr>
  <tr> <td>
  <div class = "tbl_val">
    <svg width = "100" height = "120" xmlns="http://www.w3.org/2000/svg" version="1.1"><circle cx="33" cy="75" r="15" stroke="rgb(31 136 181)" stroke-width="30" fill="none"></svg>
  </div>
  <div class = "rec_perms_init_3">
    TC
  </div>
    <p>Tommy Cashen</p> Director and founder</p><td>Admin</td> </tr>
 </div>
</table> 
</div>
</body>