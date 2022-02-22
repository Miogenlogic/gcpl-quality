@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Download Quotation</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/spc-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Download PO</li>
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
            <h3 class="mb-0">PO Download</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/po-download')}}" enctype="multipart/form-data">



                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="question">Click Download button For PO Download</label>
                                {{--<input type="file" class="form-control" id="" placeholder="" name="po_upload" value="{{old('po_upload')?old('po_upload'):$service->po_upload}}" readonly>

                                @if($errors->has('quotation'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('quotation')}}</div>
                                @endif--}}
                            </div>
                        </div>

                    </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$service->id}}">
                <button class="btn btn-primary" type="submit">Download</button>

            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@endsection