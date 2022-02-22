@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Roll Menulist</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roll Menulist</li>
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


    <!-- Project List -->
    <ul class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{ url('admin/saverollmenu')}}" enctype="multipart/form-data">



                <ul class="row">
                <!--<div class="col-md-6">
                            <div class="form-group">
                                <label for="id">Check Gate</label>
                                <select name="check_gate_id" class="form-control">
                                    <option selected="selected" disabled="disabled">Select Check Gate*</option>
                                    {{--@foreach($checkgate as $chg)
                                        <option value="{{$chg->id}}">{{$chg->name}}</option>

                                    @endforeach

                                </select>
                                @if($errors->has('check_gate_id'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('check_gate_id')}}</div>
                                @endif--}}
                    </div>
                </div>-->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group">
                            <label class="form-control-label" for="roll">Name</label>
                            <select name="role" id="name" class="form-control"  >
                                <option selected="selected" id="roll" >
                                </option>
                                @if($errors->has('roll'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('roll')}}</div>
                                @endif

                                @php
                                    $roles=App\Helpers\UserHelper::roles();
                                @endphp


                                @foreach($roles as $rol)

                                    <option value="{{$rol->id}}">{{$rol->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="roll">Select Menu</label>

                                    <div class="col-sm-6 col-md-3">

                                            @php
                                                $menus=App\Helpers\UserHelper::menus();
                                            @endphp


                                            @foreach($menus as $men)
                                            <input type="checkbox" name="checked[]" value="{{$men->menu}}">
                                            <option value="{{$men->menu}}">{{$men->menu}}</option>
                                            @endforeach

                                        </div>

                                </div>
                            </div>

                </ul>
                <!-- /row -->

                <input type="hidden" name="id" value="{{$errors->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-warning" type="cancel">Cancel</button>
            </form>
        </div>


    </ul>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection
