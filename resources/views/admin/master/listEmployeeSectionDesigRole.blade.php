@extends('admin.include.layout')
<!-- Project List -->

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">All Section Designation</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Section Designation</li>
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
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Add Section</h3>
                        </div>

                        <div class="card-body">
                            <!-- Form groups used in grid -->
                            <form method="post" action="{{url('admin/section-add-save')}}" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="service">Section</label>
                                            <input type="text" name="section" class="form-control" id="service" value="">
                                            @if($errors->has('section'))
                                                <div class="invalid-feedback" style="display:block;">{{$errors->first('section')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                <div class="col-sm-6 col-md-3">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header border-0">
                            <h3 class="mb-0">All Section</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">Section</th>

                                  <!-- <th scope="col" class="sort" data-sort="name">Status</th>
                                 <th scope="col" class="sort" data-sort="name">Created At</th>-->
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Add Designation</h3>
                        </div>

                        <div class="card-body">
                            <!-- Form groups used in grid -->
                            <form method="post" action="{{url('admin/designation-add-save')}}" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="service">Designation</label>
                                            <input type="text" name="designation" class="form-control" id="service" value="">
                                            @if($errors->has('designation'))
                                                <div class="invalid-feedback" style="display:block;">{{$errors->first('designation')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header border-0">
                            <h3 class="mb-0">All Designation</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe2">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">Designation</th>

                                    <!-- <th scope="col" class="sort" data-sort="name">Status</th>
                                   <th scope="col" class="sort" data-sort="name">Created At</th>-->
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Add JobRole</h3>
                        </div>

                        <div class="card-body">
                            <!-- Form groups used in grid -->
                            <form method="post" action="{{url('admin/jobrole-add-save')}}" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="service">JobRole</label>
                                            <input type="text" name="name" class="form-control" id="service" value="">
                                            @if($errors->has('name'))
                                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-header border-0">
                            <h3 class="mb-0">All JobRole</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe3">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">JobRole</th>

                                    <!-- <th scope="col" class="sort" data-sort="name">Status</th>
                                   <th scope="col" class="sort" data-sort="name">Created At</th>-->
                                </tr>
                                </thead>

                            </table>
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
                    url: '{{ url("admin/section-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'section', name: 'section'},

                    //{data: 'status', name: 'status'},
                    //{data: 'component_name', name: 'component_name'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#tabe2').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/designation-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'designation', name: 'designation'},

                    //{data: 'status', name: 'status'},
                    //{data: 'component_name', name: 'component_name'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#tabe3').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/jobrole-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},

                    //{data: 'status', name: 'status'},
                    //{data: 'component_name', name: 'component_name'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>

@endsection

