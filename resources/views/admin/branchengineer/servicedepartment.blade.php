@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Service Department</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service Department</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('body')
    @php
        //print_r( $mastermenu);
        //exit;

    @endphp



    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/insertservicedepartment')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Department</label>
                            <select class="form-control" name="department">
                                <option></option>
                                <option>branch office</option>
                                <option>Support</option>
                                <option>Receiving</option>
                                <option>Eng.dissambly</option>
                                <option>Tran.dissambly</option>
                                <option>Hyd.Comp.dissambly</option>
                                <option>Mor</option>
                                <option>Undercarriege</option>
                            </select>
                            @if($errors->has('department'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('department')}}</div>
                            @endif

                        </div>
                    </div>


                </div>

                <div class="row">




                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="" placeholder="name" name="name">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label  designation" for="model">Designation</label>
                                 <select name="designation" id="designation" class="form-control">




                                    @php
                                        $masterdesignation=App\Helpers\UserHelper::designation1();
                                    @endphp

                                    @foreach($masterdesignation as $cmodel)

                                        <option value="{{$cmodel->id}}">{{$cmodel->designation}}</option>

                                    @endforeach

                                </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_no">Phone no</label>
                            <input type="number" class="form-control" id="" placeholder="" name="phone_no">
                            @if($errors->has('phone_no'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('phone_no')}}</div>
                            @endif
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="email">
                            @if($errors->has('email'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-warning" type="cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection

