@extends('admin.include.layout')
<!-- Project List -->

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Transmission & TC Component</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Transmission & TC Component</li>
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

            <form method="post" action="{{ url('admin/transmission-edit-save')}}" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Department</label>
                            <select name="dept_id" id="dept_id" class="form-control">
                                <option value="" selected="selected">select</option>
                                @foreach($dept as  $depart)
                                    <option value="{{$depart->id}}" {{($errors->dept_id==$depart->id)? 'selected=selected':''}}>
                                        {{$depart->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Model No</label>
                            <select name="model_id" id="model_id" class="form-control">
                                <option value="" selected="selected">select</option>
                                @foreach($modelno as  $model)
                                    <option value="{{$model->id}}" {{($errors->model_id==$model->id)? 'selected=selected':''}}>
                                        {{$model->model_no}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Header</label>
                            <input type="text" class="form-control" id=""  name="header" value="{{old('header')?old('header'):$errors->header}}" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tat">Description</label>
                            <input type="text" class="form-control" id=""  name="case_parts" value="{{old('case_parts')?old('transmission_hyd_control_gp'):$errors->case_parts}}">
                        </div>
                    </div>



                </div>

                <!-- /row -->
                <input type="hidden" name="id" value="{{$errors->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>

            </form>
        </div>
    </div>

@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">





    </script>

@endsection
