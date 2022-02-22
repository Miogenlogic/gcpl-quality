@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Branch Name</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Branch Name</li>
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
            <form method="post" action="{{ url('admin/updatebranch')}}" enctype="multipart/form-data">



                <div class="row">
              
                    <div class="col-md-6">
                        <div class="form-group">

                            <lable for="name">Sales office</lable>
							
							

                            <input type="text" class="form-control" id=""  name="sales_ofc" value="{{old('sales_ofc')?old('sales_ofc'):$errors->sales_ofc}}">

                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Sales Office Code</lable>
							
							

                            <input type="text" class="form-control" id=""  name="sales_ofc_code" value="{{old('sales_ofc_code')?old('sales_ofc_code'):$errors->sales_ofc_code}}">

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

@endsection
