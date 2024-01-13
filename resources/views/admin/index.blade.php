@extends('admin/layouts/main')

@section('body')
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <h4 class="page-title">Welcome, {{ auth()->user()->first_name }}! </h4>
                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Daily Sales</h4>
                            <div class="widget-chart text-center">
                                <div id="morris-donut-example" class="morris-charts" style="height: 245px;">

                                </div>
                                <ul class="list-inline chart-detail-list mb-0">
                                    <li class="list-inline-item">
                                        <h6 class="text-danger"><i class="fa fa-circle mr-2"></i>Series A</h6>
                                    </li>
                                    <li class="list-inline-item">
                                        <h6 class="text-success"><i class="fa fa-circle mr-2"></i>Series B</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Statistics</h4>
                            <div id="morris-bar-example" class="text-center morris-charts"
                                style="height: 280px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

                                <div class="morris-hover morris-default-style"
                                    style="left: 113.391px; top: 101px; display: none;">
                                    <div class="morris-hover-row-label">02/16</div>
                                    <div class="morris-hover-point" style="color: #3bafda">
                                        Statistics:
                                        75k
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xl-4">
                        <div class="card-box">
                            <h4 class="header-title mb-4">Total Revenue</h4>
                            <div id="morris-line-example" class="text-center morris-charts"
                                style="height: 280px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

                                <div class="morris-hover morris-default-style" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="card-box">
                            <h4 class="header-title mb-4">Recent Users</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-success">L</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Louis Hansen</h5>
                                                <p class="m-0 text-muted"><small>Web designer</small></p>
                                            </td>
                                            <td>+12 3456 789</td>
                                            <td>USA</td>
                                            <td>07/08/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-primary">C</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Craig Hause</h5>
                                                <p class="m-0 text-muted"><small>Programmer</small></p>
                                            </td>
                                            <td>+89 345 6789</td>
                                            <td>Canada</td>
                                            <td>29/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-brown">E</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Edward Grimes</h5>
                                                <p class="m-0 text-muted"><small>Founder</small></p>
                                            </td>
                                            <td>+12 29856 256</td>
                                            <td>Brazil</td>
                                            <td>22/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-pink">B</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Bret Weaver</h5>
                                                <p class="m-0 text-muted"><small>Web designer</small></p>
                                            </td>
                                            <td>+00 567 890</td>
                                            <td>USA</td>
                                            <td>20/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-orange">M</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0 font-15">Mark</h5>
                                                <p class="m-0 text-muted"><small>Web design</small></p>
                                            </td>
                                            <td>+91 123 456</td>
                                            <td>India</td>
                                            <td>07/07/2016</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <!-- table-responsive -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
