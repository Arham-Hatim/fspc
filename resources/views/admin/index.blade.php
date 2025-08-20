@extends('admin.layouts.master')
<style>
    .table td,
    .table th {
        flex: 1;
        /* width: 100% !important; */
        min-width: 60px !important;
        word-wrap: break-word;
    }

    td {
        white-space: normal;
        word-wrap: break-word;
        max-width: 300px !important;
        overflow: hidden;
    }

    .BG_SET {
        background: url('assets/images/Frame 2147224848.png') no-repeat center center;
        background-size: cover;
    }

    .round-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    li.Notification-li {
        list-style: none;
        padding: 8px 20px;
    }

    .notificationBtn {
        width: 35px;
        height: 35px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
    }

    .NotificationText {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    li.Notification-li:hover {
        background: #2c54a3;
    }

    .NotificationCheckBox {
        display: none;
    }

    li.Notification-li:hover .NotificationCheckBox {
        display: block;
    }

    .Icon-BG {
        width: 50px;
        height: 50px;
        background: #2c54a3;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }
</style>
@section('content')
    <main class="page-content">

        <div class="">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="   pe-3" style="font-size: 20px;">Hi, John Welcome Back!</div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="#" type="button" class="btn btn-primary">Create A Job</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr>

            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4 BG_SET mb-4">
                <div class="col h-100">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-70">
                                    <p>Jobs Today</p>
                                    <h4 class="">82</h4>
                                </div>
                                <div class="w-30 d-flex justify-content-end">
                                    <div class="Icon-BG">
                                        <i class="fa-solid fa-suitcase" style="color: #fff; font-size: 20px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100 d-flex">
                                    <p class="mb-3  text-success"><i class="bi bi-arrow-up"></i> + 8.2% </p>
                                    <p> Up from yesterday</p>
                                    <!-- <div id="chart4"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col h-100">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-70">
                                    <p>Total Materials</p>
                                    <h4 class="">143</h4>
                                </div>
                                <div class="w-30 d-flex justify-content-end">
                                    <div class="Icon-BG">
                                        <i class="fa-solid fa-box" style="color: #fff; font-size: 20px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100 d-flex">
                                    <p class="mb-3  text-success"><i class="bi bi-arrow-up"></i> + 56 </p>
                                    <p> Up from last year</p>
                                    <!-- <div id="chart4"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col h-100">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-70">
                                    <p>Fleet Drivers</p>
                                    <h4 class="">246</h4>
                                </div>
                                <div class="w-30 d-flex justify-content-end">
                                    <div class="Icon-BG">
                                        <i class="fa-solid fa-user" style="color: #fff; font-size: 20px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100 d-flex">
                                    <p class="mb-3  text-success"><i class="bi bi-arrow-up"></i> + 4.3% </p>
                                    <p> Down from yesterday</p>
                                    <!-- <div id="chart4"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col h-100">
                    <div class="card overflow-hidden radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-70">
                                    <p>Fleet Trucks</p>
                                    <h4 class="">34</h4>
                                </div>
                                <div class="w-30 d-flex justify-content-end">
                                    <div class="Icon-BG">
                                        <i class="fa-solid fa-truck" style="color: #fff; font-size: 20px;"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-stretch justify-content-between overflow-hidden">
                                <div class="w-100 d-flex">
                                    <p class="mb-3  text-success"><i class="bi bi-arrow-up"></i> + 1.8% </p>
                                    <p> Up from yesterday</p>
                                    <!-- <div id="chart4"></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 d-flex">
                <div class="card w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Jobs Completed</h6>
                        <hr>
                        <div class="card">
                            <div class="card-body">
                                <div id="chart5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 d-flex">
                <div class="card w-100  ">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Drivers Ready-to-go</h6>
                        <hr>
                        <div class="NotificationDIVContainer">
                            <ul class="p-0">
                                <li class="Notification-li">
                                    <div
                                        class="NotificationContent w-100 d-flex justify-content-between align-items-center">
                                        <div class="NotificationMainDiv d-flex">
                                            <div class="NotificationIcon me-3">
                                                <img src="{{  asset('assets/images/avatars/avatar-1.png')}}"
                                                    class="round-img" alt="">
                                            </div>
                                            <div class="NotificationText">
                                                <p class="m-0 white">Brooklyn Simmons</p>
                                                <p class="m-0 white">2 min ago - On Call</p>
                                            </div>
                                        </div>
                                        <div class="NotificationCheckBox">
                                            <div class="notificationBtn"><a href="assignJob.php"><i
                                                        class="fa-solid fa-suitcase" style="color: #2c54a3;"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="Notification-li">
                                    <div
                                        class="NotificationContent w-100 d-flex justify-content-between align-items-center">
                                        <div class="NotificationMainDiv d-flex">
                                            <div class="NotificationIcon me-3">
                                                <img src="{{  asset('assets/images/avatars/avatar-1.png')}}"
                                                    class="round-img" alt="">
                                            </div>
                                            <div class="NotificationText">
                                                <p class="m-0 white">Leslie Alexander</p>
                                                <p class="m-0 white">2 min ago - On Call</p>
                                            </div>
                                        </div>
                                        <div class="NotificationCheckBox">
                                            <div class="notificationBtn"><a href="assignJob.php"><i
                                                        class="fa-solid fa-suitcase" style="color: #2c54a3;"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="Notification-li">
                                    <div
                                        class="NotificationContent w-100 d-flex justify-content-between align-items-center">
                                        <div class="NotificationMainDiv d-flex">
                                            <div class="NotificationIcon me-3">
                                                <img src="{{  asset('assets/images/avatars/avatar-1.png')}}"
                                                    class="round-img" alt="">
                                            </div>
                                            <div class="NotificationText">
                                                <p class="m-0 white">Floyd Miles</p>
                                                <p class="m-0 white">2 min ago - On Call</p>
                                            </div>
                                        </div>
                                        <div class="NotificationCheckBox">
                                            <div class="notificationBtn"><a href="assignJob.php"><i
                                                        class="fa-solid fa-suitcase" style="color: #2c54a3;"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="Notification-li">
                                    <div
                                        class="NotificationContent w-100 d-flex justify-content-between align-items-center">
                                        <div class="NotificationMainDiv d-flex">
                                            <div class="NotificationIcon me-3">
                                                <img src="{{  asset('assets/images/avatars/avatar-1.png')}}"
                                                    class="round-img" alt="">
                                            </div>
                                            <div class="NotificationText">
                                                <p class="m-0 white">Savannah Nguyen</p>
                                                <p class="m-0 white">2 min ago - On Call</p>
                                            </div>
                                        </div>
                                        <div class="NotificationCheckBox">
                                            <div class="notificationBtn"><a href="assignJob.php"><i
                                                        class="fa-solid fa-suitcase" style="color: #2c54a3;"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                                <li class="Notification-li">
                                    <div
                                        class="NotificationContent w-100 d-flex justify-content-between align-items-center">
                                        <div class="NotificationMainDiv d-flex">
                                            <div class="NotificationIcon me-3">
                                                <img src="{{  asset('assets/images/avatars/avatar-1.png')}}"
                                                    class="round-img" alt="">
                                            </div>
                                            <div class="NotificationText">
                                                <p class="m-0 white">Ronald Richards</p>
                                                <p class="m-0 white">2 min ago - On Call</p>
                                            </div>
                                        </div>
                                        <div class="NotificationCheckBox">
                                            <div class="notificationBtn"><a href="assignJob.php"><i
                                                        class="fa-solid fa-suitcase" style="color: #2c54a3;"></i></a></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Active Jobs</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name / PO</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Customer</th>
                                        <th>Туре</th>
                                        <th>Order</th>
                                        <th>Material</th>
                                        <th>Quantity</th>
                                        <th>Distance</th>
                                        <th>Req</th>
                                        <th>Start</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
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
                                            <div class="tableContent d-flex align-items-center">Triple c</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Import</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">2</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">101061487</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">Wet Sand</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">1,329.9/<br>2,500TN</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">54/102</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center">44.5 mi</div>
                                        </td>
                                        <!-- <td>
                                                                        <div class="tableContent d-flex align-items-center">Triple C Oilfield Services</div>
                                                                    </td> -->
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><i
                                                    class="fadeIn animated bx bx-camera"></i><i
                                                    class="fadeIn animated bx bx-file"></i></div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center">3/17/25, 11:00am</div>
                                        </td>
                                        <td>
                                            <div class="tableContent d-flex align-items-center"><span
                                                    class="badge rounded-pill bg-warning">ONGOING</span></div>
                                        </td>
                                        <td class="">
                                            <div class="tableContent d-flex align-items-center">
                                                <div class="btn-group">
                                                    <a href="ViewJobDetail.php" type="button"
                                                        class="btn btn-outline-dark"><i class="lni lni-eye"></i></a>
                                                    <button type="button" class="btn btn-outline-dark"><i
                                                            class="fadeIn animated bx bx-trash"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </main>
@endsection