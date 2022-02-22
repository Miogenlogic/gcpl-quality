@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Check sheet entry</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/service-engineer-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Check sheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('body')

    <div class="accordion" id="checkSheet">

        <!-- Aggregate information -->
        <div class="card">
            <div class="card-header" id="aggregate-inforamtion">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseAggregate"
                            aria-expanded="true" aria-controls="collapseAggregate">
                        Aggregate information
                    </button>
                </h2>
            </div>

            <div id="collapseAggregate" class="collapse show" aria-labelledby="aggregate-inforamtion"
                 data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Aggregate type</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select aggregate type--</option>
                                        <option>Type 1</option>
                                        <option>Type 2</option>
                                        <option>Type 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Model No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select Model no.--</option>
                                        <option>16H</option>
                                        <option>3406</option>
                                        <option>C9</option>
                                        <option>973C</option>
                                        <option>3306</option>
                                        <option>424</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Serial No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select Serial no.--</option>
                                        <option>4563215-256</option>
                                        <option>201548-562</option>
                                        <option>Any other serial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Aggangement No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select arrangement no.--</option>
                                        <option>4563215-256</option>
                                        <option>201548-562</option>
                                        <option>Any other serial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Customer</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select customer--</option>
                                        <option>TATA STEEL LTD.</option>
                                        <option>LPD LTD</option>
                                        <option>Any other customer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer-contact">Customer contact</label>
                                    <input type="text" class="form-control" id="customer-contact" value="contact@customer.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="servicing-branch">Servicing branch</label>
                                    <input type="text" class="form-control" id="servicing-branch" value="Asansole" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="branch-contact">Branch contact</label>
                                    <input type="text" class="form-control" id="branch-contact" value="branch@contact.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="crc-supervisor">CRC supervisor</label>
                                    <input type="text" class="form-control" id="crc-supervisor" value="Mr. supervisor" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="crc-job-number">CRC job number</label>
                                    <input type="text" class="form-control" id="crc-job-number" placeholder="CRC job number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="Branch-job-number">Branch job number <span class="text-muted">(if any)</span></label>
                                    <input type="text" class="form-control" id="Branch-job-number" placeholder="Branch job number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-arrival">Date of arrival</label>
                                    <input type="text" class="datepicker form-control" id="date-of-arrival" placeholder="Date of arrival">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-dispatch">Date of dispatch</label>
                                    <input type="text" class="datepicker form-control" id="date-of-dispatch" placeholder="Date of dispatch">
                                </div>
                            </div>

                        </div><!-- /row -->

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Status of Revision -->
        <div class="card">
            <div class="card-header" id="statusrevision">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsestatusrevision" aria-expanded="false" aria-controls="collapsestatusrevision">
                        Status of Revision
                    </button>
                </h2>
            </div>
            <div id="collapsestatusrevision" class="collapse" aria-labelledby="statusrevision" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="status-revision">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Details of Amendment" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Revision No.">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Page No." rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Reason for Amendment" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>


        <!-- Pre-history -->



        <!-- Commercial & Logistics Report  -->


        <!-- Loose part Report  -->
        <div class="card">
            <div class="card-header" id="loosePartreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseloosePart" aria-expanded="false" aria-controls="collapseloosePart">
                        Loose part report
                    </button>
                </h2>
            </div>
            <div id="collapseloosePart" class="collapse" aria-labelledby="loosePartreport" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="loose-part-repeat">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part description" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part condition" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input name="field_name[]" type="file" class="custom-file-input" id="customFileLang" lang="en">
                                            <label class="custom-file-label" for="customFileLang">Photograph taken</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- CC Inspection Check sheet after external washing  -->
        <div class="card">
            <div class="card-header" id="ccInspectionAfterWashing">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseAfterWashing" aria-expanded="false" aria-controls="collapseAfterWashing">
                        CC Inspection Check sheet after external washing
                    </button>
                </h2>
            </div>
            <div id="collapseAfterWashing" class="collapse" aria-labelledby="ccInspectionAfterWashing" data-parent="#checkSheet">
                <div class="card-body">

                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All Port closed with dedicated caps & plugs</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ayes1" type="radio">
                                        <label class="custom-control-label" for="ayes1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ano1" type="radio">
                                        <label class="custom-control-label" for="ano1">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dart & debris cleaned</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ayes2" type="radio">
                                        <label class="custom-control-label" for="ayes2">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ano2" type="radio">
                                        <label class="custom-control-label" for="ano2">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removals of loose jutes & cotton rags</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ayes3" type="radio">
                                        <label class="custom-control-label" for="ayes3">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ano3" type="radio">
                                        <label class="custom-control-label" for="ano3">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removal of oil & grease stain marks</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ayes4" type="radio">
                                        <label class="custom-control-label" for="ayes4">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ano4" type="radio">
                                        <label class="custom-control-label" for="ano4">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Hot soapy water used for pressure jet cleaning </h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ayes5" type="radio">
                                        <label class="custom-control-label" for="ayes5">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ano5" type="radio">
                                        <label class="custom-control-label" for="ano5">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dedicated lifting tackle used for aggregate movement to disassembly area</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ayes6" type="radio">
                                        <label class="custom-control-label" for="ayes6">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ano6" type="radio">
                                        <label class="custom-control-label" for="ano6">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>

                </div>
            </div>
        </div>

        <!-- Disassembly, Cleaning & Inspection Check sheet  -->
        <div class="card">
        <div class="card-header" id="disassemblyCleaningInspection">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                        data-target="#collapsedisassemblyCleaningInspection" aria-expanded="false" aria-controls="collapsedisassemblyCleaningInspection">
                    Disassembly, Cleaning & Inspection Check sheet
                </button>
            </h2>
        </div>
        <div id="collapsedisassemblyCleaningInspection" class="collapse" aria-labelledby="disassemblyCleaningInspection" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <div class="row">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Component Model.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select Model no.--</option>
                                        <option>16H</option>
                                        <option>3406</option>
                                        <option>C9</option>
                                        <option>973C</option>
                                        <option>3306</option>
                                        <option>424</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Component Disassembly Start Date</label>
                                    <input type="text" class="form-control" id="customer-contact" value="contact@customer.com">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Component Disassembly End Date</label>
                                    <input type="text" class="form-control" id="customer-contact" value="contact@customer.com">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Component Cleaning Start Date</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select customer--</option>
                                        <option>TATA STEEL LTD.</option>
                                        <option>LPD LTD</option>
                                        <option>Any other customer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer-contact">Component Cleaning End Date</label>
                                    <input type="text" class="form-control" id="customer-contact" value="contact@customer.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="servicing-branch">Component Inspection & assessment Start Date</label>
                                    <input type="text" class="form-control" id="servicing-branch" value="Asansole" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="branch-contact">Component Inspection & assessment End Date</label>
                                    <input type="text" class="form-control" id="branch-contact" value="branch@contact.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="crc-supervisor">Component Offer Send Date</label>
                                    <input type="text" class="form-control" id="crc-supervisor" value="Mr. supervisor" disabled>
                                </div>
                            </div>


                        </div><!-- /row -->

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>

                </div>
            </div>
        </div>


        <!-- CC Inspection Check sheet after Parts Cleaning  -->


        <!-- Missing/Damaged Parts Report -->
        <div class="card">
            <div class="card-header" id="missingDamagedParts">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsemissingDamagedPart" aria-expanded="false" aria-controls="collapsemissingDamagedPart">
                        Missing/Damaged Parts Report
                    </button>
                </h2>
            </div>
            <div id="collapsemissingDamagedPart" class="collapse" aria-labelledby="missingDamagedParts" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="missing-damaged-part-repeat">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Part No</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part Description" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Part description</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part Description" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">QTY</label>
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Missing/damaged</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Missing/ Damaged" rows="1"></textarea>
                                    </div>
                                </div>



                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>
        <!-- Component Inspection Report -->

        <div class="card">
            <div class="card-header" id="componentInspectionReport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsecomponentInspectionReport" aria-expanded="false" aria-controls="collapsecomponentInspectionReport">
                        Component Inspection Report
                    </button>
                </h2>
            </div>
            <div id="collapsecomponentInspectionReport" class="collapse" aria-labelledby="componentInspectionReport" data-parent="#checkSheet">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">

                            <thead class="thead-light">
                            <tr>
                                <th>Description</th>
                                <th>Part no.</th>
                                <th>QTY</th>
                                <th>Condition</th>
                                <th>Reused</th>
                                <th>Rejected</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr><td class="tbl-title" colspan="6">Basic engine</td></tr>

                            <tr>
                                <td>Camshaft gear</td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-control custom-radio">
                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-control custom-radio">
                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Camshaft lock</td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-control custom-radio">
                                        <input name="status2" class="custom-control-input" id="reusedy2" type="radio">
                                        <label class="custom-control-label" for="reusedy2">Reused</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-control custom-control custom-radio">
                                        <input name="status2" class="custom-control-input" id="rejected2" type="radio">
                                        <label class="custom-control-label" for="rejected2">Rejected</label>
                                    </div>
                                </td>
                            </tr>




                            </tbody>
                        </table>
                    </div>


                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>
                </div>
            </div>
        </div>

        <!-- LIST OF SALVAGE COMPONENT -->
        <div class="card">
            <div class="card-header" id="salvageCompList">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#salvageComponents" aria-expanded="false" aria-controls="salvageComponents">
                        List of Salvage components
                    </button>
                </h2>
            </div>
            <div id="salvageComponents" class="collapse" aria-labelledby="salvageCompList" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="salvage-part-repeat">
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Component name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>



                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Vendor name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Inspected by">
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- CC Inspection Check sheet before starting assembly  -->
        <div class="card">
            <div class="card-header" id="ccInspectionbeforeStartingAssembly">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseCcInspectionbeforeStartingAssembly" aria-expanded="false" aria-controls="collapseCcInspectionbeforeStartingAssembly">
                        CC Inspection Check sheet before starting assembly
                    </button>
                </h2>
            </div>
            <div id="collapseCcInspectionbeforeStartingAssembly" class="collapse" aria-labelledby="ccInspectionbeforeStartingAssembly" data-parent="#checkSheet">
                <div class="card-body">

                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All Port closed with dedicated caps & plugs</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ayes1" type="radio">
                                        <label class="custom-control-label" for="ayes1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ano1" type="radio">
                                        <label class="custom-control-label" for="ano1">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dart & debris cleaned</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ayes2" type="radio">
                                        <label class="custom-control-label" for="ayes2">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ano2" type="radio">
                                        <label class="custom-control-label" for="ano2">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removals of loose jutes & cotton rags</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ayes3" type="radio">
                                        <label class="custom-control-label" for="ayes3">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ano3" type="radio">
                                        <label class="custom-control-label" for="ano3">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removal of oil & grease stain marks</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ayes4" type="radio">
                                        <label class="custom-control-label" for="ayes4">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ano4" type="radio">
                                        <label class="custom-control-label" for="ano4">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Hot soapy water used for pressure jet cleaning </h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ayes5" type="radio">
                                        <label class="custom-control-label" for="ayes5">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ano5" type="radio">
                                        <label class="custom-control-label" for="ano5">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dedicated lifting tackle used for aggregate movement to disassembly area</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ayes6" type="radio">
                                        <label class="custom-control-label" for="ayes6">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ano6" type="radio">
                                        <label class="custom-control-label" for="ano6">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>

                </div>
            </div>
        </div>

    </div>



@endsection

@section('after_script')

    <!-- Loose parts report add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.loose-part-repeat'); //Input field wrapper
            var fieldHTML = '<div class="row"><div class="col"><div class="form-group"><textarea type="text" name="field_name[]" class="form-control" placeholder="Part description" rows="1"></textarea></div></div><div class="col-md-1"><div class="form-group"> <input type="text" name="field_name[]" class="form-control" placeholder="QTY"></div></div><div class="col"><div class="form-group"><textarea type="text" name="field_name[]" class="form-control" placeholder="Part condition" rows="1"></textarea></div></div><div class="col"><div class="form-group"><div class="custom-file"> <input name="field_name[]" type="file" class="custom-file-input" id="customFileLang" lang="en"> <label class="custom-file-label" for="customFileLang">Photograph taken</label></div></div></div><div class="col-auto"> <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

@endsection

