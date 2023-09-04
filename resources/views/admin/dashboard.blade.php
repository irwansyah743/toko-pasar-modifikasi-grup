@extends('admin.master')
@section('content')
    @php
    $month = date('F');
    $month = App\Models\Order::where('bulan_pesanan', $month)->sum('nominal_total');
    $year = date('Y');
    $year = App\Models\Order::where('tahun_pesanan', $year)->sum('nominal_total');
    $pending = App\Models\Order::where('status', 'pending')->get();
    $Waitlist = App\Models\Shipping::where('status_pengiriman', 0)->get();
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
                                <p class="text-mute mt-20 mb-0 font-size-16">Penjualan Bulanan </p>
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
                                <p class="text-mute mt-20 mb-0 font-size-16">Penjualan Tahunan </p>
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
                                <p class="text-mute mt-20 mb-0 font-size-16">Pesanan Tertunda </p>
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
                                <p class="text-mute mt-20 mb-0 font-size-16">Pengiriman Daftar Tunggu </p>
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
                            Semua Pesanan Terbaru
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
                                            <th style="min-width: 250px"><span class="text-white">Tanggal</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Pesanan</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Jumlah</span></th>
                                            <th style="min-width: 150px"><span class="text-fade">Pembayaran</span></th>
                                            <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td class="pl-0 py-8">
                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ Carbon\Carbon::parse($item->tanggal_pesanan)->diffForHumans() }}
                                                    </span>
                                                </td>

                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ $item->id_pesanan }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-fade font-weight-600 d-block font-size-16">
                                                        Rp. {{ $item->nominal_total }}
                                                    </span>

                                                </td>

                                                <td>

                                                    <span class="text-white font-weight-600 d-block font-size-16">
                                                        {{ ucwords($item->tipe_pembayaran) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-primary-light badge-lg">{{ $item->status }}</span>
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
