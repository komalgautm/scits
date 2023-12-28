@include('rotaStaff.components.header')
<style>
.cntnt_box{
  margin-top: 25px;
  padding-top: 15px;
  border-style: solid;
  border-color: #3DB0F7;
  border-width: 2px;
  border-radius: 5px;
}
.lft_cntnt_box{
  border-style: solid;
  border-color: #3db0f7;
  border-width: 1px;
  float: left;
  width: 67%;
  border-radius: 5px;
}
.rght_cntnt_box{
  float: left;
  width: 33%;
  text-align: centre;
}
.top_lft_blck{
  background: rgb(61, 176, 241);
  width: 100%;
  height: 300px;
  border-radius: 5px;
}
.top_lft_btn_prnt {
  display: flex;
  width: 240px;
  margin-top: 120px;
  margin-left: 15px;
}
.top_lft_btn_chld {
  background: #1f88b5;
  padding: 5px 1px;
  color: #fff;
  border-radius: 5px;
  font-size: 15px;
  flex: 1;
  margin: 4px;
  margin-top:30px;
  text-align: center;
}
.recruitmnt_img{
  text-align: center;
  margin-top: 4px;
}
.job_vcncy_nmbrs{
  float: left;
  width: 25%;
  margin-top: 77px;
  margin-left: 8px;
}
.circ{
  float: left;
  width: 25%;
  position: relative;
}
.circ_n_txt_prnt{
  width: 100%;
  height: 25%;
}
.indiv_circs_1 {
  float: left;
  height: 25px;
  width: 25px;
  background: white;
  border-radius: 50%;
  display: inline-block;
}
.indiv_circs_2 {
  float: left;
  height: 25px;
  width: 25px;
  background: #3DCC85;
  border-radius: 50%;
  display: inline-block;
}
.b_points {
  float: left;
  margin-top: 77px;
}
ul {
  list-style-type: none;
}
.circ_txt{
  position:absolute;
  margin-left: 97px;
  margin-top: 87px;
}
.icon_n_ttle{
  width: 36%;
}
.rec_icon{
  float: left;
  width: 10%;
  padding-top: 15px;
}
.rec_icon{
  float: left;
  width: 10%;
  padding-top: 15px;
}
.rcruitmnt_docs{
  margin-left: 8px;
  margin-top: 3px;
}
.rght_cntnt_bx_txt{
  margin-left: 8px;
  margin-top: 12px;
}
</style>

<head> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> </head>

<body>
  <div class = "icon_n_ttle">
    <div class = "rec_icon">
      <i class = "fa fa-users fa-lg"></i>
    </div>
    <div class = "rec_pge_ttle">
      <h1>Recruitment</h1>
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

<div class = "cntnt_box">
  <div class = "lft_cntnt_box">
    <div class = "top_lft_blck">
      <div class = "circ_n_txt_prnt">
        <div class = "circ">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
            <circle cx="100" cy="100" r="32" stroke="white" stroke-width="80" fill="none" />
            <circle cx="100" cy="100" r="56" stroke="#3DCC85" stroke-width="20" fill="none" />>
          </svg>
        </div>
        <div class = "circ_txt">
            1
        </div>
        <div class = "b_points">
          <ul>
            <li>
              <div class = "indiv_circs_1"></div>
            </li>
            <li>
              <div class = "indiv_circs_2"></div>
            </li>
          </ul>
        </div>
        <div class = "job_vcncy_nmbrs">
            0 unfilled jobs <br>
            1 filled job
        </div>
      </div>
      <div class= "top_lft_btn_prnt">
        <div class="top_lft_btn_chld">
          <a href="{{ url('/create-jobs') }}"> Add a new job</a>
        </div>
        <div class="top_lft_btn_chld">
          <a href="{{ url('/jobs') }}"> View all jobs</a>
        </div>
      </div>
    </div>
    <div class = "rcruitmnt_docs">
      <i class = "fa fa-file"></i> <span style = "color: rgb(0,87,173); font-weight: bold" > Job Description Template <br></span> Be confident you've included all the key information in your 
      new job description with our handy template.<br> <a href="https://pages.brighthr.com/rs/217-MIC-854/images/Job%20Description%20Template%20-%20UK.pdf"> Download
      your copy today</a><br>
      <i class = "fa fa-book"></i> <span style = "color: rgb(0,87,173); font-weight: bold" > Recruitment Interview Handbook <br></span> Need help with a recruitment interview? Use our
      handbook to guide you through the process.<br> <a href="https://pages.brighthr.com/rs/217-MIC-854/images/Your%20Complete%20Interview%20Handbook%20-%20UK.pdf">
      Download your free interview handbook</a><br>
      <i class = "fa fa-envelope"></i> <span style = "color: rgb(0,87,173); font-weight: bold"> Offer Letter <br></span> Know you're making the right first impression. Confirm your job offer in
      writing using our offer letter template. <br> <a href="https://pages.brighthr.com/rs/217-MIC-854/images/Offer%20Letter%20Template%20-%20UK.pdf"> Download your
      offer template now</a>
    </div>
  </div>

  <div class = "rght_cntnt_box">
    <div class = "recruitmnt_img">
      <img src = "public/images/recruitment_stock_image.jpg" style = "width:325px;height:290px">
    </div>
    <div class = "rght_cntnt_bx_txt">
      Get tailored recruitment advice for your business<br>
      <span style = "font-size: 22px; color: rgb(0,87,173)">0844 892 3927 </span> <br> - (select option 2)<br>
      Speak to an expert advisor about best practices for recruiting in your business. From discrimination to pre-employment checks, get advice to help you comply
      with the law.
    </div>
  </div>
</div>
</body>

<div class="circle"></div>
