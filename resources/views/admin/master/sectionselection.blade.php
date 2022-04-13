@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Section</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Section</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <!--<div class="card">
                        
                        <div class="card-header border-0">
                            <h3 class="mb-0">Upload Customer List Here</h3>
                        </div>
                        <form action="{{url('admin/upload-customer')}}" method="post">
                            <input type="file"><br><br>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-warning" type="cancel">Cancel</button>
                        </form>


                        <div align="right">
                            <a href="{{url('admin/download-template-customer')}}"><button class="btn"><i class="fa fa-download"></i>Sample Template Download</button>
                            </a></div>
                    </div>-->




                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header border-0">
                                            <h3 class="mb-0">All Section Details</h3>
                                        </div>

                                        <!-- <a href="{{url('admin/download-customer')}}"><button class="btn"><i class="fa fa-download"></i>Customer details Download</button>
                                        </a> -->

                                        <div class="text-right mb-1" style="padding-right: 70px">
                                            <a class="btn btn-info text-white" href="{{url('admin/section-add')}}">Add Section</a>
                                        </div>





                                        <div class="table-responsive">





                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush" id="tabe1">
                                                    <thead class="thead-light">
                                                    <tr>

                                                        <th scope="col" class="sort" data-sort="name">#</th>

                                                        <th scope="col" class="sort" data-sort="name">Section Name</th>
                                                        <th scope="col" class="sort" data-sort="name">Parent Section</th>
                                                        
                                                        <th scope="col" class="sort" data-sort="name">Department</th>
                                                        <!--<th scope="col" class="sort" data-sort="name">region</th>-->
                                                        <th scope="col" class="sort" data-sort="name">Model No</th>
                                                        <th scope="col" class="sort" data-sort="name">created at</th>
                                                        <!--    <th scope="col" class="sort" data-sort="name">Action</th>-->

                                                         <th scope="col" class="sort" data-sort="name">Action</th>
                                                    </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                                        @endsection


                                        @section('after_script')

                                            <script src="{{URL::asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
                                            <script src="{{URL::asset('public/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $('#tabe1').DataTable({
                                                        processing: true,
                                                        serverSide: true,
                                                        ajax:{
                                                            url: '{{ url("admin/fetchsectionselection-get-table") }}', 
                                                        },
                                                        columns: [
                                                            {data: 'id', name: 'id',orderable: false, searchable: false},
                                                            {data: 'name', name: 'name'},
                                                            {data: 'parent_section', name: 'parent_section'},
                                                           
                                                            {data: 'department', name: 'department'},
                                                            // {data: 'region', name: 'region'},
                                                            {data: 'model_no', name: 'model_no'},
                                                            {data: 'created_at', name:'created_at'},
                                                            //{data: 'action', name: 'action', orderable: false, searchable: false} ,


                                                        ],
                                                    });


                                                });
                                            </script>

@endsection

