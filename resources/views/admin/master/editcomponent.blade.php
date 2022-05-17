@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Machine details</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Machine details</li>
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
            <form method="post" action="{{ url('admin/updatecomponent')}}" enctype="multipart/form-data">



                <div class="row">

                   <div class="col-sm-6 col-md-3">
                        <div class="form-group" >
                            <label class="form-control-label  machmodel" for="model" >Mc Model number</label>
							@php
                               $model =App\Helpers\UserHelper::getComponentModelNoById($mcComponent->mc_model_id);
							@endphp
							<input type="text" value="{{$model->model_no}}" disabled>

                        </div>
                    </div>
					
					 <div class="col-md-6">
                        <div class="form-group">

                            <lable for="name">Comp model no</lable>
							
							

                            <input type="text" class="form-control" id=""  name="comp_model_no" value="{{old('comp_model_no')?old('comp_model_no'):$mcComponent->comp_model_no}}">

                        </div>
                    </div>
					
					
					
					
					<div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Serial num</lable>
							
							

                            <input type="text" class="form-control" id=""  name="comp_serial_no" value="{{old('comp_serial_no')?old('comp_serial_no'):$mcComponent->comp_serial_no}}">

                        </div>
                    </div>
					
					<div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Component type</lable>
							
							

                            <input type="text" class="form-control" id=""  name="comp_type" value="{{old('comp_type')?old('comp_type'):$mcComponent->comp_type}}">

                        </div>
                    </div>
					
                </div>



                <!-- /row -->

                <input type="hidden" name="id" value="{{$mcComponent->id}}">
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

@endsection
