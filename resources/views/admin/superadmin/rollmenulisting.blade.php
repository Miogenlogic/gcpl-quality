@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Role Menulist</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Menulist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('body')

    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="" class="form-control">


                        @foreach($rolemenu as $role)
                            <option selected="selected" value="{{$role->id}}" >
                                {{$role->name}}
                            </option>
                    @endforeach
                            @php
                                $roles=App\Helpers\UserHelper::roles();
                            @endphp

                            @foreach($roles as $role)

                                <option value="{{$role->id}}">{{$role->name}}</option>

                            @endforeach

                    </select>
                    @if($errors->has('name'))
                        <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>



                <!-- Form groups used in grid -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mc_model_id">Menu</label>

                        @php
                            $i=0;
                        @endphp
                        @foreach($rolemenu as $menu)
                            
                                        <div class="custom-control custom-control-inline custom-radio">
                                            <input name="answer[{{$i}}]" class="custom-control-input" id="customer{{$errors->id}}" type="radio" value="customer" disabled>
                                            <label class="custom-control-label" for="customer{{$errors->id}}" >customer</label>
                                        </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="answer[{{$i}}]" class="custom-control-input" id="branch{{$errors->id}}" type="radio" value="branch" disabled>
                                <label class="custom-control-label" for="branch{{$errors->id}}">branch</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="answer[{{$i}}]" class="custom-control-input" id="components{{$errors->id}}" type="radio" value="components" disabled>
                                <label class="custom-control-label" for="components{{$errors->id}}">components</label>
                            </div>
                            <div class="custom-control custom-control-inline custom-radio">
                                <input name="answer[{{$i}}]" class="custom-control-input" id="machine{{$errors->id}}" type="radio" value="machine" disabled>
                                <label class="custom-control-label" for="machine{{$errors->id}}">machine</label>
                            </div>
                                    @endforeach

                    </div>
                </div>
                            </div>
                </div>

            @endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection
