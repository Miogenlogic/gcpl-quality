@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Customer Name</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('body')

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{ url('admin/employee-edit-store')}}" enctype="multipart/form-data">



                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Select Location</label>
                            <select name="location_id" class="form-control" required>
                                <option value="">Select Location</option>
                                @php
                                    $location=App\Helpers\UserHelper::location();
                                @endphp

                                @foreach($location as $loc)

                                    {{--<option value="{{$loc->id}}">{{$loc->description}}</option>--}}
                                    <option value="{{$loc->id}}" {{(old('location_id')==$loc->id?'Selected':$user->location_id == $loc->id)?'Selected':''}}>{{$loc->description}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('section_id'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('section_id')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Employee Code</label>
                            <input type="text" name="emp_code" class="form-control" id="service" value="{{old('emp_code')?old('emp_code'):$user->emp_code}}" required>
                            @if($errors->has('emp_code'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('emp_code')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Employee Name</label>
                            <input type="text" name="name" class="form-control" id="service" value="{{old('name')?old('name'):$user->name}}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Employee Mail</label>
                            <input type="email" name="email" class="form-control" id="mail" value="{{old('email')?old('email'):$user->email}}" required>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Select Section</label>
                            <select name="section_id" class="form-control" required>
                                <option value="">Select Section</option>
                                @php
                                    $section=App\Helpers\UserHelper::departmentname();
                                @endphp

                                @foreach($section as $sec)

                                    {{--<option value="{{$sec->id}}">{{$sec->name}}</option>--}}
                                    <option value="{{$sec->id}}" {{(old('section_id')==$sec->id?'Selected':$user->section_id == $sec->id)?'Selected':''}}>{{$sec->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('section_id'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('section_id')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Select Designation</label>
                            <select name="designation_id" class="form-control" required>
                                <option value="">Select Designation</option>
                                @php
                                    $designation=App\Helpers\UserHelper::designation();
                                @endphp

                                @foreach($designation as $desig)

                                    {{--<option value="{{$desig->id}}">{{$desig->designation}}</option>--}}
                                    <option value="{{$desig->id}}" {{(old('designation_id')==$desig->id?'Selected':$user->designation_id == $desig->id)?'Selected':''}}>{{$desig->designation}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('designation_id'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('designation_id')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="customer">Select Jobrole</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">Select Jobrole</option>
                                @php
                                    $jobrole=App\Helpers\UserHelper::roles();
                                @endphp

                                @foreach($jobrole as $jrole)

                                    {{--<option value="{{$jrole->id}}">{{$jrole->name}}</option>--}}
                                    <option value="{{$jrole->id}}" {{(old('role_id')==$jrole->id?'Selected':$user->role_id == $jrole->id)?'Selected':''}}>{{$jrole->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jobrole_id'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('jobrole_id')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Password</label>
                            <input type="password" name="password" class="form-control"  value="" required>

                        </div>
                    </div>

                </div>



                <!-- /row -->

                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>

            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection
