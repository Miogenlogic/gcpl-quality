@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')
  <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Component Details</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New service request</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')




 
   <div class="table-responsive">
                          
	  <div class="table-responsive">
			<table class="table align-items-center table-flush" id="tabe1">
				<thead class="thead-light">
					<tr>
                                  
                                  <th scope="col" class="sort" data-sort="name">#</th>
						 <th scope="col" class="sort" data-sort="name">Mc_model</th>
						 <th scope="col" class="sort" data-sort="name">comp_model_no</th>
						 <th scope="col" class="sort" data-sort="name">comp_serial_no</th>
						 <th scope="col" class="sort" data-sort="name">comp_type</th>
						 <th scope="col" class="sort" data-sort="name">Action</th>
				`	</tr>
				</thead>	
			</table>
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
                    url: '{{ url("admin/fetchcomp-get-table") }}',
                },
                columns: [
					{data: 'id', name: 'id'} ,
					{data: 'model_no', name: 'model_no'} ,
					{data: 'comp_model_no', name: 'comp_model_no'} ,
					{data: 'comp_serial_no', name: 'comp_serial_no'} ,
					{data: 'comp_type', name: 'comp_type'} ,
					{data: 'action', name: 'action', orderable: false, searchable: false} ,
					],
			});
					 

        });
    </script>

@endsection	
					 

                  
                                                     
                 


