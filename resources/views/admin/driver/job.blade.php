@extends('admin.layouts.master')
@section('content')
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Recently Created Jobs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Drivers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="ms-auto">
                        <div class="btn-group">
                            <a href="AddFleetDriver.php" type="button" class="btn btn-primary">Add Driver</a>
                        </div>
                    </div> -->
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Assign Jobs</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name / PO</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Order</th>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                        <th>Distance</th>
                                        <th>Req</th>
                                        <th>Start</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                    <tr data-bs-toggle="modal" data-bs-target="#JobAssign">
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1402005</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Nomad-COP</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Mabee</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Triple C</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-secondary">UPCOMING</span></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2500TN</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25,<br>11:00 AM</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal -->
                        <!-- <div class="modal fade" id="JobAssign" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="width: 350px;">
                                <div class="modal-content-custom">
                                    <div class="modal-header-custom">
                                        <h5 class="modal-title">Job Assigning</h5>
                                        <img src="assets/images/icons/AssignJob.png" class="AssignJobIcon" alt="">
                                    </div>
                                    <div class="modal-body">
                                        <p class="m-0">Assign this job to the driver</p>
                                        <p class="m-0">Aaron Lujan (#000000)?</p>
                                    </div>
                                    <div class="modal-footer-custom">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary ms-2">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div><!--end row-->

    </main>
@endsection