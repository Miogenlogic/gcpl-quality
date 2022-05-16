@extends('admin.include.layout')
<!-- Project List -->@section('head')
    <div class="header pb-6 pt-4 d-flex align-items-center" style="min-height: 200px; background-image: url('{{URL::asset('public/assets/img/theme/topography.svg')}}'); background-size: cover; background-position: center top;">
        <!-- Mask --> <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid align-items-center">
            <div class="row">
                <div class="col-lg-10 col-md-10">
                    <h1 class="display-3 text-white font-weight-500">#{{$project_plan['name']}}.</h1>
                    <p class="text-white mt-0 mb-5"></p>
                </div>
            </div>
        @php
            //echo '<pre>';print_r($tasks[0]['dept_id']);exit;
        @endphp
        <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Total task</h5>
                                    <span class="h2 font-weight-bold mb-0">@php echo count($tasks); @endphp</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow"> <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Open task</h5>
                                    <span class="h2 font-weight-bold mb-0">@php echo count($tasks); @endphp</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow"> <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Days left</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$project_plan['estm_days']}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow"> <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 font-weight-500">Emp. assigned</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$service_assigned_user}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow"> <i class="ni ni-briefcase-24"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>@endsection @section('body')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <!-- Card header -->
                    @php
                        //echo '<pre>';print_r($service_details['work_orderno']);exit;
                    @endphp

                    <div class="nav-wrapper px-0">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item"> <a class="nav-link mb-sm-3 mb-md-0 active" id="project-details-tab" data-toggle="tab" href="#project-details" role="tab" aria-controls="project-details" aria-selected="true"><i class="ni ni-align-left-2 mr-2"></i>Details</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link mb-sm-3 mb-md-0" id="task-tab" data-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="false"><i class="ni ni-bullet-list-67 mr-2"></i>Task</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link mb-sm-3 mb-md-0" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false"><i class="ni ni-collection mr-2"></i>Notes</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- Project Details Tab -->
                        <div class="tab-pane fade show active" id="project-details" role="tabpanel" aria-labelledby="project-details-tab">
                            <div class="row">
                                <!-- Project details -->
                                <div class="col-xl-7">
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header">
                                            <!-- Title -->
                                            <h5 class="h3 mb-0">Project details</h5>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <!-- List group -->
                                            <ul class="list-group list-group-flush list my--3">
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Component sl. No.</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            @if(isset($compserialno))
                                                            <h4 class="mb-0 font-weight-600">{{$compserialno[0]['comp_serial_no']}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Machine sl. No.</h4>
                                                        </div>
                                                        <div class="col-6">
                                                             @if(isset($compmodelno))
                                                            <h4 class="mb-0 font-weight-600">{{$compmodelno[0]['comp_model_no']}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Project ID</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-600">{{$project_plan['project_id']}}</h4>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Work Order No</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-600">{{$service_details['work_orderno']}}</h4>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Model No</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            @if(isset($model_name->model_name))
                                                            <h4 class="mb-0 font-weight-600">{{$model_name->model_name}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Component</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            @if(isset($service_details['component_name']))
                                                            <h4 class="mb-0 font-weight-600">{{$service_details['component_name']}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Customer Name</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            @if(isset($project_plan['customer_name']))
                                                            <h4 class="mb-0 font-weight-600">{{$project_plan['customer_name']}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                 <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Dept Name</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            @if(isset($project_plan['dept_name']))
                                                            <h4 class="mb-0 font-weight-600">{{$project_plan['dept_name']}}</h4>
                                                            @else
                                                             <h4 class="mb-0 font-weight-600"></h4>
                                                             @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <!--<li class="list-group-item px-0 py-2">-->
                                                <!--    <div class="row align-items-center">-->
                                                <!--        <div class="col-6">-->
                                                <!--            <h4 class="mb-0 font-weight-500">Client</h4>-->
                                                <!--        </div>-->
                                                <!--        <div class="col-6">-->
                                            <!--            <h4 class="mb-0 font-weight-600">{{$project_plan['customer_id']}}.</h4>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</li>-->
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Estimated start date</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-600">{{ date('d/m/Y',strtotime($project_plan['estm_start_date']))}}</h4>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Estimated end date</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-600">{{ date('d/m/Y',strtotime($project_plan['estm_end_date']))}}</h4>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-500">Created on</h4>
                                                        </div>
                                                        <div class="col-6">
                                                            <h4 class="mb-0 font-weight-600">{{ date('d/m/Y',strtotime($project_plan['estm_start_date']))}}</h4>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <!-- Assigned users -->
                                    <div class="card">
                                        <!-- Card header -->

                                        @php
                                            //echo '<pre>';print_r($project_plan['dept_id']);exit;

                                        @endphp
                                        @if (request()->session()->get('user')['section_id'] == $project_plan['dept_id'])
                                            @if(request()->session()->get('user')['role_id'] == '2')
                                                <div class="card-header">
                                                    <!-- Title -->
                                                    <h5 class="h3 mb-0 d-inline-block">Assigned users</h5>
                                                    {{--<button type="button" class="float-right btn btn-sm btn-default" data-toggle="modal" data-target="#assign-user">Assign</button>--}}
                                                </div>
                                        @endif
                                    @endif
                                    <!-- Card body -->
                                        <div class="card-body" style="height: 208px;overflow: auto;">
                                            <div class="scrollbar-inner">
                                                <!-- List group -->
                                                <ul class="list-group list-group-flush list my--3">
                                                    <?php if(!empty($emp_details)){ foreach ($emp_details as $key=>$emp_detail) { ?>
                                                    <li class="list-group-item px-0 py-1">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <!-- Avatar -->
                                                                <a href="#" class="avatar rounded-circle">
                                                                    <i class="far fa-user"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                               
                                                                <h5>{{$emp_detail['name']}} - {{$emp_detail['emp_code']}}</h5>
                                                           
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php }} ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Assign user modal -->
                            <div class="modal fade" id="assign-user" tabindex="-1" role="dialog" aria-labelledby="assign-user" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary shadow border-0 mb-0">
                                                <div class="card-header bg-transparent">
                                                    <h4 class="text-primary text-center">Assign user </h4>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <div class="text-center text-muted mb-4"> <small>You can select/tag one or more user from the below select box for this       project</small>
                                                    </div>
                                                    <?php $prj_emp_codes=explode( ',',$project_user[ 'users']); ?>
                                                    <form action="{{url('admin/assign-user-project')}}" method="post" enctype="multipart/form-data">
                                                        <div class="form-group mb-3">
                                                            <div class="input-group input-group-alternative">
                                                                <input type="hidden" name="prj_user_id" value="{{$project_user['id']}}">
                                                                <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                <select name="asign_user[]" id="" data-toggle="select" class="form-control" multiple="multiple">
                                                                    <option selected disabled>--select users--</option>
                                                                    <?php if(!empty($dept_employees)){ foreach ($dept_employees as $key=>$dept_employee) { if(in_array($dept_employee['emp_code'],$prj_emp_codes)){ $select="selected"; }else{ $select=""; } ?>
                                                                    <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                    <?php }} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                                            {{--<input type="checkbox" class="custom-control-input" name="notifymailproj" id="customCheckLogin"  value="notify">
                                                            <label class="custom-control-label" for=" customCheckLogin"> <span class="text-muted">Notify user</span>
                                                            </label>--}}
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="notifymailproj" id="customCheckLogin"  value="notify">Notify user
                                                            </label>
                                                        </div>
                                                        <div class="text-center">
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            <button type="submit" class="btn btn-primary my-4">Assign</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Assign user modal -->
                        </div>
                        <!-- Project Task tab -->
                        <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="task-tab">
                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- Assigned users -->
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header">
                                            <!-- Title -->
                                            <h5 class="h3 mb-0 d-inline-block">Task list</h5>
                                            {{--<button type="button" class="float-right btn btn-sm btn-default" data-toggle="modal" data-target="#new-task-modal">New task</button>--}}
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <div class="comments-container">
                                                <ul id="comments-list" class="comments-list">

                                                    @php
                                                    //echo '<pre>';print_r($dept);exit;
                                                    @endphp
                                                    <?php if(!empty($tasks)){
                                                     $type='' ;
$usr=0;
                                                    $parentTask=[];
                                                    foreach ($tasks as $key=>$task) {

                                                       if($project_plan['dept_id']!= '6'){
                                                            $parentTask=App\Helpers\UserHelper::checkParentTask($task['id'],$project_plan['dept_id'],$service_details['machine_modelno']);

                                                            }
                                                       else{
                                                           $das = 0;

                                                            foreach ($dept as $key=>$deptformor) {

                                                            $parentTask[$das]=App\Helpers\UserHelper::checkParentTask($task['id'],$deptformor,$service_details['machine_modelno']);

                                                            $das++;

                                                            }

                                                       }


                                                    //dd($parentTask);
                                                    $parent_task_tat = 0;
                                                    if(!empty($parentTask)){
                                                        foreach($parentTask as $key=>$parenttask){


                                                                foreach($parenttask as  $parenttask1){

//
                                                                    if($project_plan['dept_id']== '6'){
                                                                        $parent_task_tat += $parenttask1['tat'];//for multiple dept
                                                                       // break;
                                                                    }

                                                                }
                                                           if($project_plan['dept_id']!= '6'){
                                                            $parent_task_tat += $parenttask['tat'];//for single dept
                                                            //rkle one dpt thik hche
                                                           }
                                                        }
                                                        //echo '<pre>';print_r($parent_task_tat); exit;
                                                        $number = $parent_task_tat.' days';
                                                        $estm_end_date=date_create($project_plan['estm_start_date']);
                                                        date_add($estm_end_date,date_interval_create_from_date_string($number));
                                                        $parent_task_end_date = date_format($estm_end_date,"Y-m-d");
                                                    }

                                                    $task_user_det = App\Helpers\UserHelper::taskUserDet($task['id'],$project_plan['id']);
                                                    
                                                    
                                              if(empty($task['parent']) && !empty($task['predicessor'])){
                                                        $type = '';
                                                    }
                                                    //for this  change && to || in first elseif condition
                                                    elseif(empty($parentTask) || !empty($task['parent'])){
                                                        $type = 'hidden';
                                                    }
                                                    elseif(empty($parentTask) && empty($task['parent'])){
                                                        $type = '';
                                                    }

                                                    else{
                                                        $type = '';
                                                    }
                                                    //dd($task_user_det);
                                                    if(!empty($task_user_det) && !empty($task_user_det[0]['users'])){
                                                        $emp_det=App\Helpers\UserHelper::empDetails($task_user_det[0]['users']);
                                                         //echo "<pre>";print_r($emp_det);exit;
                                                    }

                                                    ?>
                                                    <li class="has-subtask" {{$type}}>
                                                        <div class="comment-main-level">
                                                            <div class="comment-box">
                                                                <!-- Subtask toggle action -->
                                                                <?php if(!empty($parentTask)){ ?> <i class="subtask-toggle-action fa fa-plus" data-toggle="collapse" data-target="#showsubtask_{{$task['id']}}" aria-expanded="false" aria-controls="showsubtask_{{$task['id']}}"></i>
                                                            <?php } ?>
                                                            <!-- Use this action if there`s subtask exsited on the task thread -->
                                                                <div class="comment-head">

                                                                    <h6 class="comment-name">@if($task['dept_id'] == '4')  Engine  @elseif($task['dept_id'] == '5')  Transmission @elseif($task['dept_id'] == '7')  Undercarriage @elseif($task['dept_id'] == '13')  Hydraulic @endif {{$task['name']}}</h6>
                                                                    <span class="badge badge-success">created date: {{date('d/m/Y',strtotime($project_plan['estm_start_date']))}}</span>
                                                                   <span class="badge badge-info">estmd start end date: {{date('d/m/Y',strtotime($task_user_det[0]['est_start_date']))}}-<?php echo(!empty($task_user_det[0]['est_end_date']) ? date('d/m/Y',strtotime($task_user_det[0]['est_end_date'])) : date('d/m/Y',strtotime($project_plan['estm_end_date']))); ?></span>
                                                                    @if (request()->session()->get('user')['section_id'] == $task['dept_id'])
                                                                        @if(request()->session()->get('user')['role_id'] == '2')
                                                                            {{--<button type="button" class="float-right btn btn-sm btn-default" data-toggle="modal" data-target="#new-task-modal_{{$task['id']}}">+</button>--}}
                                                                    @endif
                                                                @endif
                                                                <!-- Assigned users -->
                                                                    <div class="avatar-group mr-3 float-right no-line-height">
                                                                        <?php
                                                                        if(!empty($task_user_det) && !empty($task_user_det[0]['users'])){
                                                                        if(!empty($emp_det)){
                                                                        foreach ($emp_det as $key => $emp) {
                                                                        ?>
                                                                        <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$emp['name']}}">
                                                                            <i class="far fa-user"></i>
                                                                        </a>
                                                                        <?php }} } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="comment-content">
                                                                    <!--<p>{{$task['description']}}</p>
                                                                    <!-- Date meta -->
                                                                    <div class="date-meta">
                                                                        <form action="{{url('admin/edit-task')}}" method="post" enctype="multipart/form-data">
                                                                            <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                            <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                            <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                            <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                                            <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                                            <input type="hidden" name="task_user_id">
                                                                            <input type="hidden" name="task_id" value="{{$task['id']}}">
                                                                            <div class="row input-daterange datepicker align-items-center">
                                                                                <div class="col-3">
                                                                                    <div class="form-group mb-0">
                                                                                        <label class="form-control-label">Actual start date</label>
                                                                                        <input class="form-control input-group-alternative" placeholder="Start date" type="date" name="actual_strt_dt" value="<?php echo(!empty($task_user_det[0]['actual_strt_dt']) ? $task_user_det[0]['actual_strt_dt'] : '')?>" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <div class="form-group mb-0">
                                                                                        <label class="form-control-label">End date</label>
                                                                                        <input class="form-control input-group-alternative" placeholder="End date" type="date" name="end_dt" value="<?php echo(!empty($task_user_det[0]['end_dt']) ? $task_user_det[0]['end_dt'] : '')?>" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <!--<div class="col-4">
                                                                                    <div class="form-group mb-0">
                                                                                        <label class="form-control-label">Comments</label>
                                                                                        <textarea class="form-control input-group-alternative" placeholder="Comments" rows="1" name="comment" readonly>
                                                                                        <?php echo(!empty($task_user_det[0][ 'comment']) ? $task_user_det[0][ 'comment'] : '')?>
                                                                                    </textarea>
                                                                                    </div>
                                                                                </div>-->

                                                                                <div class="col-3">
                                                                                    @if (request()->session()->get('user')['section_id'] == $task['subdept_id'])
                                                                                        @if(request()->session()->get('user')['role_id'] == '2')
                                                                                            {{--<button class="btn btn-default btn-sm" type="submit">update</button>--}}
                                                                                            <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#assign-usertask_{{$task['id']}}">Assign User</button>
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                        </form>


                                                                    </div>
                                                                    <!-- /Data meta -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Subtask -->
                                                        <?php if(!empty($parentTask)){ ?>

                                                        <div class="collapse"  id="showsubtask_{{$task['id']}}">
                                                        <?php if($project_plan['dept_id']!= '6'){ ?>
                                                            <ul class=" comments-list reply-list  childlist_{{$task['id']}}">
                                                            <?php foreach ($parentTask as $key=>$parent) {
                                                            //foreach ($parent1 as $parent){
                                                            $task_child_user_det = App\Helpers\UserHelper::taskUserDet($parent['id'],$project_plan['id']);
                                                            // echo "<pre>";print_r($task_child_user_det);


                                                            if(!empty($task_child_user_det) && !empty($task_child_user_det[0]['users'])){
                                                                $emp_det_child=App\Helpers\UserHelper::empDetails($task_child_user_det[0]['users']);
                                                                // echo "<pre>";print_r($emp_det_child);
                                                            }


                                                            ?>

                                                            <!-- Assign user SubTASk modal -->
                                                                <div class="modal fade" id="assign-user_{{$parent['id']}}" tabindex="-1" role="dialog" aria-labelledby="assign-user" aria-hidden="true">
                                                                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body p-0">
                                                                                <div class="card bg-secondary shadow border-0 mb-0">
                                                                                    <div class="card-header bg-transparent">
                                                                                        <h4 class="text-primary text-center">Assign user mor</h4>
                                                                                    </div>
                                                                                    <div class="card-body px-lg-5 py-lg-5">
                                                                                        <div class="text-center text-muted mb-4"> <small>You can select/tag one or more user from the below select box for this       project</small>
                                                                                        </div>
                                                                                        <?php $prj_emp_codes=explode( ',',$project_user[ 'users']); ?>
                                                                                        <?php
                                                                                        //dd($task_user);

                                                                                       // dd($prj_emp_codes);

                                                                                        ?>

                                                                                        <form action="{{url('admin/assign-user-project-task')}}" method="post" enctype="multipart/form-data">
<!--                                                                                            --><?php // dd($task_user[0]['users']);die;?>
                                                                                            <div class="form-group mb-3">
                                                                                                <div class="input-group input-group-alternative">
                                                                                                    <input type="hidden" name="prj_user_id" value="{{$project_user['id']}}">
                                                                                                    <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                                    <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                                    <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                                    <input type="hidden" name="parent_task_id" value="{{$parent['id']}}">
                                                                                                    <select name="asign_user_task[]" id="" data-toggle="select" class="form-control" multiple="multiple">
                                                                                                        <option selected disabled>--select users--</option>

                                                                                                        <?php if(!empty($dept_employees)){ foreach ($dept_employees as $key=>$dept_employee) {

                                                                                                             if(in_array($dept_employee['emp_code'],$prj_emp_codes)){ $select="selected"; }else{ $select="";
                                                                                                            } ?>
                                                                                                        <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                                                        <?php }} ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="custom-control custom-control-alternative custom-checkbox">
                                                                                                <input class="custom-control-input" id=" customCheckLogin1" type="checkbox" name="" value="notify">
                                                                                                <label class="custom-control-label" for=" customCheckLogin1"> <span class="text-muted">Notify user</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                                <button type="submit" class="btn btn-primary my-4">Assign</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Assign user SubTASk  modal -->
                                                                @php
                                                                    //echo "<pre>";print_r($parent);exit;
                                                                @endphp
                                                                <li>
                                                                    <div class="comment-box">
                                                                        <div class="comment-head">
                                                                            <h6 class="comment-name">{{$parent['name']}}</h6>
                                                                            <span class="badge badge-success">created date: {{date('d/m/Y',strtotime($project_plan['estm_start_date']))}}</span>
                                                                            <!-- Assigned users -->
                                                                            <div class="avatar-group float-right no-line-height">
                                                                                <?php
                                                                                if(!empty($emp_det_child)){
                                                                                foreach ($emp_det_child as $key => $emp_child) {
                                                                                ?>
                                                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$emp_child['emp_code']}}">
                                                                                    <i class="far fa-user"></i>
                                                                                </a>
                                                                                <?php }} ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comment-content">
                                                                            <!--<p>{{$parent['description']}}</p>-->
                                                                            <!-- Date meta -->
                                                                            <div class="date-meta">
                                                                                <form action="{{url('admin/edit-task')}}" method="post" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                    <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                    <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                    <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                                                    <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                                                    <input type="hidden" name="task_id" value="{{$parent['id']}}">
                                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                    <div class="row input-daterange datepicker align-items-center">
                                                                                        <div class="col-3">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">Actual start date</label>
                                                                                                <input class="form-control input-group-alternative" name="actual_strt_dt" placeholder="Start date" type="date" value="<?php echo(!empty($task_child_user_det[0]['actual_strt_dt']) ? $task_child_user_det[0]['actual_strt_dt'] : '')?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-2">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">End date</label>
                                                                                                <input class="form-control input-group-alternative" name="end_dt" placeholder="End date" type="date" value="<?php echo(!empty($task_child_user_det[0]['end_dt']) ? $task_child_user_det[0]['end_dt'] : '')?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--<div class="col-4">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">Comments</label>
                                                                                                <textarea class="form-control input-group-alternative" name="comment" placeholder="Comments" rows="1" readonly>
                                                                                            <?php echo(!empty($task_child_user_det[0][ 'comment']) ? $task_child_user_det[0][ 'comment'] : '')?>
                                                                                        </textarea>
                                                                                            </div>
                                                                                        </div>-->
                                                                                        @php
                                                                                            // echo'<pre>';print_r($tasks);exit;
                                                                                        @endphp

                                                                                        <div class="col-3">
                                                                                            @if (request()->session()->get('user')['section_id'] == $task['dept_id'])
                                                                                                @if(request()->session()->get('user')['role_id'] == '2')
                                                                                                    {{--<button class="btn btn-default btn-sm" type="submit">update</button>--}}
                                                                                                    {{--<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#assign-user_{{$parent['id']}}">Assign User</button>--}}
                                                                                                @endif
                                                                                            @endif
                                                                                        </div>

                                                                                    </div>
                                                                                </form>


                                                                            </div>
                                                                            <!-- /Data meta -->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php }?>
                                                            </ul>
                                                      <?php  }else{ ?>
                                                            <ul class=" comments-list reply-list  childlist_{{$task['id']}}">
                                                            <?php foreach ($parentTask as $key=>$parent1) {
                                                                foreach ($parent1 as $parent){
                                                            $task_child_user_det = App\Helpers\UserHelper::taskUserDet($parent['id'],$project_plan['id']);
                                                            // echo "<pre>";print_r($task_child_user_det);


                                                            if(!empty($task_child_user_det) && !empty($task_child_user_det[0]['users'])){
                                                                $emp_det_child=App\Helpers\UserHelper::empDetails($task_child_user_det[0]['users']);
                                                                // echo "<pre>";print_r($emp_det_child);
                                                            }


                                                            ?>

                                                            <!-- Assign user SubTASk modal -->
                                                                <div class="modal fade" id="assign-user_{{$parent['id']}}" tabindex="-1" role="dialog" aria-labelledby="assign-user" aria-hidden="true">
                                                                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body p-0">
                                                                                <div class="card bg-secondary shadow border-0 mb-0">
                                                                                    <div class="card-header bg-transparent">
                                                                                        <h4 class="text-primary text-center">Assign user</h4>
                                                                                    </div>
                                                                                    <div class="card-body px-lg-5 py-lg-5">
                                                                                        <div class="text-center text-muted mb-4"> <small>You can select/tag one or more user from the below select box for this       project</small>
                                                                                        </div>
                                                                                        <?php $prj_emp_codes=explode( ',',$project_user[ 'users']); ?>
                                                                                        <form action="{{url('admin/assign-user-project-task')}}" method="post" enctype="multipart/form-data">
                                                                                            <div class="form-group mb-3">
                                                                                                <div class="input-group input-group-alternative">
                                                                                                    <input type="hidden" name="prj_user_id" value="{{$project_user['id']}}">
                                                                                                    <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                                    <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                                    <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                                    <input type="hidden" name="parent_task_id" value="{{$parent['id']}}">
                                                                                                    <select name="asign_user_task[]" id="" data-toggle="select" class="form-control" multiple="multiple">
                                                                                                        <option selected disabled>--select users--</option>
                                                                                                        <?php if(!empty($dept_employees)){ foreach ($dept_employees as $key=>$dept_employee) { if(in_array($dept_employee['emp_code'],$prj_emp_codes)){ $select="selected"; }else{ $select=""; } ?>
                                                                                                        <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                                                        <?php }} ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="custom-control custom-control-alternative custom-checkbox">
                                                                                                <input class="custom-control-input" id=" customCheckLogin1" type="checkbox" name="" value="notify">
                                                                                                <label class="custom-control-label" for=" customCheckLogin1"> <span class="text-muted">Notify user</span>
                                                                                                </label>
                                                                                            </div>
                                                                                            <div class="text-center">
                                                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                                <button type="submit" class="btn btn-primary my-4">Assign</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Assign user SubTASk  modal -->
                                                                @php
                                                                    //echo "<pre>";print_r($parent);exit;
                                                                @endphp
                                                                <li>
                                                                    <div class="comment-box">
                                                                        <div class="comment-head">
                                                                            <h6 class="comment-name">{{$parent['name']}}</h6>
                                                                            <span class="badge badge-success">created date: {{date('d/m/Y',strtotime($project_plan['estm_start_date']))}}</span>
                                                                            <!-- Assigned users -->
                                                                            <div class="avatar-group float-right no-line-height">
                                                                                <?php
                                                                                if(!empty($emp_det_child)){
                                                                                foreach ($emp_det_child as $key => $emp_child) {
                                                                                ?>
                                                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip" data-original-title="{{$emp_child['emp_code']}}">
                                                                                    <i class="far fa-user"></i>
                                                                                </a>
                                                                                <?php }} ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comment-content">
                                                                            <!--<p>{{$parent['description']}}</p>-->
                                                                            <!-- Date meta -->
                                                                            <div class="date-meta">
                                                                                <form action="{{url('admin/edit-task')}}" method="post" enctype="multipart/form-data">
                                                                                    <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                    <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                    <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                    <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                                                    <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                                                    <input type="hidden" name="task_id" value="{{$parent['id']}}">
                                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                    <div class="row input-daterange datepicker align-items-center">
                                                                                        <div class="col-3">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">Actual start date</label>
                                                                                                <input class="form-control input-group-alternative" name="actual_strt_dt" placeholder="Start date" type="date" value="<?php echo(!empty($task_child_user_det[0]['actual_strt_dt']) ? $task_child_user_det[0]['actual_strt_dt'] : '')?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-2">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">End date</label>
                                                                                                <input class="form-control input-group-alternative" name="end_dt" placeholder="End date" type="date" value="<?php echo(!empty($task_child_user_det[0]['end_dt']) ? $task_child_user_det[0]['end_dt'] : '')?>" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <div class="form-group mb-0">
                                                                                                <label class="form-control-label">Comments</label>
                                                                                                <textarea class="form-control input-group-alternative" name="comment" placeholder="Comments" rows="1" readonly>
                                                                                            <?php echo(!empty($task_child_user_det[0][ 'comment']) ? $task_child_user_det[0][ 'comment'] : '')?>
                                                                                        </textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php
                                                                                            // echo'<pre>';print_r($tasks);exit;
                                                                                        @endphp

                                                                                        <div class="col-3">
                                                                                            @if (request()->session()->get('user')['section_id'] == $task['dept_id'])
                                                                                                @if(request()->session()->get('user')['role_id'] == '2')
                                                                                                    {{--<button class="btn btn-default btn-sm" type="submit">update</button>--}}
                                                                                                    {{--<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#assign-user_{{$parent['id']}}">Assign User</button>--}}
                                                                                                @endif
                                                                                            @endif
                                                                                        </div>

                                                                                    </div>
                                                                                </form>


                                                                            </div>
                                                                            <!-- /Data meta -->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } }?>
                                                            </ul>
                                                            <?php   } ?>
                                                        </div>
                                                        <?php } ?>
                                                    </li>

                                                    <!-- Assign user TASk modal -->
                                                    <div class="modal fade" id="assign-usertask_{{$task['id']}}" tabindex="-1" role="dialog" aria-labelledby="assign-user" aria-hidden="true">
                                                        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document" style="max-width: 500px !important;">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-0">
                                                                    <div class="card bg-secondary shadow border-0 mb-0">
                                                                        <div class="card-header bg-transparent">
                                                                            <h4 class="text-primary text-center">Assign user </h4>
                                                                        </div>
                                                                        <div class="card-body px-lg-5 py-lg-5">
                                                                            <div class="text-center text-muted mb-4"> <small>You can select/tag one or more user from the below select box for this       project</small>
                                                                            </div>
                                                                            <?php
                                                                            $prj_emp_codes=[];
                                                                            $prj_emp_codes1=[];
                                                                            $new=[];
                                                                            //dd($task_user);


                                                                            foreach ($task_user as $key=>$taskuser) {
                                                                                //dd($taskuser['users']);
                                                                                $prj_emp_codes[$usr]=explode( ',',$taskuser['users']);
                                                                                $usr++;
                                                                               //dd($prj_emp_codes);

                                                                           }

                                                                            foreach   ($prj_emp_codes as $key => $prj_emp_codes1)
                                                                            {
                                                                                sort($prj_emp_codes1 );
                                                                                $new = array_merge($prj_emp_codes1, $new);
                                                                            }


                                                                            ?>
                                                                            <form action="{{url('admin/assign-user-project-task')}}" method="post" enctype="multipart/form-data">
                                                                                <div class="form-group mb-3">
                                                                                    <div class="input-group input-group-alternative" style="height: 20pc;">
                                                                                        <input type="hidden" name="prj_user_id" value="{{$project_user['id']}}">
                                                                                        <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                        <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                        <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                        <input type="hidden" name="parent_task_id" value="{{$task['id']}}">
                                                                                        <select name="asign_user_task[]" id="" data-toggle="select" class="form-control" multiple="multiple">
                                                                                            <option selected disabled>--select users--</option>
                                                                                            <?php if(!empty($dept_employees)){ foreach ($dept_employees as $key=>$dept_employee) { if(in_array($dept_employee['emp_code'],$new)){ $select="selected"; }else{ $select=""; } ?>
                                                                                            <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                                            <?php }} ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!--<div class="custom-control custom-control-alternative custom-checkbox">
                                                                                    <input class="custom-control-input" id=" customCheckLogin2" name="notifyProjecttask" type="checkbox" value="notify">
                                                                                    <label class="custom-control-label" for=" customCheckLogin2"> <span class="text-muted">Notify user</span>
                                                                                    </label>
                                                                                </div>-->
                                                                                <div class="text-center">
                                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                    <button type="submit" class="btn btn-primary my-4">Assign</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Assign user TASk  modal -->

                                                    <div class="modal fade" id="new-task-modal_{{$task['id']}}" tabindex="-1" role="dialog" aria-labelledby="new-task-modal" aria-hidden="true">
                                                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-0">
                                                                    <div class="card bg-secondary shadow border-0 mb-0">
                                                                        <div class="card-header bg-transparent">
                                                                            <h4 class="text-primary text-center">Create a new Subtask</h4>
                                                                        </div>
                                                                        <div class="card-body px-lg-5 py-lg-5">
                                                                            <div class="text-center text-muted mb-4"> <small>You can create a task by filling the below form</small>
                                                                            </div>
                                                                            <?php if(!empty($task_user[ 'users'])){
                                                                                $task_emp_codes=explode( ',',$task_user[0][ 'users']);
                                                                            } else{
                                                                                $task_emp_codes=[ ];
                                                                            } ?>
                                                                            <form action="{{url('admin/assign-user-task')}}" method="post" enctype="multipart/form-data">
                                                                                <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                                                <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                                                <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                                                <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                                                <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                                                <input type="hidden" name="parent_task_id" value="{{$task['id']}}">
                                                                                <div class="row">
                                                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group mb-3">
                                                                                            <label class="form-control-label">Task name</label>
                                                                                            <div class="input-group input-group-alternative">
                                                                                                <input class="form-control" placeholder="Task name" type="text" name="main_task" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row input-daterange datepicker align-items-center">
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">Estimated start date</label>
                                                                                            <input class="form-control input-group-alternative" placeholder="Start date" type="text" value="{{date('d/m/Y',strtotime($project_plan['estm_start_date']))}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">End date</label>
                                                                                            <input class="form-control input-group-alternative" placeholder="End date" type="text" value="{{date('d/m/Y',strtotime($project_plan['estm_end_date']))}}" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row input-daterange datepicker align-items-center">
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">Actual start date</label>
                                                                                            <input class="form-control input-group-alternative" placeholder="Start date" type="date" value="06/18/2018" name="actual_strt_dt">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="form-group">
                                                                                            <label class="form-control-label">End date</label>
                                                                                            <input class="form-control input-group-alternative" placeholder="End date" type="date" value="06/22/2018" name="end_dt">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group mb-3">
                                                                                    <div class="input-group input-group-alternative">
                                                                                        <label class="form-control-label">Assign user</label>
                                                                                        <select name="task_users[]" id="" data-toggle="select" class="form-control" multiple="multiple" required>
                                                                                            <option selected disabled>--select users--</option>
                                                                                            <?php if(!empty($dept_employees)){
                                                                                            foreach ($dept_employees as $key=>$dept_employee) {
                                                                                            if(in_array($dept_employee['emp_code'],$task_emp_codes)){ $select="selected";
                                                                                            }else{
                                                                                                $select="";
                                                                                            }
                                                                                            ?>
                                                                                            <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                                            <?php }} ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" class="btn btn-primary my-4">Create</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php } ?>

                                                    <?php } ?>
                                                    @php
                                                        //echo '<pre>';print_r($parentTask); exit;
                                                    @endphp
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- New task modal -->
                            <div class="modal fade" id="new-task-modal" tabindex="-1" role="dialog" aria-labelledby="new-task-modal" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary shadow border-0 mb-0">
                                                <div class="card-header bg-transparent">
                                                    <h4 class="text-primary text-center">Create a new task</h4>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5">
                                                    <div class="text-center text-muted mb-4"> <small>You can create a task by filling the below form</small>
                                                    </div>
                                                    <?php if(!empty($task_user[ 'users'])){ $task_emp_codes=explode( ',',$task_user[0][ 'users']); } else{ $task_emp_codes=[ ]; } ?>
                                                    <form action="{{url('admin/assign-user-task')}}" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                        <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                        <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                        <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                        <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                        <div class="row">
                                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            <div class="col-md-12">
                                                                <div class="form-group mb-3">
                                                                    <label class="form-control-label">Task name</label>
                                                                    <div class="input-group input-group-alternative">
                                                                        <input class="form-control" placeholder="Task name" type="text" name="main_task">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row input-daterange datepicker align-items-center">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Estimated start date</label>
                                                                    <input class="form-control input-group-alternative" placeholder="Start date" type="text" value="{{date('d/m/Y',strtotime($project_plan['estm_start_date']))}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">End date</label>
                                                                    <input class="form-control input-group-alternative" placeholder="End date" type="text" value="{{date('d/m/Y',strtotime($project_plan['estm_end_date']))}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row input-daterange datepicker align-items-center">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Actual start date</label>
                                                                    <input class="form-control input-group-alternative" placeholder="Start date" type="date" value="06/18/2018" name="actual_strt_dt">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">End date</label>
                                                                    <input class="form-control input-group-alternative" placeholder="End date" type="date" value="06/22/2018" name="end_dt">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <div class="input-group input-group-alternative">
                                                                <label class="form-control-label">Assign user</label>
                                                                <select name="task_users[]" id="" data-toggle="select" class="form-control" multiple="multiple">
                                                                    <option selected disabled>--select users--</option>
                                                                    <?php if(!empty($dept_employees)){ foreach ($dept_employees as $key=>$dept_employee) { if(in_array($dept_employee['emp_code'],$task_emp_codes)){ $select="selected"; }else{ $select=""; } ?>
                                                                    <option value="{{$dept_employee['emp_code']}}" {{$select}}>{{$dept_employee['name']}} - {{$dept_employee['emp_code']}}</option>
                                                                    <?php }} ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-primary my-4">Create</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- New task modal -->
                        </div>
                        <!-- Project Notes tab -->
                        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Text editor -->
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header">
                                            <h5 class="h3 mb-0 d-inline-block">Create a Note</h5>
                                        </div>
                                        <!-- Card body -->
                                        <div class="card-body">

                                            <form action="{{url('admin/project-note')}}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="prj_id" value="{{$project_plan['id']}}">
                                                <input type="hidden" name="project_id" value="{{$project_plan['project_id']}}">
                                                <input type="hidden" name="dept_id" value="{{$project_plan['dept_id']}}">
                                                <input type="hidden" name="model_no" value="{{$service_details['machine_modelno']}}">
                                                <input type="hidden" name="prj_task_id" value="{{$project_task['id']}}">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <textarea class="form-control" name="project_note" placeholder="You can create note based on this project and simply save it on the text editor. This is how it works, very simple">{{$project_plan['comment']}}</textarea>


                                                <div data-toggle="quill" data-quill-placeholder="Put anything & press save button to save the note"></div>
                                                <button class="btn btn-default mt-3" type="submit">Save note</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>@endsection @section('after_script')
    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/quill/dist/quill.min.js')}}"></script>
    <script>
        $(document).ready(function(){

            $('.has-subtask .subtask-toggle-action').click(function() {

                // $('.reply-list').toggle('1000');

                $(this).toggleClass("fa-plus fa-minus");

            });

        });
    </script>@endsection