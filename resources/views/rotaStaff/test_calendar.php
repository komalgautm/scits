@include('rotaStaff.components.header')
             <style>
     / Dropdown Button /
  .dropbtn {
    /* background-color: #3498DB;
    color: white;
    padding: 16px; */
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  / The container <div> - needed to position the dropdown content /
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  / Dropdown Content (Hidden by Default) /
  .dropdown-content {
    display: none;
    position: absolute;
    right: 0px;
    background-color: #f1f1f1;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  /* Links inside the dropdown */
  .dropdown-content a,
  .dropdown-content button {
    color: #1f88b5;
    padding: 5px 12px;
    text-decoration: none;
    display: inline-block;
    font-size: 15px;
    outline: none;
    border: none;
    font-weight: 500;
  }
  
  .dropdown-content ul {
    list-style-type: none;
    padding-left: 0px;
    margin-bottom: 0rem;
  } 
  
  .dropdown-content .dropdown_icon {
    fill:#106e97cf;
    font-size: 20px;
    margin-right: 10px;
  }
  
  .dropdown-content ul li {
    padding: .50rem .50rem .50rem 1rem;
    transition: all 0.3s ease-in-out;
  }
  
  .dropdown-content ul li .delete-icon {
    fill: #990000;
  }
  
  .dropdown-content ul li:last-child .delete_btn {
    fill: #990000;
  }
  
  .dropdown-content ul li:last-child:hover {
    background-color: #99000024;
  }
  
  .dropdown-content ul li:hover {
    background-color: #1f88b514;
  }
  
  .dropdown-content ul li a {
    cursor: pointer;
  }
  
  .form-control {
    border: 2px solid #a1a9b3;
  }
  
  .form-control:focus {
    border: 2px solid #1f88b5;
    box-shadow: rgb(0 0 0 / 25%) 0px 2px 8px;
  }
  
  .modal-header{
    background-color: #1f88b5;
    color: #fff;
  }
  
  .modal-dialog .close_btn_modal {
    border: none;
    outline: none;
    background-color: inherit;
    color: #e10078;
    border: 2px solid #e10078;
    padding: 5px 16px;
    border-radius: 5px;
    font-weight: 600;
    transition: all 0.3s ease-in-out;
  }
  
  .modal-dialog .close_btn_modal:hover {
    background-color: #ad005c;
    color: #fff;
    border: 2px solid #ad005c;
  }
  
  .modal-dialog .save_btn_modal {
    border: none;
      outline: none;
      padding: 8px 20px;
      background-color: #e10078;
      color: #fff;
      border-radius: 5px;
      font-weight: 600;
      transition: all 0.3s ease-in-out;
  }
  
  .modal-dialog .save_btn_modal:hover {
    background-color: #ad005c;
    border-color: #ad005c;
  }
  
  .modal-header .modal_close_btn {
      color: #fff;
      border: none;
      outline: none;
      background-color: inherit;
      font-size: 22px;
  }
  
  .active-rots-slt-from h4 {
    margin-top: 0px;
  }
  </style>
              <!-- Top Bar Info Section End Here -->  
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-lg-12">
                    <ul class="nav nav-tabs rotas" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="activerotas-tab" data-bs-toggle="tab"
                          data-bs-target="#activerotas" type="button" role="tab" aria-controls="activerotas"
                          aria-selected="true">Active Rotas</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="oldrotas-tab" data-bs-toggle="tab" data-bs-target="#oldrotas"
                          type="button" role="tab" aria-controls="oldrotas" aria-selected="false">Old Rotas</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="createrota-tab" data-bs-toggle="tab" data-bs-target="#createrota"
                          type="button" role="tab" aria-controls="createrota" aria-selected="false">Create rota </button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="activerotas" role="tabpanel"
                        aria-labelledby="activerotas-tab">
                        <form class="active-rots-slt-from">
                          <div class="row">
                            <div class="col-lg-9">
                              <h3>Active rotas</h3>
                            </div>
                            <div class="col-lg-4 col-md-4">
                              <input type="date" placeholder="Select range..." class="form-control">
                            </div>
                            <div class="col-lg-3 col-md-3">
                              <input type="text" class="form-control form-select" placeholder="Rota name...">
                            </div>
                          </div>
                        </form>
                        <div class="col-md-12 my-5 publish_rota_content">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                              <h4>Published rotas</h4>
                              <span class="no_of_rota_publish">1</span>
                            </div>
                            <div class="toggle_btns">
                              <button class="view_all_btn" onclick="showRotaPublish()" id="viewPublish">View all</button>
                              <button class="show_less_btn" onclick="lessRotaPublish()" id="lessPublish">Show less</button>
                            </div>
                          </div>
                          <div class="content_about_publish" id="beforePublishRota">
                            <h5>In progress</h5>
                                                                                        <div class="parent_div my-2">
                                  <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                      <div>Sun </div>
                                      <div class="">19th Feb</div>
                                    </div>
                                    <div class="col-md-10 px-2">
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                          <a href="http://127.0.0.1:8000/edit_rota/116" class="rota_shift_employee_name">Rota 1</a>
                                        </div>
                                        <div class="dropdown">
                                          <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="dropbtn">
                                              <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                                <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                                <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                              </svg>
                                            </span>
                                          </button>
                                          <div class="dropdown-menu dropdown-content">
                                            <ul>
                                                <li>
                                                    <span class="edit-icon dropdown_icon">
                                                        <svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="fill-primary-400 group-active/listitem:fill-white group-disabled/listitem:fill-link-disabled"><path d="M28 9.5C28 6.487 25.512 4 22.5 4C21.038 4 19.637 4.575 18.613 5.612L5.463 18.762C4.513 19.712 4 20.962 4 22.3V27C4 27.55 4.45 28 5 28H9.713C11.051 28 12.301 27.475 13.25 26.538L26.4 13.388C27.425 12.363 28 10.963 28 9.5ZM11.825 25.125C11.262 25.688 10.5 26 9.7 26H6V22.288C6 21.488 6.313 20.738 6.875 20.163L16.813 10.225L21.763 15.175L11.825 25.125ZM24.975 11.975L23.187 13.762L18.237 8.812L20.025 7.025C20.675 6.375 21.575 6 22.5 6C24.425 6 26 7.575 26 9.5C26 10.425 25.625 11.325 24.975 11.975Z"></path></svg>
                                                    </span>
                                                  <a href="http://127.0.0.1:8000/edit_rota/116">Edit</a>
                                                </li>
                                                <li>  
                                                  <span class="i-icon dropdown_icon"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="fill-primary-400 group-active/listitem:fill-white group-disabled/listitem:fill-link-disabled"><path d="M16 30C8.275 30 2 23.725 2 16C2 8.275 8.275 2 16 2C23.725 2 30 8.275 30 16C30 23.725 23.725 30 16 30ZM16 4C9.387 4 4 9.387 4 16C4 22.613 9.387 28 16 28C22.613 28 28 22.613 28 16C28 9.387 22.613 4 16 4Z"></path><path d="M19 22H17V13C17 12.45 16.55 12 16 12H13C12.45 12 12 12.45 12 13C12 13.55 12.45 14 13 14H15V22H13C12.45 22 12 22.45 12 23C12 23.55 12.45 24 13 24H19C19.55 24 20 23.55 20 23C20 22.45 19.55 22 19 22Z"></path><path d="M17 9C17 9.552 16.552 10 16 10C15.448 10 15 9.552 15 9C15 8.448 15.448 8 16 8C16.552 8 17 8.448 17 9Z"></path></svg></span>
                                                  <a onclick="RotaView(116,'Rota 1')">View</a>
                                                </li>
                                                <li>
                                                  <span class="edit-icon dropdown_icon"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="fill-primary-400 group-active/listitem:fill-white group-disabled/listitem:fill-link-disabled"><path d="M28 9.5C28 6.487 25.512 4 22.5 4C21.038 4 19.637 4.575 18.613 5.612L5.463 18.762C4.513 19.712 4 20.962 4 22.3V27C4 27.55 4.45 28 5 28H9.713C11.051 28 12.301 27.475 13.25 26.538L26.4 13.388C27.425 12.363 28 10.963 28 9.5ZM11.825 25.125C11.262 25.688 10.5 26 9.7 26H6V22.288C6 21.488 6.313 20.738 6.875 20.163L16.813 10.225L21.763 15.175L11.825 25.125ZM24.975 11.975L23.187 13.762L18.237 8.812L20.025 7.025C20.675 6.375 21.575 6 22.5 6C24.425 6 26 7.575 26 9.5C26 10.425 25.625 11.325 24.975 11.975Z"></path></svg></span>
                                                  <a onclick="renamedata(116,'Rota 1')">Rename</a> 
                                                </li>
                                                <li>
                                                  <span class="tick-icon dropdown_icon"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="fill-primary-400 group-active/listitem:fill-white group-disabled/listitem:fill-link-disabled"><path d="M17 20H15C14.448 20 14 20.448 14 21C14 21.552 14.448 22 15 22H17C17.552 22 18 21.552 18 21C18 20.448 17.552 20 17 20Z"></path><path d="M11 20H9C8.448 20 8 20.448 8 21C8 21.552 8.448 22 9 22H11C11.552 22 12 21.552 12 21C12 20.448 11.552 20 11 20Z"></path><path d="M23 16H21C20.448 16 20 16.448 20 17C20 17.552 20.448 18 21 18H23C23.552 18 24 17.552 24 17C24 16.448 23.552 16 23 16Z"></path><path d="M17 16H15C14.448 16 14 16.448 14 17C14 17.552 14.448 18 15 18H17C17.552 18 18 17.552 18 17C18 16.448 17.552 16 17 16Z"></path><path d="M11 16H9C8.448 16 8 16.448 8 17C8 17.552 8.448 18 9 18H11C11.552 18 12 17.552 12 17C12 16.448 11.552 16 11 16Z"></path><path d="M23 6H22V5C22 4.448 21.552 4 21 4C20.448 4 20 4.448 20 5V6H12V5C12 4.448 11.552 4 11 4C10.448 4 10 4.448 10 5V6H9C6.243 6 4 8.243 4 11V23C4 25.757 6.243 28 9 28H23C25.757 28 28 25.757 28 23V11C28 8.243 25.757 6 23 6ZM26 23C26 24.654 24.654 26 23 26H9C7.346 26 6 24.654 6 23V11C6 9.346 7.346 8 9 8H10V9C10 9.552 10.448 10 11 10C11.552 10 12 9.552 12 9V8H20V9C20 9.552 20.448 10 21 10C21.552 10 22 9.552 22 9V8H23C24.654 8 26 9.346 26 11V23Z"></path></svg></span>
                                                  <a onclick="unpublishRotaEmployee(116,'Rota 1')">Unpublish</a>
                                                </li>
                                                <li>
                                                  <span class="delete-icon dropdown_icon"><svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="fill-error-700 group-hover/listitem:fill-error-800 group-active/listitem:fill-white group-disabled/listitem:fill-link-disabled"><path d="M27 8H22V7C22 4.243 19.757 2 17 2H15C12.243 2 10 4.243 10 7V8H5C4.448 8 4 8.448 4 9C4 9.552 4.448 10 5 10H6V25C6 27.757 8.243 30 11 30H21C23.757 30 26 27.757 26 25V10H27C27.552 10 28 9.552 28 9C28 8.448 27.552 8 27 8ZM12 7C12 5.346 13.346 4 15 4H17C18.654 4 20 5.346 20 7V8H12V7ZM24 25C24 26.654 22.654 28 21 28H11C9.346 28 8 26.654 8 25V10H24V25Z"></path><path d="M19 14C18.448 14 18 14.448 18 15V23C18 23.552 18.448 24 19 24C19.552 24 20 23.552 20 23V15C20 14.448 19.552 14 19 14Z"></path><path d="M13 14C12.448 14 12 14.448 12 15V23C12 23.552 12.448 24 13 24C13.552 24 14 23.552 14 23V15C14 14.448 13.552 14 13 14Z"></path></svg></span>
                                                  <a onclick="DeleteRotaEmployee(116,'Rota 1')" class="delete_btn">Delete</a>
                                                </li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="d-flex">
                                        <div class="pe-3">Total:  17 hrs 58 mins (Incl. breaks)</div>
                                        <div class="order-1">7 days<span class="px-2"></span><span>
                                          12 employees</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <p class="pb-8">Rotas that are currently active and in progress will appear here.</p>
                            <h5>Future rotas</h5>
                            <p class="pb-8">Rotas that are starting in the future will appear here.</p>
                          </div>
                        </div>
                        <div class="col-md-12 unpublish_rota_content">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                              <h4>Unpublished rotas</h4>
                              <span class="no_of_rota_publish">19</span>
                            </div>
                            <div class="toggle_btns">
                              <button class="view_all_btn" onclick="unPublishview()" id="viewUnpublish">View all</button>
                              <button class="show_less_btn" onclick="unPublishless()" id="lessUnpublish">Show less</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-lg-12" id="unpublish_rota_content_detail">
                                                                                                                            <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">12th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/117" class="rota_shift_employee_name">Week 2</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/117">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(117,'Week 2')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(117,'Week 2')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(117,'Week 2')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(117,'Week 2')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">7 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">12th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/118" class="rota_shift_employee_name">Week 2</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/118">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(118,'Week 2')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(118,'Week 2')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(118,'Week 2')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(118,'Week 2')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">7 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">12th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/119" class="rota_shift_employee_name">Week 2</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/119">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(119,'Week 2')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(119,'Week 2')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(119,'Week 2')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(119,'Week 2')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    9 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">7 days<span class="px-2"></span><span>5 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/120" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/120">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(120,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(120,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(120,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(120,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/121" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/121">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(121,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(121,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(121,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(121,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/122" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/122">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(122,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(122,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(122,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(122,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/123" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/123">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(123,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(123,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(123,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(123,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/125" class="rota_shift_employee_name">Rota 3</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/125">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(125,'Rota 3')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(125,'Rota 3')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(125,'Rota 3')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(125,'Rota 3')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">12th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/126" class="rota_shift_employee_name">Rota 7</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/126">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(126,'Rota 7')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(126,'Rota 7')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(126,'Rota 7')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(126,'Rota 7')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/127" class="rota_shift_employee_name">Rota 8</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/127">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(127,'Rota 8')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(127,'Rota 8')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(127,'Rota 8')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(127,'Rota 8')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/128" class="rota_shift_employee_name">Rota 8</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/128">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(128,'Rota 8')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(128,'Rota 8')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(128,'Rota 8')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(128,'Rota 8')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/129" class="rota_shift_employee_name">Rota 2</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/129">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(129,'Rota 2')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(129,'Rota 2')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(129,'Rota 2')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(129,'Rota 2')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/130" class="rota_shift_employee_name">Rota 2</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/130">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(130,'Rota 2')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(130,'Rota 2')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(130,'Rota 2')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(130,'Rota 2')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/131" class="rota_shift_employee_name">Rota 5</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/131">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(131,'Rota 5')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(131,'Rota 5')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(131,'Rota 5')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(131,'Rota 5')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Mon </div>
                                  <div class="">27th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/135" class="rota_shift_employee_name">Shift 4</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/135">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(135,'Shift 4')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(135,'Shift 4')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(135,'Shift 4')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(135,'Shift 4')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">26th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/136" class="rota_shift_employee_name">Rota 89</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/136">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(136,'Rota 89')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(136,'Rota 89')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(136,'Rota 89')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(136,'Rota 89')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    8 hrs 59 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>6 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/137" class="rota_shift_employee_name">Rota 5</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/137">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(137,'Rota 5')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(137,'Rota 5')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(137,'Rota 5')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(137,'Rota 5')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    0 hrs 00 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>0 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/138" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/138">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(138,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(138,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(138,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(138,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    8 hrs 59 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>24 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                                                    <div class="parent_div my-2">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column align-items-center justify-content-center col-md-2 date_of_shift_rota">
                                  <div>Sun </div>
                                  <div class="">19th Feb</div>
                                </div>
                                <div class="col-md-10 px-2">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                      <a href="http://127.0.0.1:8000/edit_rota/139" class="rota_shift_employee_name">Shift 1</a>
                                    </div>
                                    <div class="dropdown">
                                      <button class=" my-2 d-flex justify-content-center align-items-center three_dot_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="dropbtn">
                                          <svg width="32" class="dropbtn" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="">
                                            <circle cx="16" class="dropbtn" cy="24" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="16" r="2"></circle>
                                            <circle cx="16" class="dropbtn" cy="8" r="2"></circle>
                                          </svg>
                                        </span>
                                      </button>
                                      <div class="dropdown-menu dropdown-content">
                                        <ul>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a href="http://127.0.0.1:8000/edit_rota/139">Edit</a>
                                            </li>
                                            <li>  
                                              <span class="i-icon dropdown_icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                              <a onclick="RotaView(139,'Shift 1')">View</a>
                                            </li>
                                            <li>
                                              <span class="edit-icon dropdown_icon"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                              <a onclick="renamedata(139,'Shift 1')">Rename</a> 
                                            </li>
                                            <li>
                                              <span class="tick-icon dropdown_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                              <a onclick="publishRotaEmployee(139,'Shift 1')">Publish</a>
                                            </li>
                                            <li>
                                              <span class="delete-icon dropdown_icon"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                              <a onclick="DeleteRotaEmployee(139,'Shift 1')" class="delete_btn">Delete</a>
                                            </li>
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="d-flex">
                                    <div class="pe-3">Total:
                                    8 hrs 45 mins (Incl. breaks)</div>
                                    <div class="order-1">4 days<span class="px-2"></span><span>120 employees</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                                                                    </div>
                        <div class="col-lg-12">
                          <div class="no-rate-see">
                            <h2>No rotas to see here yet...</h2>
                          </div>
                        </div>
                        <div class="box-shod-info-part">
                          <div class="row">
                            <div class="cl-lg-2 col-md-2 col-sm-2">
                              <div class="icon_info-part"> <i class="fa fa-calendar-check-o"></i> </div>
                            </div>
                            <div class="cl-lg-10 col-md-10 col-sm-9">
                              <div class="content-active-tabsinfo">
                                <h2>Create & manage</h2>
                                <p>Create, plan and manage rotas all in one place. Add multiple staff to shifts, edit
                                  ongoing shifts and get an up-to-date view of who's working when. </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="box-shod-info-part">
                          <div class="row">
                            <div class="cl-lg-10 col-md-10 col-sm-9">
                              <div class="content-active-tabsinfo">
                                <h2>Share with employees
                                </h2>
                                <p>Create, plan and manage rotas all in one place. Add multiple staff to shifts, edit
                                  ongoing shifts and get an up-to-date view of who's working when. </p>
                              </div>
                            </div>
                            <div class="cl-lg-2 col-md-2 col-sm-2">
                              <div class="icon_info-part"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                            </div>
                          </div>
                        </div>
                        <div class="box-shod-info-part">
                          <div class="row">
                            <div class="cl-lg-2 col-md-2 col-sm-2">
                              <div class="icon_info-part"> <i class="fa fa-laptop" aria-hidden="true"></i> </div>
                            </div>
                            <div class="cl-lg-10 col-md-10 col-sm-9">
                              <div class="content-active-tabsinfo">
                                <h2>Everything in one place
                                </h2>
                                <p>Create, plan and manage rotas all in one place. Add multiple staff to shifts, edit
                                  ongoing shifts and get an up-to-date view of who's working when. </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="oldrotas" role="tabpanel" aria-labelledby="oldrotas-tab">
                      <div class="row">
                        <div class="col-md-12 my-5 publish_rota_content">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                              <h4>Published rotas</h4>
                              <span class="no_of_rota_publish">0</span>
                            </div>
                            <div class="toggle_btns">
                              <button class="view_all_btn" onclick="showRotaPublish()" id="viewPublish" style="display: none;">View all</button>
                              <button class="show_less_btn" onclick="lessRotaPublish()" id="lessPublish">Show less</button>
                            </div>
                          </div>
                          <div class="content_about_publish" id="beforePublishRota">
                            <h5>In progress</h5>
                                                      </div>
                            <p class="pb-8">Rotas that are currently active and in progress will appear here.</p>
                          </div>
                        </div>       
                        <div class="col-md-12 unpublish_rota_content">
                          <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                              <h4>Unpublished rotas</h4>
                              <span class="no_of_rota_publish">0</span>
                            </div>
                            <div class="toggle_btns">
                              <button class="view_all_btn" onclick="unPublishview()" id="viewUnpublish" style="display: none;">View all</button>
                              <button class="show_less_btn" onclick="unPublishless()" id="lessUnpublish">Show less</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-lg-12" id="unpublish_rota_content_detail">
                                                </div>
                      </div>
                      <div class="tab-pane fade" id="createrota" role="tabpanel" aria-labelledby="createrota-tab">
                        <div class="row">
                          <div class="col-lg-12 create-a-rota-info">
                            <h2>Create a rota
                            </h2>
                            <p>Create and manage staggered shift patterns to support your back to work plans and manage
                              shift rotas for employees who regularly change their hours of work.
                            </p>
  
                            <h3>What would you like to do?</h3>
                          </div>
                          <div class="col-lg-4 select-rota" onclick="creatNewRota()">
                            <div class="box-createrota-boz card-btn card">
                              <input type="radio" class="radio-btn" name="select-btn">
                              <div class="bg-color">
                                <i class="fa fa-calendar"></i>
                                <h3>Create a new rota</h3>
                                <p>Create a new bespoke rota for your business. Choose your shift times, assign employees
                                  and add notes before publishing.</p>
                              </div>
                            </div>
                          </div>
                          <form action="http://127.0.0.1:8000/add-rota-data" method="POST" class="select-rota formOne" id="createRota" style="display: none;">
                          <input type="hidden" name="_token" value="HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ">
                            <div class="row">
                              <div class="col-md-12 mt-4">
                                <h3>Create a new rota</h3>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="rota-name" class="mb-2">Rota name</label>
                                <div class="col-sm-4 col-md-4">
                                  <input type="text" name="rota_name" id="rota-name" class="form-control"
                                    placeholder="Enter a new rota name">
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="select-days" class="mb-2">Rota duration</label>
                                <div class="col-sm-3 col-md-3">
                                  <select name="rotaPeriodLength" class="form-select form-control" id="select-days">
                                    <option value="4">4 days</option>
                                    <option value="5">5 days</option>
                                    <option value="6">6 days</option>
                                    <option value="7">7 days</option>
                                    <option value="8">8 days</option>
                                    <option value="9">9 days</option>
                                    <option value="10">10 days</option>
                                    <option value="11">11 days</option>
                                    <option value="12">12 days</option>
                                    <option value="13">13 days</option>
                                    <option value="14">14 days</option>
                                    <option value="Calendar month">Calendar month</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="select-date" class="mb-2">Rota start date</label>
                                <div class="col-sm-4 col-md-4">
                                  <input type="date" id="select-date" name="start_date" class="form-control" placeholder="Select date">
                                </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                <h3>Select your rota view</h3>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card-btn card">
                                  <input type="radio" name="rota_view" class="radio-btn"  value="1">
                                  <div class="bg-color">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                    <h3>Table view</h3>
                                    <p>Set your shift times and easily assign this across employees and dates at once, with a click.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card card-btn">
                                  <input type="radio" name="rota_view" class="radio-btn"  value="2">
                                  <div class="bg-color">
                                    <i class="fa fa-calendar"></i>
                                    <h3>Timeline view</h3>
                                    <p>Add your shift times and assign this to as many employees as you need, right then and there. </p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card-btn card">
                                  <input type="radio" name="rota_view" class="radio-btn"  value="3">
                                  <div class="bg-color">
                                    <i class="fa fa-clone"></i>
                                    <h3>Drag and drop view</h3>
                                    <p>Drag and drop each employee onto the shift you'd like them to work.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="submit-btn my-3">
                                <button type="submit" id="rota_submit_btn">Create your rota</button>
                              </div>
                            </div>
                          </form>
                          <form action="" class="select-rota formTwo" id="copyRota" style="display: none;">
                            <div class="row">
                              <div class="col-md-12 mt-4">
                                <h3>Copy an existing rota</h3>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="select-days" class="mb-2">Select a rota to copy</label>
                                <div class="col-sm-3 col-md-4">
                                  <select name="whichRotaToCopy" class="form-select form-control" id="whichRotaToCopy">
                                    <option disabled="" value="">Select rota...</option>
                                    <option value="d9a73a7f-f3cb-41af-b3a5-e2d7115109f5">Mon 09 Jan 2023 - Shift 3</option>
                                    <option value="bd2e1487-ee40-43cf-9462-c977a314fcce">Wed 04 Jan 2023 - Shift 1</option>
                                    <option value="a8d09c6a-0e39-452e-8fdc-e61ea51c253d">Mon 21 Nov 2022 - Nov week 3
                                    </option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="rota-name" class="mb-2">Copy the notes for this rota?</label>
                                <div class="row">
                                  <div class="col-md-2 select-rota">
                                    <div class="card-btn card">
                                      <input type="radio" class="radio-btn" name="select-btn" checked>
                                      <div class="change-color">
                                        <div class="custom-btn">
                                          <p class="bg-color-custom-btn"></p>
                                        </div>
                                        <div class="bg-color">Yes</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2 select-rota">
                                    <div class="card-btn card">
                                      <input type="radio" class="radio-btn" name="select-btn">
                                      <div class="change-color">
                                        <div class="custom-btn">
                                          <p class="bg-color-custom-btn"></p>
                                        </div>
                                        <div class="bg-color">No</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="rota-name" class="mb-2">Copy colour coding and labels for this rota?</label>
                                <div class="row">
                                  <div class="col-md-2 select-rota">
                                    <div class="card-btn card">
                                      <input type="radio" class="radio-btn" name="select-btn-rota" checked>
                                      <div class="change-color">
                                        <div class="custom-btn">
                                          <p class="bg-color-custom-btn"></p>
                                        </div>
                                        <div class="bg-color">Yes</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2 select-rota">
                                    <div class="card-btn card">
                                      <input type="radio" class="radio-btn" name="select-btn-rota">
                                      <div class="change-color">
                                        <div class="custom-btn">
                                          <p class="bg-color-custom-btn"></p>
                                        </div>
                                        <div class="bg-color">No</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="rota-name" class="mb-2">Rota name</label>
                                <div class="col-sm-4 col-md-4">
                                  <input type="text" id="rota-name" class="form-control"
                                    placeholder="Enter a new rota name">
                                </div>
                              </div>
                              <div class="form-group col-md-12 my-3">
                                <label for="select-date" class="mb-2">Rota start date</label>
                                <div class="col-sm-4 col-md-4">
                                  <input type="date" id="select-date" name="start_date" class="form-control" placeholder="Select date">
                                </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                <h3>Select your rota view</h3>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card-btn card">
                                  <input type="radio" class="radio-btn" name="select-btn">
                                  <div class="bg-color">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                    <h3>Table view</h3>
                                    <p>Set your shift times and easily assign this across employees and dates at once, with a click.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card card-btn">
                                  <input type="radio" class="radio-btn" name="select-btn">
                                  <div class="bg-color">
                                    <i class="fa fa-calendar"></i>
                                    <h3>Timeline view</h3>
                                    <p>Add your shift times and assign this to as many employees as you need, right then and there. </p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 select-rota">
                                <div class="box-createrota-boz card-btn card">
                                  <input type="radio" class="radio-btn" name="select-btn">
                                  <div class="bg-color">
                                    <i class="fa fa-clone"></i>
                                    <h3>Drag and drop view</h3>
                                    <p>Drag and drop each employee onto the shift you'd like them to work.</p>
                                  </div>
                                </div>
                              </div>
                              <div class="submit-btn my-3">
                                <button type="submit">Create your rota</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- Col Md 9 End -->
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
     <!-- Rename Modal -->
     <div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Rename rota</h1>
              <button type="button" class="modal_close_btn" data-bs-dismiss="modal" aria-label="Close"> ✖ </button>
            </div>
            <div class="modal-body">
              <div class="col-md-5">
                <input type="text" id="team-name" placeholder="Enter name..." class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="renameid" value=""/>
              <button type="button" class="close_btn_modal" data-bs-dismiss="modal">Close</button>
              <button type="button" id="rename_save_btn" data-bs-dismiss="modal" class="save_btn_modal">Save</button>
            </div>
          </div>
        </div>
    </div> 
     <!-- Rename Modal End -->
  
        <!-- Publish Modal -->
        <div class="modal fade" id="publishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to publish this rota?</h1>
              <button type="button" class="modal_close_btn" data-bs-dismiss="modal" aria-label="Close"> ✖ </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
              <input type="hidden" id="publish_rota_id" value=""/>
                <span>This will show <p id="shift_name_for_publish"></p> to your employees. They will be able to see their shifts and absence conflicts.</span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="close_btn_modal" data-bs-dismiss="modal">Close</button>
              <button type="button" id="publish_model_btn" data-bs-dismiss="modal" class="save_btn_modal">Publish Rota</button>
            </div>
          </div>
        </div>
    </div> 
     <!-- Publish Modal End-->
  
      <!-- Unpublish Modal -->
      <div class="modal fade" id="unpublishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to unpublish this rota?</h1>
              <button type="button" class="modal_close_btn" data-bs-dismiss="modal" aria-label="Close"> ✖ </button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
              <input type="hidden" id="unpublish_rota_id" value=""/>
                <span>This will hide <p id="shift_name_for_unpublish"></p> from your employees. They will no longer be able to access it or see their shifts and absence conflicts.</span>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="close_btn_modal" data-bs-dismiss="modal">Close</button>
              <button type="button" id="unpublish_model_btn" data-bs-dismiss="modal" class="save_btn_modal">Unpublish Rota</button>
            </div>
          </div>
        </div>
    </div> 
     <!-- Unpublish Modal End-->
       <!-- Modal View start -->
  <div class="modal fade" id="exampleModalViewDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="max-width: 70rem;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Evening Shift</h1>
          <button type="button" class="modal_close_btn" data-bs-dismiss="modal" aria-label="Close"> ✖ </button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center">
            <span class="me-3">Select Week</span>
            <div class="col-md-3 col-lg-3 me-3">
              <select name="" class="form-select form-control" id="rota_starting_date">
              </select>
            </div>
            <span>Week total our: <strong>8 hrs (Incl. breaks)</strong></span>
          </div>
          <div class="w_full view_detail_modal">
            <div class="d-flex align-items-center shrink_all">
              <div class="w_19 py-2">Employee</div>
              <div class="w_19 py-2">Current contracted hours</div>
              <div class="w_19 py-2 ps-2">Days worked</div>
              <div class="w_19 py-2">
                <div class="w_full">Breaks</div>
                <small>(Total)</small>
              </div>
              <div class="w_19 py-2">
                <div class="w_full">Total hours</div>
                <form action="">
                  <small class="d-flex align-items-center">
                    Incl. breaks?
                    <label for="break_check">
                      <input type="checkbox" class="d-none" id="break_check">
                      <span class="custom_checkbox">
                        <span class="d-flex align-items-center justify-content-center"><i class="fa fa-check" aria-hidden="true"></i></span>
                      </span>
                    </label>
                  </small>
                </form>
              </div>
            </div>
       
          </div>
          <div class="w_full row_detail" id="add_emp_record">
            <div class="d-flex align-items-center justify-content-end hour_count">
              <div class="w_19 m-0 py-3">
                <p class="fw-bolder" id="total_emp_hour"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal View end -->
  @include('rotaStaff.components.footer')
    <script>
     
          $('.time_picker').timepicker();
        $('.date_picker').datepicker({
              dateFormat: 'mm/dd/yyyy',
              onSelect: function(dateText){
                  var select_date = $('#select-date').val();
              }
          });
  
      function creatNewRota() {
        var formOne = document.getElementById('createRota');
        var formTwo = document.getElementById('copyRota');
        if (formOne.style.display == "none") {
            formOne.style = "none";
          formTwo.style = "none";
          formOne.style.display = "block";
          formTwo.style.display = "none";
      }
      }
  
      function copyNewRota() {
        var formOneRota = document.getElementById('createRota');
        var formTwoRota = document.getElementById('copyRota');
        if (formTwoRota.style.display == "none") {
          formOneRota.style = "none";
          formTwoRota.style = "none";
          formTwoRota.style.dispaly = "block";
          formOneRota.style.display = "none";
        }
      }
      function hide() {
              var modal_one = document.getElementById('show');
              var modal_two = document.getElementById('hide');
              if (modal_two.style.display === "none") {
                  modal_two.style.display = "block";
                  modal_one.style.display = "none";
              } else {
                  modal_two.style.display = "none";
                  modal_one.style.display = "block";
              }
          }
          function back_Modal() {
              var modal_one = document.getElementById('show');
              var modal_two = document.getElementById('hide');
              if (modal_two.style.display === "block") {
                  modal_two.style.display = "none";
                  modal_one.style.display = "block";
              } else {
                  modal_two.style.display = "none";
                  modal_one.style.display = "block";
              }
          }
          function multiEmployees() {
              var formstep = document.getElementById('multiForm');
              var canclestep = document.getElementById('multiEmployee');
              if (formstep.style.display === "none") {
                  formstep.style.display = "block";
                  canclestep.style.display = "none";
              } else {
                  formstep.style.display = "none";
                  canclestep.style.display = "block";
              }
          }
          
          function closeMultiEmployee() {
              var formstep = document.getElementById('multiForm');
              var canclestep = document.getElementById('multiEmployee');
              if (formstep.style.display === "block") {
                  formstep.style.display = "none";
                  canclestep.style.display = "block";
              }
          }
          function next(id) {
              let bg = document.getElementById('bg' + id.count)
              let currentForm = document.getElementById(id.form + id.count);
              let nextForm = document.getElementById(id.form + parseInt((id.count + 1)));
              setTimeout(() => {
                  currentForm.style.display = 'none';
                  nextForm.style.display = 'block';
                  bg.style = 'none';
              }, 200);
          }
  
          function back(id) {
              let bg = document.getElementById('bg' + parseInt(id.count - 1))
              let currentForm = document.getElementById(id.form + id.count);
              let prevForm = document.getElementById(id.form + parseInt((id.count - 1)));
              setTimeout(() => {
                  currentForm.style.display = 'none';
                  prevForm.style.display = 'block';
                  bg.style.color = '#999';
                  bg.style.backgroundColor = '#fff';
              }, 200);
          }
    </script>
  </body>
  <script>
      // Open single
          $('.example-opensingle').beefup({
              openSingle: true,
              stayOpen: 'last'
          });
          </script>
      <script>
           function openNav() {
        document.getElementById("mySidepanel").style.width = "400px";
      }
      
      function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
      }
      </script>
  <script>
          var count = 0;
          var addRecordHtml =
              `<div class="employees-no">
              <div>
                  <h5>New records <span>()</span></h5>
              </div>
              </div>
              <form class="row employees-data" onsubmit="return validateform()">
              <div class="form-group col-md-2">
              <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName"
            aria-describedby="emailHelp" placeholder="First name">
            <p id="nameError"></p>
            </div>
            <div class="form-group col-md-2">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName"
            placeholder="Last name">
            <p id="lastNamError"></p>
            </div>
            <div class="form-group col-md-2">
                  <label for="emailAdd">Email</label>
                  <input type="email" placeholder="Email" class="form-control"
                      id="emailAdd" value="">
                      <p id="emailError"></p>
              </div>
              <div class="form-group col-md-2">
                  <label id="firstDate" class="form-check-label">Employment start
                  date</label>
                  <input type="date" class="form-control" id="firstDate">
                  <p id="startDate"></p>
                  </div>
                  <div class="form-group col-md-2">
                  <label id="employType" class="form-check-label">Employee
                  type</label>
                  <input type="type" class="form-control" placeholder="Select type"
                  id="employType">
                  <p id="employTypeError"></p>
                  </div>
                  <div
                  class="form-group col-md-2 d-flex align-items-center justify-content-center">
                  <button type="submit" id="saveBtn" class="save-btn">Save</button>
                  <!--<button type="button" class="delete-btn"></button> -->
                  <!-- Button trigger modal -->
                  <button type="button" id="deltBtn" class="delete-btn" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
  
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                              <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                              </div>
                              <div class="modal-body">
                              ...
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                  </div>
                          </div>
                          </div>
                          </div>
          </form>`
          var addNewEmpolyeeForm = `
          <form class="row employees-data" onsubmit="return validateform()">
          <div class="form-group col-md-2">
                  <input type="text" class="form-control" id="firstName"
                  aria-describedby="emailHelp" placeholder="First name">
                  <p id="nameError"></p>
              </div>
              <div class="form-group col-md-2">
                  <input type="text" class="form-control" id="lastName"
                  placeholder="Last name">
                  <p id="lastNamError"></p>
                  </div>
              <div class="form-group col-md-2">
              <input type="email" placeholder="Email" class="form-control"
              id="emailAdd" value="">
              <p id="emailError"></p>
              </div>
              <div class="form-group col-md-2">
                  <input type="date" class="form-control" id="firstDate">
                  <p id="startDate"></p>
              </div>
              <div class="form-group col-md-2">
                  <input type="type" class="form-control" placeholder="Select type"
                  id="employType">
                  <p id="employTypeError"></p>
                  </div>
                  <div
                  class="form-group col-md-2 d-flex align-items-center justify-content-center">
                  <button type="submit" id="saveBtn" class="save-btn">Save</button>
                  <button type="button" id="deltBtn" class="delete-btn"><i
                  class="fa fa-trash-o" aria-hidden="true"></i></button>
                  </div>
                  </form>`
                  function addNewEmploye() {
              var newRecords = document.getElementById('showDiv')
              if (count === 0) {
                  newRecords.innerHTML += addRecordHtml;
                  count++;
              } else {
                  newRecords.innerHTML += addNewEmpolyeeForm;
              }
          }
      </script>
      <script>
          function next(id) {
              let bg = document.getElementById('bg' + id.count)
              let currentForm = document.getElementById(id.form + id.count);
              let nextForm = document.getElementById(id.form + parseInt((id.count + 1)));
              setTimeout(() => {
                  currentForm.style.display = 'none';
                  nextForm.style.display = 'block';
                  bg.style = 'none';
              }, 200);
          }
          
          function back(id) {
              let bg = document.getElementById('bg' + parseInt(id.count - 1))
              let currentForm = document.getElementById(id.form + id.count);
              let prevForm = document.getElementById(id.form + parseInt((id.count - 1)));
              setTimeout(() => {
                  currentForm.style.display = 'none';
                  prevForm.style.display = 'block';
                  bg.style.color = '#999';
                  bg.style.backgroundColor = '#fff';
              }, 200);
          }
          
          </script>
      <script>
          let firstName = document.getElementById('firstName');
          let lastName = document.getElementById('lastName');
          let emailAdd = document.getElementById('emailAdd');
          let firstDate = document.getElementById('firstDate');
          let employType = document.getElementById('employType');
          let next1 = document.getElementById('next1');
          let saveBtn = 1;
  
          function validateform() {
              if (firstName.value == "") {
                  document.getElementById('nameError').innerHTML = "Name is empty!";
                  saveBtn = 0;
              } else if (firstName.value.length < 2) {
                  document.getElementById('nameError').innerHTML = "Name is must be two char!";
                  saveBtn = 0;
              } else {
                  document.getElementById('nameError').innerHTML = "";
                  saveBtn = 1;
              }
              
              if (lastName.value == "") {
                  document.getElementById('lastNamError').innerHTML = "Last name is empty!"
                  saveBtn = 0;
              } else if (lastName.value.length < 2) {
                  document.getElementById('lastNamError').innerHTML = "Last name must be two char!"
                  saveBtn = 0;
              } else {
                  document.getElementById('lastNamError').innerHTML = ""
                  saveBtn = 1;
              }
  
              if (emailAdd.value == "") {
                  document.getElementById('emailError').innerHTML = "email is required!";
              } else {
                  document.getElementById('emailError').innerHTML = ""
              }
              
              if (firstDate.value == "") {
                  document.getElementById('startDate').innerHTML = "Date is required!";
              } else {
                  document.getElementById('startDate').innerHTML = ""
              }
              
              if (employType.value == "") {
                  console.log("right");
              } else {
                  document.getElementById('employTypeError').innerHTML = ""
              }
              
              if (saveBtn) {
                  return true;
                  // saveBtn.setAttribute('disabled');
              } else {
                  return false;
              }
          }
      </script>
  <script>
  
      mobiscroll.setOptions({
          theme: 'ios',
          themeVariant: 'light'
      });
      
      var now = new Date(),
      week = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 6);
      
      mobiscroll.datepicker('#demo-mobile-picker-input', {
          controls: ['calendar'],
      select: 'range',
      showRangeLabels: true
  });
  
  var instance = mobiscroll.datepicker('#demo-mobile-picker-button', {
      controls: ['calendar'],
      select: 'range',
      showRangeLabels: true,
      showOnClick: false,
      showOnFocus: false,
  });
  
  instance.setVal([now, week]);
  
  mobiscroll.datepicker('#demo-mobile-picker-mobiscroll', {
      controls: ['calendar'],
      select: 'range',
      showRangeLabels: true
  });
  
  var inlineInst = mobiscroll.datepicker('#demo-mobile-picker-inline', {
      controls: ['calendar'],
      select: 'range',
      showRangeLabels: true,
      display: 'inline',
  });
  
  inlineInst.setVal([now, week]);
  
  document
      .getElementById('show-mobile-date-picker')
      .addEventListener('click', function () {
          instance.open();
          return false;
      });
      
      mobiscroll.datepicker('#demo-mobile-picker-input', {
          controls: ['calendar'],       // More info about controls: https://docs.mobiscroll.com/5-21-1/javascript/range#opt-controls
          select: 'range',              // More info about select: https://docs.mobiscroll.com/5-21-1/javascript/range#methods-select
          showRangeLabels: true
      });
      </script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
          crossorigin="anonymous"></script> -->
          <script>
               function formhide() {
                  var contentOne = document.getElementById('hide');
                  var contentTwo = document.getElementById('showFormContent');
                  var btn = document.getElementById('modalBtn');
                  if(contentTwo.style.display == "none") {
                      contentTwo.style.display = "block";
                      contentOne.style.display = "none";
                      btn.style.display = "none";
                  }  
               }
  
               function hideform() {
                  var contentOne = document.getElementById('hide');
                  var contentTwo = document.getElementById('showFormContent');
                  var btn = document.getElementById('modalBtn');
                  if(contentTwo.style.display == "block") {
                      contentTwo.style.display = "none";
                      contentOne.style.display = "block";
                      btn.style.display = "block";
                  }
               }
  
               function showForm() {
                  var show_form = document.getElementById('formShow');
                  var hideContent = document.getElementById('hide_content');
                  var modalBtn = document.getElementById('hideModalBtn'); 
                  if(show_form.style.display == "none") {
                      show_form.style.display = "block";
                      hideContent.style.display = "none";
                      modalBtn.style.display = "none";
                  }
               } 
  
               function showContent() {
                  var show_Form = document.getElementById('formShow');
                  var hideContent = document.getElementById('hide_content');
                  var modalBtn = document.getElementById('hideModalBtn'); 
                  if(hideContent.style.display == "none") {
                      hideContent.style.display = "block";
                      show_Form.style.display = "none";
                      modalBtn.style.display = "block";
                  } 
               }
  
               function showFormFive() {
                  var showForm = document.getElementById('show_form_five');
                  var hideButton = document.getElementById('hide_button');
                  if(showForm.style.display === "none") {
                      showForm.style.display = "block";
                      hideButton.style.display = "none";
                  }
               }
  
               function hideFormFive() {
                  var showForm = document.getElementById('show_form_five');
                  var hideButton = document.getElementById('hide_button');
                  if(hideButton.style.display == "none") {
                      hideButton.style.display = "block";
                      showForm.style.display = "none";
                  }
               }
          </script>
  </html>  <script>
      $( document ).ready(function() {
          $('#rename_save_btn').on('click', function(){
            var rota_id =  document.getElementById('renameid').value;
            var rota_name = document.getElementById('team-name').value;
            var token = "HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ";
            $.ajax({
                url:"http://127.0.0.1:8000/update_rota_name",    
                type: "post",    
                dataType: 'json',
                data: {rota_id: rota_id, rota_name: rota_name, _token:token},
                success:function(result){
                    console.log(result);     
                }
            });
          });
          $('#publish_model_btn').on('click', function(){
            var publish_rota_id =  document.getElementById('publish_rota_id').value;
           var token = "HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ";
            $.ajax({
                url:"http://127.0.0.1:8000/publish_rota_employee",    
                type: "post",    
                dataType: 'json',
                data: {publish_rota_id: publish_rota_id, _token:token},
                success:function(result){
                    console.log(result);   
                    location.reload();  
                }
            });
          });
          $('#unpublish_model_btn').on('click', function(){
            var unpublish_rota_id =  document.getElementById('unpublish_rota_id').value;
            var token = "HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ";
            $.ajax({
                url:"http://127.0.0.1:8000/unpublish_rota_employee",    
                type: "post",    
                dataType: 'json',
                data: {unpublish_rota_id: unpublish_rota_id, _token:token},
                success:function(result){
                    console.log(result);   
                    location.reload();  
                }
            });
          });
      });
       
      let viewMore = document.getElementById('viewPublish').style.display = "none";
  
      function lessRotaPublish() {
        let showLess = document.getElementById('lessPublish');
        let viewMore = document.getElementById('viewPublish');
        let contentPublish = document.getElementById('beforePublishRota');
        if(viewMore.style.display === "none") {
          showLess.style.display = "none";
          viewMore.style.display = "block";
          contentPublish.style.display = "none";
        }
      }
  
      function showRotaPublish() {
        let showLess = document.getElementById('lessPublish');
        let viewMore = document.getElementById('viewPublish');
        let contentPublish = document.getElementById('beforePublishRota');
        if(showLess.style.display === "none") {
          showLess.style.display = "block";
          viewMore.style.display = "none";
          contentPublish.style.display = "block";
        }
      }
  
      let unPublishViewMore = document.getElementById('viewUnpublish').style.display = "none"; 
  
      function unPublishless() {
        let unPublishViewMore = document.getElementById('viewUnpublish');
        let unPublishLess = document.getElementById('lessUnpublish');
        let contentUnpublish = document.getElementById('unpublish_rota_content_detail');
        if(unPublishViewMore.style.display === "none") {
          unPublishViewMore.style.display = "block";
          unPublishLess.style.display = "none";
          contentUnpublish.style.display = "none";
        }
      }
  
      function unPublishview() {
        let unPublishViewMore = document.getElementById('viewUnpublish');
        let unPublishLess = document.getElementById('lessUnpublish');
        let contentUnpublish = document.getElementById('unpublish_rota_content_detail');
        if(unPublishViewMore.style.display === "block") {
          unPublishViewMore.style.display = "none";
          unPublishLess.style.display = "block";
          contentUnpublish.style.display = "block";
        }
      }
    </script>
    <script>
      function renamedata(id,name){
        $('#team-name').val(name);
        $('#renameid').val(id);
        $('#renameModal').modal('show');    
      }
  
      function publishRotaEmployee(id, name){
          $('#publish_rota_id').val(id);
          document.getElementById('shift_name_for_publish').innerHTML = name;
          $('#publishModal').modal('show');
      }
  
      function unpublishRotaEmployee(id, name){
          $('#unpublish_rota_id').val(id);
          document.getElementById('shift_name_for_unpublish').innerHTML = name;
          $('#unpublishModal').modal('show');
      }
  
      function DeleteRotaEmployee(id, name){
        var token = "HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ";
        $.ajax({
                url:"http://127.0.0.1:8000/delete_rota_employee",    
                type: "post",    
                dataType: 'json',
                data: {id: id, _token:token},
                success:function(result){
                    console.log(result);   
                    location.reload();  
                }
            });
      }
  
      function RotaView(id, name){
  
        var token = "HbJugzPPZz5LreFuwBvHYoIHFOqEZ8hy72VYb1FZ";
        $.ajax({
                url:"http://127.0.0.1:8000/get_all_shift",    
                type: "post",    
                dataType: 'json',
                data: {id: id, _token:token},
                success:function(result){
                  console.log(result); 
                  $('#rota_starting_date').append("<option>Week 1 - "+result+"</option>");  
                }
            });
  
  
        $.ajax({
                url:"http://127.0.0.1:8000/get_rota_employee",    
                type: "post",    
                dataType: 'json',
                data: {id: id, _token:token},
                success:function(result){
                    console.log(result);   
                    var total_emp_hours = 0;  var total_emp_minutes = 0;
                    for (let index = 0; index < result.length; index++) {
                      console.log(result[index].name);
                      var startTime = moment(result[index].shift_start_time, 'HH:mm:ss');
                      var endTime = moment(result[index].shift_end_time, 'HH:mm:ss');
  
                      // calculate total duration
                      var duration = moment.duration(endTime.diff(startTime));
                      console.log(duration);
                      // duration in hours
                      var hours = parseInt(duration.asHours());
                      var total_emp_hours = total_emp_hours + hours;
                      // duration in minutes
                      var minutes = parseInt(duration.asMinutes()) % 60;  
  
                      total_emp_minutes = total_emp_minutes + minutes;
  
                      var totalhour = hours + ' hour and ' + minutes + ' minutes.';
                      document.querySelector('#add_emp_record').insertAdjacentHTML(
                          'afterbegin',
                              `<div class="d-flex align-items-center shrink_all">
                                <div class="w_19 py-2" style="overflow-x: scroll; overflow-y: hidden;">`+result[index].name+`</div>
                                <div class="w_19 py-2" style="overflow-x: scroll; overflow-y: hidden;">40 hrs</div>
                                <div class="w_19 py-2 ps-2">
                                  <span class="d-flex">
                                    <p class="ms-2 fw-bolder" style="color:#ad005c;">F</p>
                                    <p class="ms-2 fw-bolder">S</p>
                                    <p class="ms-2 fw-bolder">S</p>
                                    <p class="ms-2 fw-bolder">M</p>
                                    <p class="ms-2 fw-bolder">T</p>
                                    <p class="ms-2 fw-bolder">W</p>
                                    <p class="ms-2 fw-bolder">T</p>
                                  </span>
                                </div>
                                <div class="w_19 py-2">
                                  <div class="w_full">`+result[index].break+` min</div>
                                </div>
                                <div class="w_19 py-2">
                                  <div class="w_full">`+totalhour+`</div>
                                </div>
                              </div>`   
                          );    
                    }
                    var total_duration = total_emp_hours + ' hour and ' + total_emp_minutes + ' minutes.';
                    document.getElementById('total_emp_hour').innerHTML=  total_duration;
                }
            });
           
        $('#exampleModalViewDetail').modal('show');
  
      }
      // $('#break_check').click(function(){ alert("hello"); });
  
  </script> 