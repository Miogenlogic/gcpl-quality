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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Component Status Facility</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/service-engineer-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Component Status</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')

    <!-- Project List -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Component Status</h3>
                        </div>
                        <div align="left">
                            <a href="{{url('admin/download-componentstatusfacility')}}"><button class="btn"><i class="fa fa-download"></i>Download</button>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="number">WORK ORDER NO </th>
                                    <th scope="col" class="sort" data-sort="name">CUSTOMER</th>
                                    <th scope="col" class="sort" data-sort="name">BRANCH</th>
                                    <th scope="col" class="sort" data-sort="name">SEGMENT</th>
                                    <th scope="col" class="sort" data-sort="name">COMPONENT</th>
                                   <th scope="col" class="sort" data-sort="name">COMPONENT MODEL</th>
                                    <!--<th scope="col" class="sort" data-sort="name">Action</th>-->
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
                    url: '{{ url("admin/componentstatusfacility-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'work_orderno', name: 'work_orderno'},
                    {data: 'customer', name: 'customer'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'segment', name: 'segment'},
                    {data: 'component_name', name: 'component_name'},
                    {data: 'compmodel', name: 'compmodel'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>


@endsection