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
@section('body')
    @php
        $checkmenu=App\Helpers\UserHelper::checkmenulisting();

  //echo'<pre>'; print_r($checkmenu);
  //exit();
    @endphp

    @php
        $i=0;
    @endphp
    @foreach( $checkmenu as $comm)



        <li class="list-group-item px-0">
            <div class="row align-items-center">
                <div class="col-7"><h4 class="mb-0">{{$comm->menu}}</h4></div>
                <div class="col-2">
                    <input type="hidden" name="" value="{{$comm->menu}}">
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="customer[{{$i}}]" class="custom-control-input" id="{{$comm->id}}" type="radio" value="customer" {{$checkgatmenulist->customer[$check]=='customer'?'checked':''}}>
                        <label class="custom-control-label" for="customer{{$comm->id}}">customer</label>
                    </div>
                </div>
                   <!-- <div class="custom-control custom-control-inline custom-radio">
                        <input name="branch[{{$i}}]" class="custom-control-input" id="{{$comm->id}}" type="radio" value="branch" {{$checkgatmenulist->branch[$check]=='branch'?'checked':''}}>
                        <label class="custom-control-label" for="branch{{$comm->id}}">branch</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="components[{{$i}}]" class="custom-control-input" id="{{$comm->id}}" type="radio" value="components" {{$checkgatmenulist->components[$check]=='components'?'checked':''}}>
                        <label class="custom-control-label" for="components{{$comm->id}}">components</label>
                    </div>
                    <div class="custom-control custom-control-inline custom-radio">
                        <input name="machine[{{$i}}]" class="custom-control-input" id="machine{{$comm->id}}" type="radio" value="machine" {{$checkgatmenulist->machine[$check]=='machine'?'checked':''}}>
                        <label class="custom-control-label" for="machine{{$comm->id}}">machine</label>
                    </div>
                </div>-->

            </div>
        </li>
        @php
            $i++;
        @endphp
    @endforeach
@endsection
