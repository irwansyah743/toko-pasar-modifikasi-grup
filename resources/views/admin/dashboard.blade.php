@extends('admin.master')
@section('content')
    @php
    $month = date('F');
    $month = App\Models\Order::where('order_month', $month)->sum('gross_amount');
    $year = date('Y');
    $year = App\Models\Order::where('order_year', $year)->sum('gross_amount');
    $pending = App\Models\Order::where('status', 'pending')->get();
    $Waitlist = App\Models\Shipping::where('delivery_status', 0)->get();
    @endphp
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-warning-light rounded w-60 h-60">
                                <i class="text-warning mr-0 font-size-24  mdi mdi-sale "></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Monthly Sale </p>
                                <h3 class="text-white mb-0 font-weight-500">Rp. {{ $month }} <small
                                        class="text-success"><i class="fa fa-caret-up"></i> IDR</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-info-light rounded w-60 h-60">
                                <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Yearly Sale </p>
                                <h3 class="text-white mb-0 font-weight-500">Rp. {{ $year }} <small
                                        class="text-success"><i class="fa fa-caret-up"></i> IDR</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-danger-light rounded w-60 h-60">
                                <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Pending Orders </p>
                                <h3 class="text-white mb-0 font-weight-500">{{ count($pending) }} <small
                                        class="text-danger"><i class="fa fa-caret-up"></i> Order </small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-danger-light rounded w-60 h-60">
                                <i class="text-danger mr-0 font-size-24 mdi mdi-car"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Waitlist Delivery </p>
                                <h3 class="text-white mb-0 font-weight-500">{{ count($Waitlist) }} <small
                                        class="text-danger"><i class="fa fa-caret-up"></i> Order </small></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                Recent All Orders
                            </h4>
                        </div>
                        @php
                            $orders = App\Models\Order::latest()
                                ->orderBy('id', 'DESC')
                                ->get();
                        @endphp
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th style="min-width: 250px"><span class="text-white">Date</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Order</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Amount</span></th>
                                            <th style="min-width: 150px"><span class="text-fade">Payment</span></th>
                                            <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                            <th style="min-width: 120px"><span class="text-fade">Process</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ Carbon\Carbon::parse($item->order_date)->diffForHumans() }}
                                                    </span>
                                                </td>

                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ $item->order_id }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-fade font-weight-600 d-block font-size-16">
                                                        Rp. {{ $item->gross_amount }}
                                                    </span>

                                                </td>

                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ ucwords($item->payment_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-primary-light badge-lg">{{ $item->status }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="#"
                                                        class="waves-effect waves-light btn btn-info btn-circle mx-5"><span
                                                            class="mdi mdi-bookmark-plus"></span></a>
                                                    <a href="#"
                                                        class="waves-effect waves-light btn btn-info btn-circle mx-5"><span
                                                            class="mdi mdi-arrow-right"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
