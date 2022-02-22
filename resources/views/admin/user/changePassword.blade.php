@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Change Password</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Password</li>
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
            @if($msg=="error")
                <p style="color: red;">Your Password has not been changed.</p>
            @elseif($msg=="success")
                <p style="color: blue;">Your Password has been changed successfully.</p>
            @endif
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{url('admin/change-password-save')}}" method="post" enctype="multipart/form-data">
                <div class="row">

                <div class="form-group col-6">
                    <label>Provide Your New Password</label>

                    <input name="password" id="password" class="form-control" placeholder="Password" type="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback" style="display:block;">{{$errors->first('password')}}</div>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label>Confirm Password</label>
                    <input name="password_confirmation" class="form-control" placeholder="confirmed password" type="password">
                    @if($errors->has('password_confirmation'))
                        <div class="invalid-feedback" style="display:block;">{{$errors->first('password_confirmation')}}</div>
                    @endif
                </div>
                </div>

                <div class="form-group">

                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>



@endsection
@section('after_script')






@endsection

