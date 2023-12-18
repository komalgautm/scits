<!-- sidebar start -->
<?php $super_admin = Session::get('scitsAdminSession')->access_type;  ?>
<aside> 
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                @if( ($super_admin == 'S') || ($super_admin == 'O') ) <!-- if super admin or owner is login -->
                <li>
                    <a href="{{ url('admin/welcome') }}" class="{{ ($page == 'welcome') ? 'active' : ''}}">
                        <i class="fa fa-street-view "></i>
                        <span>Welcome</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ url('admin/dashboard') }}" class="{{ ($page == 'dashboard') ? 'active' : ''}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if($super_admin == 'S')
                
                <li class="sub-menu">
                    <a href="{{ url('admin/migrations') }}" class="<?php if( ($page == 'company_manager' || $page == 'system-admins') || ($page == 'supr_migrations') || ($page == 'super_admin_user') || ($page == 'file_category_name') || ($page == 'social-app') || ($page == 'ethnicity') || ($page == 'company_charges') ){ echo 'active'; } ?>" >
                        <i class="fa fa-university"></i>
                        <span>Super Admin</span>
                    </a>
                    <ul class="sub">
                        <li class="{{ ($page == 'company_manager') ? 'active' : ''}}">
                            <a href="{{ url('admin/company-managers') }}" >
                                <!-- <i class="fa fa-university"></i> -->
                                <span>Company Manager</span>
                            </a>
                        </li>
                        <li class="{{ ($page == 'system-admins') ? 'active' : ''}}">
                            <a href="{{ url('admin/system-admins') }}" >
                                <!-- <i class="fa fa-university"></i> -->
                                <span>Companies</span>
                            </a>
                        </li>
                        <li class="{{ ($page == 'company_charges') ? 'active' : ''}}">
                            <a href="{{ url('admin/company-charges') }}" >
                                <!-- <i class="fa fa-university"></i> -->
                                <span>Company Charges</span>
                            </a>
                        </li>
                        <li class="{{ ($page == 'supr_migrations') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/migrations') }}">
                                <!-- <i class="fa fa-upload"></i> -->
                                <span>Migrations</span>
                            </a>
                        </li>
                        
                        <li class="{{ ($page == 'super_admin_user') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/users') }}">
                                <!-- <i class="fa fa-upload"></i> -->
                                <span>Super Admin Users</span>
                            </a>
                        </li>

                        <li class="{{ ($page == 'file_category_name') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/filemanager-categories') }}">
                                <!-- <i class="fa fa-upload"></i> -->
                                <span>File Manager Categories</span>
                            </a>
                        </li>
                        <!-- <li class="{{ ($page == 'file_category_name') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/filemanager-categories') }}"> -->
                                <!-- <i class="fa fa-upload"></i> -->
                                <!-- <span>Mandatory leave</span>
                            </a>
                        </li> -->

                         <li class="{{ ($page == 'social-app') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/social-apps') }}">
                                <!-- <i class="fa fa-upload"></i> -->
                                <span>Social Apps</span>
                            </a>
                        </li>
                        <li class="{{ ($page == 'ethnicity') ? 'active' : ''}}">
                            <a href="{{ url('super-admin/ethnicities') }}">
                                <!-- <i class="fa fa-upload"></i> -->
                                <span>Ethnicity</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endif

                <li class="sub-menu">
                    <a href="javascript:;"  class="<?php if(($page == 'users') || ($page == 'service-users') || ($page == 'daily_records') || ($page == 'risks') || ($page == 'earning_scheme') || ($page == 'earning_scheme_label') || ($page == 'incentive_earning_scheme') || ($page == 'service-users-care-history') || ($page == 'care_team') || ($page == 'moods') || ($page == 'support_ticket') || ($page == 'placement_plan') || ($page == 'form-builder') || ($page == 'label') || ($page == 'categories') || ($page == 'su_migration_form') || ($page == 'modification-request') || ($page == 'living_skill') || ($page == 'education-training') || ($page == 'mfc')|| ($page == 'incident-report') || ($page == 'contact-us') || ($page == 'daily-record-scores') || ($page == 'system-guide') || ($page == 'external-service') || ($page == 'su-dynamic-form') || ($page == 'file_manager') || ($page == 'user-task') || ($page == 'user-sick-leave') || ($page == 'user-annual-leave') || ($page == 'service-user-my-money-history') || ($page == 'service-user-my-money-request') || ($page == 'service-users-log-book') || ($page == 'service-users-living-skill') || ($page == 'service-users-rmp') || ($page == 'service-users-risk') || ($page == 'service-users-earn-schm') || ($page =='service-users-bmp') || $page == 'agents' || $page == 'managers' ) {  echo 'active'; } ?>">
                        <i class="fa fa-laptop"></i>
                        <span>System Management</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php if(($page == 'users') || ($page == 'user-task') || ($page == 'user-sick-leave') || ($page == 'user-annual-leave') ) {echo 'active'; } ?>"><a href="{{ url('admin/users') }}">Users</a></li>
                        <li class="<?php if(($page == 'service-users') || ($page == 'service-users-care-history') || ($page == 'care_team') || ($page == 'moods') || ($page == 'su_migration_form') || ($page == 'incident-report') || ($page == 'external-service') || ($page == 'su-dynamic-form')|| ($page == 'file_manager')  || ($page == 'service-user-my-money-history') || ($page == 'service-user-my-money-request') || ($page == 'service-users-log-book') || ($page == 'service-users-living-skill') || ($page == 'service-users-rmp') || ($page == 'service-users-risk') || ($page == 'service-users-earn-schm') || ($page =='service-users-bmp')) { echo 'active'; } ?>"><a href="{{ url('admin/service-users') }}" >Service Users</a></li>
                        
                        <li class="{{ ($page == 'agents') ? 'active' : '' }}"><a href="{{ url('admin/agents') }}">Agent</a></li>

                        <li class="{{ ($page == 'daily_records') ? 'active' : '' }}"><a href="{{ url('admin/daily-record') }}">Daily Log</a></li>
                        
                        <li class="{{ ($page == 'daily-record-scores') ? 'active' : '' }}"><a href="{{ url('admin/daily-record-scores') }}">Daily Log Scores</a></li>

                        <li class="{{ ($page == 'education-training') ? 'active' : '' }}"><a href="{{ url('admin/education-trainings') }}">Education Records</a></li>

                        <li class="{{ ($page == 'living_skill') ? 'active' : '' }}"><a href="{{ url('admin/living-skill') }}"> Independent Living Skills </a></li>
                        <!-- <li class="{{ ($page == 'mfc') ? 'active' : '' }}"><a href="{{ url('admin/mfc-records') }}">MFC</a></li> -->

                        <li class="{{ ($page == 'risks') ? 'active' : '' }}"><a href="{{ url('admin/risk') }}">Risks</a></li>
                        <li class="{{ ($page == 'earning_scheme') || ($page == 'incentive_earning_scheme') ? 'active' : '' }}"><a href="{{ url('admin/earning-scheme') }}">Earning Scheme </a></li>
                        <li class="{{ ($page == 'earning_scheme_label') ? 'active' : '' }}"><a href="{{ url('admin/earning-scheme-labels') }}">Earning Scheme Labels</a></li>
                        <li class="{{ ($page == 'form-builder') || ($page == 'form-builder') ? 'active' : '' }}"><a href="{{ url('admin/form-builder') }}">Form Builder </a></li>
                        
                        <li class="{{ ($page == 'label') ? 'active' : '' }}"><a href="{{ url('admin/labels') }}">Labels</a></li>
                        <li class="{{ ($page == 'categories') ? 'active' : '' }}"><a href="{{ url('admin/categories') }}">Log Category Labels</a></li>

                        <li class="{{ ($page == 'support_ticket') ? 'active' : '' }}"><a href="{{ url('admin/support-ticket') }}">Support Ticket</a></li>
                        <li class="{{ ($page == 'modification-request') ? 'active' : '' }}"><a href="{{ url('admin/modification-requests') }}">Modification Requests</a></li>
                        <!-- <li class="{{ ($page == 'contact-us') ? 'active' : '' }}"><a href="{{ url('admin/contact-us') }}"> Contact-us </a></li> -->
                        <li class="{{ ($page == 'system-guide') ? 'active' : '' }}"><a href="{{ url('admin/system-guide-category') }}"> System Guide </a></li>

                        <li class="{{ ($page == 'managers') ? 'active' : '' }}"><a href="{{ url('admin/managers')}}"> Managers </a></li>
                        
                        <!-- <li class="{{ ($page == 'placement_plan') ? 'active' : '' }}"><a href="{{ url('admin/placement-plan') }}">Placement Plan</a></li> -->
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="<?php if(($page == 'care_team_job_title') || ($page == 'mood_title')  || ($page == 'access_levels')  || ($page == 'rota_shift') || ($page == 'homelist') || ($page == 'policies') ){ echo 'active'; } ?>" >
                        <i class="fa fa-home"></i>
                        <span>Home Management</span>
                    </a>
                    <ul class="sub">
                        <!--if($super_admin != 'S')-->
                        @if($super_admin == 'O')
                            <li class="{{ ($page == 'homelist') ? 'active' : '' }}"><a href="{{ url('admin/homelist') }}">Homes</a></li>
                        @endif
                        
                        <li class="{{ ($page == 'care_team_job_title') ? 'active' : '' }}">
                            <a href="{{ url('admin/care-team-job-titles') }}">Care Team Job Titles</a>
                        </li>
                        <li class="{{ ($page == 'mood_title') ? 'active' : '' }}">
                            <a href="{{ url('admin/moods') }}">Moods</a>
                        </li>
                        <li class="{{ ($page == 'access_levels') ? 'active' : '' }}">
                            <a href="{{ url('admin/home/access-levels') }}">Access Levels</a>
                        </li>
                        <!-- <li class="{{ ($page == 'rota_shift') ? 'active' : '' }}">
                            <a href="{{ url('admin/home/rota-shift') }}">Rota Shift</a>
                        </li> -->
                        <li class="{{ ($page == 'policies') ? 'active' : '' }}">
                            <a href="{{ url('admin/home/policies') }}">Policies & Procedure</a>
                        </li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="<?php if(($page == 'agenda_meeting') || ($page == 'petty_cash') || ($page == 'log_book') || ($page == 'weekly_allowance') || ($page == 'staff_training') ){ echo 'active'; } ?>" >
                        <i class="fa fa-cogs"></i>
                        <span>General Admin</span>
                    </a>
                    <ul class="sub">

                        <li class="{{ ($page == 'agenda_meeting') ? 'active' : '' }}">
                            <a href="{{ url('admin/general-admin/agenda/meetings') }}">Agenda Meetings </a>
                        </li>
                        <li class="{{ ($page == 'petty_cash') ? 'active' : '' }}">
                            <a href="{{ url('admin/general-admin/petty/cash') }}">Petty Cash </a>
                        </li>
                        <li class="{{ ($page == 'log_book') ? 'active' : '' }}">
                            <a href="{{ url('admin/general-admin/log/book') }}">Log Book </a>
                        </li>
                        <li class="{{ ($page == 'weekly_allowance') ? 'active' : '' }}">
                            <a href="{{ url('admin/general-admin/allowance/weekly') }}">Weekly Allowance </a>
                        </li>
                        <li class="{{ ($page == 'staff_training') ? 'active' : '' }}">
                            <a href="{{ url('admin/general-admin/staff/training') }}">Staff Training </a>
                        </li>
                    </ul>
                </li>                     

                <!-- <li>
                    <a href="login.html">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
                </li> -->
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

