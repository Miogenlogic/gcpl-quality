@extends('admin.include.layout')
<!-- Project List -->



@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit User</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('body')
    @php
        //$userSession=Session::get('user');

        //dd($userSession);
    @endphp
    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/user-edit-store')}}" enctype="multipart/form-data">



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id">User Id</label>
                                <input type="text" class="form-control" id="" placeholder="" name="username" value="{{old('username')?old('username'):$user->username}}">
                                @if($errors->has('username'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('username')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="" placeholder="" name="email" value="{{old('email')?old('email'):$user->email}}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="" placeholder="" name="password" value="">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role[]" data-toggle="select" class="form-control" id="role" multiple="multiple" >
                                @php
                                    $role=App\Helpers\UserHelper::role();
                                @endphp
                                @foreach($role as $rol)
                                    @php
                                        $rol_uc = str_replace("_"," ",$rol->name);
                                        $rol_uc = ucwords($rol_uc);
                                    @endphp

                                    <option value="{{$rol->name}}" {{ in_array(old('role'),$user->role)?'selected=selected':in_array($rol->name,$user->role) ?'selected=selected':''}}>{{$rol_uc}}</option>

                                @endforeach

                            </select>
                            @if($errors->has('role'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('role')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" {{old('status')=='Active'?'Selected':($user->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Inactive'?'Selected':($user->status=='Inactive'?'Selected':'')}}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('status')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- /row -->
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-warning" type="cancel">Cancel</button>
            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        $('#role').select2();
    </script>

@endsection