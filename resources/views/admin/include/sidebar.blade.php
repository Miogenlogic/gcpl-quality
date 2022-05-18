<style>
    .nav-link{
        background: #00000052;
        color: white;

    }
</style>

<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner" style="background-color: rgb(253,185,22);max-height: none">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{url('admin/admin-dashboard')}}">
                <img src="{{URL::asset('public/assets/img/brand/edm_05.jpg')}}" class="navbar-brand-img" alt="Logo">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <ul class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link {{(Request::is('*/admin/*dashboard*')) ?'active':''}}" href="

                            @if (request()->session()->get('user')['section_id'] == '20') {{url('admin/super-admin-dashboard')}} @endif
                            @if (request()->session()->get('user')['section_id'] == '24') {{url('admin/super-admin-dashboard')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '1')  {{url('admin/branch-dashboard')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '2')  {{url('admin/support-quotation-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '3')  {{url('admin/receiving-dashboard')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '4')  {{url('admin/engine-diss-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '5')  {{url('admin/trans-diss-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '13')  {{url('admin/hyd-diss-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '6')  {{url('admin/mor-diss-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '7')  {{url('admin/undercarg-diss-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '8')  {{url('admin/spc-dashboard')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '9')  {{url('admin/store-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '10')  {{url('admin/engine-ass-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '11')  {{url('admin/trans-ass-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '12')  {{url('admin/hyd-ass-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '14')  {{url('admin/mor-ass-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '15')  {{url('admin/undercarg-ass-list')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '21')  {{url('admin/servicedashboard-checkgatefour')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '22')  {{url('admin/servicedashboard-pdilist')}} @endif
                        @if (request()->session()->get('user')['section_id'] == '23')  {{url('admin/departmental-dashboard')}} @endif

                                @hasrole('crc_head')  {{url('admin/crc-head-dashboard')}} @endrole
                            @hasrole('section_supervisor')  {{url('admin/section-supervisor-dashboard')}} @endrole
                            @hasrole('section_engineer')  {{url('admin/section-engineer-dashboard')}} @endrole
                            @hasrole('qa_qc') {{url('admin/qaqc-dashboard')}} @endrole
                            @hasrole('planning_supervisor')  {{url('admin/planning-supervisor-dashboard')}} @endrole
                            @hasrole('store_manager') {{url('admin/store-manager-dashboard')}} @endrole
                            @hasrole('despatch_manager')  {{url('admin/despatch-manager-dashboard')}} @endrole
                            @hasrole('service_engineer')  {{url('admin/service-engineer-dashboard')}} @endrole
                            @hasrole('dept_eng')  {{url('admin/engine-dashboard')}} @endrole
                            @hasrole('dept_trans')  {{url('admin/trans-dashboard')}} @endrole
                            @hasrole('eng_head')  {{url('admin/eng-head-dashboard')}} @endrole
                            @hasrole('dept_mor')  {{url('admin/mor-dashboard')}} @endrole
                            @hasrole('dept_hyd')  {{url('admin/hyd-dashboard')}} @endrole
                            @hasrole('dept_undercarriage')  {{url('admin/undercarg-dashboard')}} @endrole


                            ">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                </ul>
                <!--<ul class="navbar-nav">-->
                <!--    <li class="nav-item">-->
                <!--        <a class="nav-link {{(Request::is('admin/checksheetsection-one-add')) ?'active':''}}" href="{{url('admin/checksheetsection-one-list')}}">-->
                <!--            <i class="ni ni-briefcase-24"></i>-->
                <!--            <span class="nav-link-text">Checksheet Section</span>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--</ul>-->
             
                 @if (request()->session()->get('user')['section_id'] == '20')
                                <ul class="nav nav-sm flex-column">
                                @if(request()->session()->get('user')['role_id'] == '3')
                 <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples_1" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"
                               aria-controls="navbar-examples_1">
                                <i class="ni ni-briefcase-24 text-orange"></i>
                                <span class="nav-link-text">Master Section</span>
                            </a>
                            <div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples_1">
                                 <ul class="nav nav-sm flex-column">

									 <li class="nav-item">
                                        <a href="{{url('admin/master-customer')}}" class="nav-link {{((Request::is('admin/master-customer')) || (Request::is('admin/master-customer')) )?'active':''}}">Customer Details</a>
                                    </li>
									 <li class="nav-item">
                                        <a href="{{url('admin/master-branch')}}" class="nav-link {{((Request::is('admin/master-branch')) || (Request::is('admin/master-branch')) )?'active':''}}">Branch Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/employee-detsils-list')}}" class="nav-link {{((Request::is('admin/employee-detsils-list')) || (Request::is('admin/employee-detsils-list')) )?'active':''}}">Employee Details</a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="{{url('admin/fetch')}}" class="nav-link {{((Request::is('admin/fetch')) || (Request::is('admin/fetch')) )?'active':''}}">Model List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/component-section-list')}}" class="nav-link {{((Request::is('admin/component-section-list')) || (Request::is('admin/component-section-list')) )?'active':''}}">Section List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/fetchmodelwisetask')}}" class="nav-link {{((Request::is('admin/fetchmodelwisetask')) || (Request::is('admin/fetchmodelwisetask')) )?'active':''}}">Task Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/checksheetsection-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Checksheet Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/checksheetcolumn-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Checksheet Column Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/checksheetcolumn-listing-new')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Checksheet Column Details New</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/stddata-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Standard Data Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-compinsp')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Component Inspection Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-transmission')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Transmission Inspection Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-othercomponent')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Other Component Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-assembly')}}" class="nav-link {{((Request::is('admin/fetch-assembly')) || (Request::is('admin/fetch-assembly')) )?'active':''}}">Assembly Details</a>
                                    </li>
                                 </ul>
                                
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples_2" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"
                               aria-controls="navbar-examples_2">
                                <i class="ni ni-briefcase-24 text-orange"></i>
                                <span class="nav-link-text">Report Section</span>
                            </a>
                            <div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples_2">
                                 <ul class="nav nav-sm flex-column">

									 <li class="nav-item">
                                        <a href="{{url('admin/componentstatusfacility-listing')}}" class="nav-link {{((Request::is('admin/componentstatusfacility-listing')) || (Request::is('admin/master-customer')) )?'active':''}}">Component Status Facility</a>
                                    </li>
									 <li class="nav-item">
                                        <a href="{{url('admin/jobdetails-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Job Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/menPower-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">ManPower Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/workorder-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">WorkOrder OR TAT Details</a>
                                    </li>
                                    <li class="nav-item">
                                         <a href="{{url('admin/bisreport-listing')}}" class="nav-link {{((Request::is('admin/bisreport-listing')) || (Request::is('admin/bisreport-listing')) )?'active':''}}">BIS Details</a>
                                     </li>
                                    <!--<li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>-->
                                    <li class="nav-item">
                                        <a href="{{url('admin/labourJobActivity-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Labour Job Details</a>
                                    </li>
									<!--coded by amanur-->
									 <li class="nav-item">
                                        <a href="{{url('admin/capacityUtilization-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Capacity Utilization</a>
                                    </li>
									<!--end coded by amamnur-->
                                 </ul>
                                
                            </div>
                        </li>
                    </ul>
                    @endif
                    @endif

                   <!--  @php

                    echo request()->session()->get('user')['section_id'];

                    @endphp -->
                    
                    <!-- SuperAdmin (Head) -->
                    @if (request()->session()->get('user')['section_id'] == '24')
                                <ul class="nav nav-sm flex-column">
                                @if(request()->session()->get('user')['role_id'] == '4')
                 <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples_1" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"
                               aria-controls="navbar-examples_1">
                                <i class="ni ni-briefcase-24 text-orange"></i>
                                <span class="nav-link-text">Master Section</span>
                            </a>
                            <div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples_1">
                                 <ul class="nav nav-sm flex-column">

									 <li class="nav-item">
                                        <a href="{{url('admin/master-customer')}}" class="nav-link {{((Request::is('admin/master-customer')) || (Request::is('admin/master-customer')) )?'active':''}}">Customer Details</a>
                                    </li>
									 <li class="nav-item">
                                        <a href="{{url('admin/master-branch')}}" class="nav-link {{((Request::is('admin/master-branch')) || (Request::is('admin/master-branch')) )?'active':''}}">Branch Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/employee-detsils-list')}}" class="nav-link {{((Request::is('admin/employee-detsils-list')) || (Request::is('admin/employee-detsils-list')) )?'active':''}}">Employee Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/fetchmodelwisetask')}}" class="nav-link {{((Request::is('admin/fetchmodelwisetask')) || (Request::is('admin/fetchmodelwisetask')) )?'active':''}}">Task Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/checksheetsection-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Checksheet Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/checksheetcolumn-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Checksheet Column Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/stddata-listing')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Standard Data Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-compinsp')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Component Inspection Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-transmission')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Transmission Inspection Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-othercomponent')}}" class="nav-link {{((Request::is('admin/fetch-othercomponent')) || (Request::is('admin/fetch-othercomponent')) )?'active':''}}">Other Component Details</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/fetch-assembly')}}" class="nav-link {{((Request::is('admin/fetch-assembly')) || (Request::is('admin/fetch-assembly')) )?'active':''}}">Assembly Details</a>
                                    </li>
                                 </ul>
                                
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples_2" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"
                               aria-controls="navbar-examples_2">
                                <i class="ni ni-briefcase-24 text-orange"></i>
                                <span class="nav-link-text">Report Section</span>
                            </a>
                            <div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples_2">
                                 <ul class="nav nav-sm flex-column">

									 <li class="nav-item">
                                        <a href="{{url('admin/componentstatusfacility-listing')}}" class="nav-link {{((Request::is('admin/componentstatusfacility-listing')) || (Request::is('admin/master-customer')) )?'active':''}}">Component Status Facility</a>
                                    </li>
									 <li class="nav-item">
                                        <a href="{{url('admin/jobdetails-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Job Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/menPower-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">ManPower Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/workorder-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">WorkOrder OR TAT Details</a>
                                    </li>
                                    <li class="nav-item">
                                         <a href="{{url('admin/bisreport-listing')}}" class="nav-link {{((Request::is('admin/bisreport-listing')) || (Request::is('admin/bisreport-listing')) )?'active':''}}">BIS Details</a>
                                     </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/labourJobActivity-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Labour Job Details</a>
                                    </li>
                                 </ul>
                                
                            </div>
                        </li>
                    </ul>
                    @endif
                    @endif
                    
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"
                           aria-controls="navbar-examples">
                            <i class="ni ni-briefcase-24 text-orange"></i>
                            <span class="nav-link-text">Menu</span>
                        </a>

                        <!-- Menu structure -->
                        <div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples">
                            <!--- THIS IS FOR BRANCH -->
                            <ul class="nav nav-sm flex-column">
                                @if (request()->session()->get('user')['section_id'] == '1')

                                    @if(request()->session()->get('user')['role_id'] == '1')
                                        <li class="nav-item">
                                        <a href="{{url('admin/service-request-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Service Request</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/support-quotation-list'))  )?'active':''}}">Download Quotation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('admin/spc-dashboard')}}" class="nav-link {{url('admin/showchecksheet')}}" class="nav-link {{((Request::is('admin/showchecksheet'))  )?'active':''}}">Upload PO</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                    @if(request()->session()->get('user')['role_id'] == '2')
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/service-request-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Service Request</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/support-quotation-list'))  )?'active':''}}">Download Quotation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/spc-dashboard')}}" class="nav-link {{url('admin/showchecksheet')}}" class="nav-link {{((Request::is('admin/showchecksheet'))  )?'active':''}}">Upload PO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif

                                @endif
                            </ul>
                            <!--- END OF BRANCH MENU -->

                            <!--- THIS IS FOR SUPPORT -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '2')<!--all-->

                            @if(request()->session()->get('user')['role_id'] == '1')<!--engineer-->
                                {{--<li class="nav-item">--}}
                                    {{--<a href="{{url('admin/service-request-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Service request</a>--}}
                                {{--</li>--}}
                                @endif
                                {{--<li class="nav-item">--}}
                                {{--<a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Open Workorder in SAP</a>--}}
                                {{--</li>--}}
                                <li class="nav-item">
                                    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Upload Quotation</a>
                                </li>
                                <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                @endif
                            </ul>
                            <!--- END OF SUPPORT MENU -->

                            <!--- THIS IS FOR RECEIVING -->
                            <ul class="nav nav-sm flex-column">
                                @if (request()->session()->get('user')['section_id'] == '3')

                                    @if(request()->session()->get('user')['role_id'] == '1')
                                        <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                    @else
                                   
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF RECEIVING MENU -->

                            <!--- THIS IS FOR ENG. DISASSEMBLY -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '4')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                     <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>-->
                                    <!--</li>-->
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->
                                     <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>
                                     <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF ENG. DISASSEMBLY MENU -->

                            <!--- THIS IS FOR TRAN. DISASSEMBLY -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '5')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                         <!--<a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Enter / Update  Disassembly Checklist</a>-->
                                        <a href="{{url('admin/trans-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Download Checklist in Excel</a>-->
                                    <!--</li>-->
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>-->
                                    <!--</li>-->
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/trans-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                @endif
                                <!-- NOT Confirmed YET-->

                                @endif
                            </ul>
                            <!--- END OF TRAN. DISASSEMBLY MENU -->


                             <!--- THIS IS FOR ENG. DISASSEMBLY -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '25')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                     <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>-->
                                    <!--</li>-->
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->

                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>

                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF ENG. DISASSEMBLY MENU -->


                             




                            <!--- THIS IS FOR HYD. COMP. DISASSEMBLY -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '13')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/hyd-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                {{--<li class="nav-item">--}}
                                {{--<a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>--}}
                                {{--</li>--}}
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/hyd-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF HYD. COMP. DISASSEMBLY MENU -->

                            <!--- THIS IS FOR MOR(DISASSEMBLY) -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '6')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                        <a href="{{url('admin/mor-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Assign To Department </a>
                                    </li>
									<li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>-->
                                    <!--</li>-->
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>
									 <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/mor-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Assign To Department</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF MOR MENU -->

                            <!--- THIS IS FOR UNDERCARRIGE(DISASSEMBLY) -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '7')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        
                                        <a href="{{url('admin/undercarg-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create / Update Quotation in SAP</a>-->
                                    <!--</li>-->
                                @endif

                                @if(request()->session()->get('user')['role_id'] == '2')<!-- Head -->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/undercarg-diss-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Disassembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF UNDERCARRIGE MENU -->

                            <!--- THIS IS FOR SPC -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '20')

                                @if(request()->session()->get('user')['role_id'] == '3')<!--Engineer-->
                                    {{--<li class="nav-item">--}}
                                    {{--<a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Update Service Request</a>--}}
                                    {{--</li>--}}
                                    <li class="nav-item">
                                        <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/service-request-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Service Request List</a>
                                    </li>
                                   <li class="nav-item">
                                    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}"> Upload Quotation</a>
                                </li>
                                <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif

                                @endif
                                @if (request()->session()->get('user')['section_id'] == '24')

                                @if(request()->session()->get('user')['role_id'] == '4')<!--Engineer-->
                                    {{--<li class="nav-item">--}}
                                    {{--<a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Update Service Request</a>--}}
                                    {{--</li>--}}
                                    <li class="nav-item">
                                        <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
									<li class="nav-item">
                                        <a href="{{url('admin/service-request-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Service Request List</a>
                                    </li>
                                   
                                    @endif

                                @endif
                                @if (request()->session()->get('user')['section_id'] == '8')

                                @if(request()->session()->get('user')['role_id'] == '1' || request()->session()->get('user')['role_id'] == '2')<!--Engineer-->
                                   <li class="nav-item">
                                    <a href="{{url('admin/support-quotation-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}"> Upload Quotation</a>
                                </li>
                                <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif

                                @endif
                            </ul>
                            <!--- END OF SPC MENU -->

                            <!--- THIS IS FOR STORE -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '9')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                    <a href="{{url('admin/store-list')}}" class="nav-link {{((Request::is('admin/store-list')) || (Request::is('admin/servirequest')) )?'active':''}}">Store Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{url('admin/store-list')}}" class="nav-link {{((Request::is('admin/store-list')) || (Request::is('admin/servirequest')) )?'active':''}}">Store Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    @endif

                                @endif
                            </ul>
                            <!--- END OF STORE MENU -->

                            <!--- THIS IS FOR ENG ASSEMBLY & TESTING SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '10')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-ass-list')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">
                                            Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-ass-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF ENG ASSEMBLY & TESTING SECTION MENU -->


                             <!--- THIS IS FOR ENG ASSEMBLY & TESTING SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '26')

                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->

                                     <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>

                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-ass-list')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">
                                            Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->

                                        <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>
                                    
                                     <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/engine-ass-list')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">
                                            Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF ENG ASSEMBLY & TESTING SECTION MENU -->

                            <!--- THIS IS FOR TRAN ASSEMBLY & TESTING SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '11')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/trans-ass-list')}}" class="nav-link {{((Request::is('admin/engine-diss-list')) || (Request::is('admin/engine-diss-list')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                     </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/trans-ass-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF ENG ASSEMBLY & TESTING SECTION MENU -->

                            <!--- THIS IS FOR HYD. COMP. ASSEMBLY & TESTING SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '12')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/hyd-ass-list')}}" class="nav-link {{((Request::is('admin/engine-diss-list')) || (Request::is('admin/engine-diss-list')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}"> Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/hyd-ass-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF HYD. COMP. ASSEMBLY & TESTING SECTION MENU -->

                            <!--- THIS IS FOR MOR ASSEMBLY SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '14')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-pdilist')}}" class="nav-link {{((Request::is('bis-listing')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">PDI Checklist 11</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF MOR ASSEMBLY SECTION MENU -->

                            <!--- THIS IS FOR UNDERCARRIAGE ASSEMBLY SECTION -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '15')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/undercarg-ass-list')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                    <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>
                                    <li class="nav-item">
                                            <a href="{{url('admin/servicedashboard-checkgateone')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 1</a>
                                        </li>
                                        <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatetwo')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 2 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/undercarg-ass-list')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">Assembly Checklist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">
                                            BIS Listing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    
                                    @endif
                                @endif
                            </ul>
                            <!--- END OF UNDERCARRIAGE ASSEMBLY SECTION MENU -->
                            <!--- THIS IS FOR SPC -->
                            @if (request()->session()->get('user')['section_id'] == '20')
                                <ul class="nav nav-sm flex-column">
                                @if(request()->session()->get('user')['role_id'] == '3')<!--Engineer-->
                                <!--<li class="nav-item">
                                        <a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Update Service Request</a>
                                    </li>-->
                                    <!--<li class="nav-item">
                                        <a href="#" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                    </li>-->
                                    
                                    @endif
                                </ul>
                        @endif
                        <!--- This is for QAQC MENU -->
                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '21')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <!--<li class="nav-item">-->
                                    <!--    <a href="#" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">PDI Checklist</a>-->
                                    <!--</li>-->
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatefour')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 4</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                    @endif
                                     @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
                                      <li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>
                                    <!--  <li class="nav-item">-->
                                    <!--    <a href="#" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">PDI Checklist</a>-->
                                    <!--</li>-->
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatefour')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Check Gate 4</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                    @endif
                                @endif
                            </ul>
                        <!--- END OF SPC MENU -->
                        
						<!--- Start OF Dispatch MENU -->
                        <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '22')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/certificate-list')}}" class="nav-link {{((Request::is('certificate-list')) || (Request::is('admin/certificate-list')) )?'active':''}}">Test Certificate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{url('admin/service-pdilist')}}" class="nav-link {{((Request::is('admin/engine-ass-list')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">PDI Checklist hh</a>
                                    </li>

                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
								<li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>
                                   <!--  <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-pdilist')}}" class="nav-link {{((Request::is('bis-listing')) || (Request::is('admin/engine-ass-list')) )?'active':''}}">PDI Checklist</a>
                                    </li> -->

                                     

                                    <li class="nav-item">
                                        <a href="{{url('admin/certificate-list')}}" class="nav-link {{((Request::is('certificate-list')) || (Request::is('admin/certificate-list')) )?'active':''}}">Test Certificate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                @endif
                                @endif
                            </ul>

                            <ul class="nav nav-sm flex-column">
                            @if (request()->session()->get('user')['section_id'] == '23')
                                @if(request()->session()->get('user')['role_id'] == '1')<!--Engineer-->
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servicedashboard-checkgatethree')) || (Request::is('admin/servicedashboard-checkgatethree')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">BIS Listing</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('admin/test_report')}}" class="nav-link {{((Request::is('admin/test_report')) || (Request::is('admin/test_report')) )?'active':''}}">Test Report</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>

                                @endif
                                @if(request()->session()->get('user')['role_id'] == '2')<!--Head-->
								<li class="nav-item">
                                                <a href="{{url('admin/projects-open-list')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Project Plan</a>
                                      </li>

                                   
                                     
                                    <li class="nav-item">
                                        <a href="{{url('admin/servicedashboard-checkgatethree')}}" class="nav-link {{((Request::is('admin/servicedashboard-checkgatethree')) || (Request::is('admin/servicedashboard-checkgatethree')) )?'active':''}}">Check Gate 3</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('admin/bis-listing')}}" class="nav-link {{((Request::is('admin/bis-listing')) || (Request::is('admin/bis-listing')) )?'active':''}}">BIS Listing</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('admin/test_report')}}" class="nav-link {{((Request::is('admin/test_report')) || (Request::is('admin/test_report')) )?'active':''}}">Test Report</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{url('admin/time-sheet-listing')}}" class="nav-link {{((Request::is('admin/jobdetails-listing')) || (Request::is('admin/master-branch')) )?'active':''}}">Time Sheet Details</a>
                                    </li>
                                @endif
                                @endif
                            </ul>


                        </div>
                        <!-- Menu structure end -->
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</nav>



{{--@if(request()->session()->get('user')['role_id'] == '1')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/check-gate-form-one')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Check Gate One</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endif--}}
{{----}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/service-request-latest-list')}}" class="nav-link"><i class="ni ni-briefcase-24 text-orange"></i>Check gate 1 view</a>--}}
{{--</li>--}}
{{----}}
{{----}}
{{--@hasrole('branch_engineer')--}}
{{----}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{(Request::is('admin/service-request*')) ?'active':''}}" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"--}}
{{--aria-controls="navbar-examples">--}}
{{--<i class="ni ni-briefcase-24 text-orange"></i>--}}
{{--<span class="nav-link-text">Service request</span>--}}
{{--</a>--}}
{{--<div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples">--}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/service-request-add')}}" class="nav-link {{((Request::is('admin/service-request-add')) || (Request::is('admin/service-request-add-save')) )?'active':''}}">New service request</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/service-request-list')}}" class="nav-link {{url('admin/service-request-add')}}" class="nav-link {{((Request::is('admin/service-request-list'))  )?'active':''}}">All service request</a>--}}
{{--</li>--}}

{{--</ul>--}}


{{--</a>--}}
{{--</div>--}}

{{--</li>--}}

{{--<li class="nav-item">--}}

{{--<div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples">--}}
{{--<ul class="nav nav-sm flex-column">--}}

{{--</ul>--}}
{{--</div>--}}
{{--</li>--}}



{{--<li class="nav-item">--}}
{{--<a class="nav-link " href="{{url('admin/quotation-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Quotations</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{(Request::is('admin/*')) ?'active':''}}" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/*')) ?'true':'false'}}"--}}
{{--aria-controls="navbar-examples">--}}
{{--<i class="ni ni-briefcase-24 text-orange"></i>--}}
{{--<span class="nav-link-text">Master</span>--}}
{{--</a>--}}
{{--<div class="collapse {{(Request::is('admin/branch-request*')) ?'show':''}}" id="navbar-examples">--}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/branch-list')}}" class="nav-link {{((Request::is('admin/branch-list')) || (Request::is('admin/branch-list')) )?'active':''}}">Branch</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/segment-list')}}" class="nav-link {{url('admin/segment-list')}}" class="nav-link {{((Request::is('admin/segment-list'))  )?'active':''}}">Segment</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link " href="{{url('admin/branch-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Branch</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link " href="{{url('admin/segment-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Segment</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{----}}

{{--@hasrole('super_admin')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link active" href="#navbar-examples-mas" data-toggle="collapse" role="button" aria-expanded="false"--}}
{{--aria-controls="navbar-examples-mas">--}}
{{--<i class="ni ni-briefcase-24 text-orange"></i>--}}
{{--<span class="nav-link-text">Master</span>--}}
{{--</a>--}}
{{--<div class="collapse show" id="navbar-examples-mas">--}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/user-list')}}" class="nav-link">User List</a>--}}
{{--</li>--}}
{{--<a href="{{url('admin/master-customer')}}" class="nav-link">Customer</a>--}}

{{--<a href="{{url('admin/master-branch')}}" class="nav-link">Branch</a>--}}
{{--<a href="{{url('admin/master-machine')}}" class="nav-link">Machine details</a>--}}
{{--<a href="{{url('admin/fetchmodelwisetask')}}" class="nav-link">Task Details</a>--}}


{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/employee-detsils-list')}}" class="nav-link">Employee Details</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/employee-section-desig-role-list')}}" class="nav-link">Section Designation</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/branch-list')}}" class="nav-link {{((Request::is('admin/branch-list')) || (Request::is('admin/branch-list')) )?'active':''}}">Branch</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/segment-list')}}" class="nav-link {{url('admin/segment-list')}}" class="nav-link {{((Request::is('admin/segment-list'))  )?'active':''}}">Segment</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/fetch')}}" class="nav-link">Component Model List</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/fetchserial')}}" class="nav-link">Component Serial List</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/fetchmachinemodel')}}" class="nav-link">Machine Model List</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/fetch-machine-serial')}}" class="nav-link">Machine Serial List</a>--}}
{{--</li>--}}

{{--</ul>--}}
{{--</div>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link active" href="#navbar-examples-pro" data-toggle="collapse" role="button" aria-expanded="false"--}}
{{--aria-controls="navbar-examples">--}}
{{--<i class="ni ni-briefcase-24 text-orange"></i>--}}
{{--<span class="nav-link-text">Projects</span>--}}
{{--</a>--}}
{{--<div class="collapse show" id="navbar-examples-pro">--}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/projects-open-list')}}" class="nav-link">Open projects</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/projects-completed-list')}}" class="nav-link active">Completed projects</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</li>--}}
{{--@endrole--}}

{{--@hasrole('service_engineer')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/check-sheet-entry')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Check Sheet Entry</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/service-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Service List</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('support')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/support-quotation-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Upload Quotation</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}


{{--@hasrole('dept_eng')--}}
{{--@if(request()->session()->get('user')['role_id'] == '1' && request()->session()->get('user')['section_id'] == '4')--}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{----}}
{{--<a href="{{url('admin/servirequest')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">aaaaaa</a>--}}
{{--</li>--}}
{{--@endif--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/engine-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Engine Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="#">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Engine Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--@endrole--}}

{{--@hasrole('dept_eng_disassembly')--}}
{{----}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link {{(Request::is('admin/service-request')) ?'active':''}}" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="{{(Request::is('admin/service-request*')) ?'true':'false'}}"--}}
{{--aria-controls="navbar-examples">--}}
{{--<i class="ni ni-briefcase-24 text-orange"></i>--}}
{{--<span class="nav-link-text">Menu</span>--}}
{{----}}
{{--</a>--}}
{{----}}
{{--<!-- Menu structure -->--}}
{{----}}
{{----}}
{{--<div class="collapse {{(Request::is('admin/service-request*')) ?'show':''}}" id="navbar-examples">--}}
{{----}}
{{----}}
{{--<ul class="nav nav-sm flex-column">--}}
{{--<li class="nav-item">--}}
{{----}}
{{--<a href="{{url('admin/servirequest')}}" class="nav-link {{((Request::is('admin/servirequest')) || (Request::is('admin/servirequest')) )?'active':''}}">Create Service Request</a>--}}
{{--</li>--}}
{{----}}
{{--<!--@if(request()->session()->get('user')['role_id'] == '1' && request()->session()->get('user')['section_id']=='4')--}}
{{----}}
{{--<li class="nav-item">--}}
{{--<a href="{{url('admin/engine-diss-list')}}" class="nav-link {{((Request::is('admin/engine-diss-list')) || (Request::is('admin/engine-diss-list')) )?'active':''}}">Engine Disassembly</a>--}}
{{--</li>--}}
{{----}}
{{----}}
{{--@endif-->--}}
{{----}}
{{--@endrole--}}

{{--@hasrole('dept_eng_assembly')--}}
{{--@if(request()->session()->get('user')['role_id'] == '1') && ['section_id']=='10')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="#">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Engine Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endif--}}
{{--@endrole--}}

{{--@hasrole('dept_trans')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/trans-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Trans Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Trans Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_trans_assembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Trans Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_trans_disassembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/trans-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Trans Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{--@hasrole('dept_hyd')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/hyd-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Hyd Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Hyd Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_hyd_assembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Hyd Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_hyd_disassembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/hyd-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Hyd Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{--@hasrole('dept_mor')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/mor-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">MOR Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">MOR Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{--@hasrole('dept_mor_asembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">MOR Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_mor_disasembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/mor-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">MOR Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{--@hasrole('dept_undercarriage')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/undercarg-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Undercarriage Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Undercarriage Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_undercarriage_assembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Undercarriage Assembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}
{{--@hasrole('dept_undercarriage_disassembly')--}}
{{--<li class="nav-item">--}}
{{--<a class="nav-link" href="{{url('admin/undercarg-diss-list')}}">--}}
{{--<i class="ni ni-archive-2 text-green"></i>--}}
{{--<span class="nav-link-text">Undercarriage Disassembly</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--@endrole--}}

{{--</ul>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</nav>--}}

