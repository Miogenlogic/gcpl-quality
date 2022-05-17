@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Customer Name</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Customer Name</li>
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
            <form method="post" action="{{ url('admin/updatecustomer')}}" enctype="multipart/form-data">



                <div class="row">
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
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="name">Name</label>
							
							

                            <input type="text" class="form-control" id=""  name="name" value="{{old('name')?old('name'):$errors->name}}">

                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="form-group">

                            <label for="customer_code">Customer Code</label>
							
							

                            <input type="text" class="form-control" id=""  name="customer_code" value="{{old('customer_code')?old('customer_code'):$errors->customer_code}}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="customer_code">Address</label>



                            <input type="text" class="form-control" id=""  name="address" value="{{old('address')?old('address'):$errors->address}}">

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="customer_code">Contact Details</label>



                            <input type="text" class="form-control" id=""  name="contact_details" value="{{old('contact_details')?old('contact_details'):$errors->contact_details}}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Branch</lable>



                            <input type="text" class="form-control" id=""  name="branch" value="{{old('branch')?old('branch'):$errors->branch}}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Email</lable>



                            <input type="text" class="form-control" id=""  name="cust_email" value="{{old('cust_email')?old('cust_email'):$errors->cust_email}}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">

                            <lable for="customer_code">Company Code</lable>



                            <input type="text" class="form-control" id=""  name="company_code" value="{{old('company_code')?old('company_code'):$errors->company_code}}">

                        </div>
                    </div>
                </div>



                <!-- /row -->

                <input type="hidden" name="id" value="{{$errors->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                

            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection
