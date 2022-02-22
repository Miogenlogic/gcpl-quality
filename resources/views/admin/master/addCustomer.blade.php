@extends('admin.include.layout')
<!-- Project List -->



@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create New Customer</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Customer</li>
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
            <form method="post" action="{{url('admin/customer-add-store')}}" enctype="multipart/form-data">



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Customer Code</label>
                            <input type="text" class="form-control" id="" placeholder="" name="customer_code">
                            @if($errors->has('customer_code'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('customer_code')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Address</label>
                            <input type="text" class="form-control" id="" placeholder="" name="address">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Branch</label>
                            <input type="text" class="form-control" id="" placeholder="" name="branch">
                            @if($errors->has('branch'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('branch')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Company Code</label>
                            <input type="text" class="form-control" id="" placeholder="" name="company_code">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Phone no</label>
                            <input type="text" class="form-control" id="" placeholder="" name="contact_details">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="cust_email">
                            
                        </div>
                    </div>
                </div>




                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                
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
