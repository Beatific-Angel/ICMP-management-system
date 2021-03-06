{{--Created by Beatific Angel    20222/3/21 11.00 am --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Dashboard</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('home')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- start widget -->
        <div class="state-overview">
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="info-box bg-b-green">
                        <span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Customers</span>
                            <span class="info-box-number">{{$usercnt}}</span>
                            <hr style="border-top: 3px solid #fff;margin: 5px 0;">
                            <span class="info-box-text">Just Now</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="info-box bg-b-red">
                        <span class="info-box-icon push-bottom"><i data-feather="server"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Groups</span>
                            <span class="info-box-number">{{$groups_cnt}}</span>
                            <hr style="border-top: 3px solid #fff;margin: 5px 0;">
                            <span class="info-box-text">Just Now</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="info-box bg-b-blue">
                        <span class="info-box-icon push-bottom"><i data-feather="monitor"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Devices</span>
                            <span class="info-box-number">{{$devices_cnt}}</span>
                            <hr style="border-top: 3px solid #fff;margin: 5px 0;">
                            <span class="info-box-text">Just Now</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
        </div>
        <!-- end widget -->
        <!-- chart start -->
        <!-- Chart end -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Groups List</header>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Device Lists</th>
                                        <th>Up Devices</th>
                                        <th>Down Devices</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="home_group_status">
                                    @if($groups)
                                        @foreach($groups as $key=> $group)
                                            <tr class="odd">
                                                <td>{{$group->id}}</td>
                                                <td>{{$group->name}}</td>
                                                <td>{{$devicelists[$key]}}</td>
                                                <td class="bg-success">{{$uplists[$key]}}</td>
                                                <td class="bg-danger">{{$downlists[$key]}}</td>
                                                <td>
                                                    <a href="{{ route('group.edit', ['id' => $group->id]) }}" class="tblEditBtn">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="tblDelBtn" href="{{ route('group.delete', ['id' => $group->id]) }}" id="groupdelete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Device Lists</header>
                            <button id="panel-button8"
                                    class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                    data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                data-mdl-for="panel-button8">
                                <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                    here
                                </li>
                            </ul>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Device Name</th>
                                        <th>Group Name</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Up Percent</th>
                                        <th>Down Percent</th>
                                        <th>Last Seen</th>
                                    </tr>
                                    </thead>
                                    <tbody id="home_device_status">
                                    @if($status_lists)
                                        @foreach($status_lists as $key => $device)
                                            @if($device->status == 'dead')
                                            <tr class="odd">
                                                <td><i data-feather="monitor"></i></td>
                                                <td>{{$device->deviceid}}</td>
                                                <td>{{$device->devicename}}</td>
                                                <td>
                                                    <?php
                                                    $groups = DB::select(DB::raw('select * from groups where id = ' . $device->groupid));
                                                    echo $groups[0]->name;
                                                    ?>
                                                </td>
                                                <td>{{$device->ipaddress}}</td>
                                                <td>
                                                    @if($device->status == 'alive')
                                                        <i class="fas fa-circle col-green me-2"></i>
                                                    @else
                                                        <i class="fas fa-circle col-red me-2"></i>
                                                    @endif
                                                    {{$device->status}}</td>
                                                <td><?php
                                                    $allcnt = $device->access_count;$up_count = $device->up_count;$down_count = $device->down_count;
                                                    $up_per = $up_count/$allcnt*100;
                                                    $down_per = $down_count/$allcnt*100;
                                                    echo $up_per. "%";
                                                    ?></td>
                                                <td><?php
                                                    echo $down_per. "%";
                                                    ?></td>
                                                <td>{{$device->updated_at}}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="box-title"><small class="pull-right small-lbl-green"><i
                                    class="far fa-arrow-alt-circle-up"></i></small> Open Ticket
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Ticket Id</th>
                                    <th>Device</th>
                                    <th>Assigned Customer</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody id="ticket_status">
                                @if($tickets)
                                    @foreach($tickets as $key => $ticket)
                                            <tr class="odd">
                                                <td>
                                                    <a href="{{ route('ticket.edit', ['ticket_id' => $ticket->ticket_id]) }}">
                                                    {{$ticket->ticket_id}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $deviceget = DB::select(DB::raw('select * from devices where id = ' . $ticket->device_id));
                                                    echo $deviceget[0]->name;
                                                    ?>
                                                </td>
                                                <td><?php
                                                    $getcustomer = DB::select(DB::raw('select * from customers where id = ' . $ticket->customer_id));
                                                    echo $getcustomer[0]->short_name;
                                                    ?></td>
                                                <td>
                                                    {{$ticket->status}}</td>
                                            </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ajax_call = function () {
            $.ajax({
                url: '/downdevice',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    document.getElementById('home_device_status').innerHTML = response.get_status;
                }
            });
            $.ajax({
                url: '/groupstatus',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    document.getElementById('home_group_status').innerHTML = response.get_status;
                }
            });
        };
        var interval = 20000; // where X is your every X minutes
        setInterval(ajax_call, interval);
    </script>
@endsection
