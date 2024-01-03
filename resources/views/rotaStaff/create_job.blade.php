@include('rotaStaff.components.header')
<style>
.cntnt{
  width: 100%;
  }
.lft_main_cntnt{
  float: left;
  width: 66%;
}
.rght_cntnt_box{
  float: left;
  width: 33%;
  text-align: centre;
}
.icon_n_ttle{
  width: 36%;
}
.rec_icon{
  float: left;
  width: 10%;
  padding-top: 15px;
}
.jb_ttle{
  width: 91%;
  margin-top: 5px;
}
.jb_ttle_inp{
  margin-top: 5px;
  width: 91%;
}
.jb_desc{
  margin-top: 15px;
  width: 95.5%;
}
.jb_desc_inp{
  margin-top: 5px;
  width: 95.5%;  
}
.rptble_flt_prnt_fld{
  margin-top: 12px;
  float: left;
  width: 100%;
}
.rptble_prnt_fld{
  width: 100%;
}
.rptble_txt_fld{
  margin-top: 12px;
  float: left;
  width: 50%
}
.cncl_btn{
  background: rgb(61,176,241);
  width: 12%;
  height: 20px;
  float: left;
  margin-top: 35px;
  margin-right: 12px;
  text-align: center;
  border-radius: 5px;
  height: 30px;
  padding-top: 2px;
  margin-bottom: 8px;
}
.sv_btn{
  background: rgb(61,176,241);
  width: 12%;
  height: 20px;
  float: left;
  margin-top: 35px;
  text-align: center;
  border-radius: 5px;
  height: 30px;
  padding-top: 2px;
  margin-bottom: 8px;
}
</style>
<body>
  <div class = "cntnt">
    <div class = "icon_n_ttle">
      <div class = "rec_icon">
        <i class = "fa fa-users fa-lg"></i>
      </div>
      <div class = "rec_pge_ttle">
        <h1>Recruitment</h1>
      </div>
    </div>
    <h2> Add job </h2>
    <div class = "lft_main_cntnt">
      <div class = "jb_ttle">
        Job title</br>
        <input type = "text" class = "jb_ttle_inp">
      </div>
      <div class = "jb_desc">
        Job description
        <textarea class = "jb_desc_inp">
        </textarea></br>
      </div>
      <div class = "rptble_flt_prnt_fld">
        Contract type</br>
        <select>
          <option value = "Full-Time">Full-Time</option>
          <option value = "Part-Time">Part-Time</option>
          <option value = "Fixed-Term">Fixed-Term</option>
          <option value = "Casual">Casual</option>
          <option value = "Voluntary">Voluntary</option>
          <option value = "Freelance">Freelance</option>
          <option value = "Temporary">Temporary</option>
        </select>
      </div>
      <div class = "rptble_flt_prnt_fld">
        Experience in years</br>
        <input type = "text">
      </div>
      <div class = "rptble_prnt_fld">
        <div class = "rptble_txt_fld">
          Show pay by</br>
          <select>
            <option value = "Exact">Exact</option>
            <option value = "Range">Range </option>
            <option value = "Not specified">Not specified </option>
          </select>
        </div>
        <div class = "rptble_txt_fld">
          Currency</br>
          <select>
            <option value = "GBP">GBP</option>
            <option value = "EUR">EUR</option>
            <option value = "CAD">CAD</option>
            <option value = "NZD">NZD</option>
            <option value = "AUD">AUD</option>
          </select>
        </div>
      </div>
      <div class = "amnt_n_rate">
        <div class = "rptble_txt_fld">
          Amount</br>
          <input type = "text">
        </div>
        <div class = "rptble_txt_fld">
          Rate</br>
          <select>
            <option value = "Hourly">Hourly</option>
            <option value = "Daily">Daily</option>
            <option value = "Annually">Annually</option>
          </select>
        </div>
      </div>
      <div class="cncl_btn">
        <a href="{{ url('/recruitment') }}"> Cancel</a>
      </div>
      <div class ="sv_btn">
        <a href="{{ url('/recruitment') }}"> Save</a>
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

