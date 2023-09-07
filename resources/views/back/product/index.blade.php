@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Produk <span class="badge badge-pill badge-danger">
                                    {{ count($products) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Gambar </th>
                                            <th>Produk</th>
                                            <th>Harga Produk </th>
                                            <th>Kuantitas </th>
                                            <th>Diskon </th>
                                            <th>Status </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td> <img src="{{ asset('storage/' . $item->thumbnail_produk) }}"
                                                        style="width: 60px; height: 50px;"> </td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>Rp.{{ $item->harga_jual }}</td>
                                                <td>
                                                    @foreach ($item->productDetail as $val)
                                                        <p>{{ $val->warna_produk }} {{ $val->ukuran_produk }} : <b>{{ $val->kuantitas_produk }} Pcs</b></p>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @if ($item->harga_diskon == null)
                                                        <span class="badge badge-pill badge-danger">Tidak ada Diskon</span>
                                                    @else
                                                        @php
                                                            $amount = $item->harga_jual - $item->harga_diskon;
                                                            $discount = ($amount / $item->harga_jual) * 100;
                                                        @endphp
                                                        <span class="badge badge-pill badge-danger">{{ round($discount) }}
                                                            %</span>
                                                    @endif



                                                </td>

                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-pill badge-success"> Active </span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger"> InActive </span>
                                                    @endif

                                                </td>


                                                <td width="30%">


                                                    <a href="{{ route('product.edit', $item->getKey()) }}" class="btn btn-info"
                                                        title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                    <form method="POST" id="{{ 'deleteproduct' . $item->getKey() }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="button" class="btn btn-danger delete-button"
                                                            onclick="deleteConfirmation('product',{{ $item->getKey() }})">
                                                            <i class="fa fa-trash"></i></button>
                                                    </form>

                                                    @if ($item->status == 1)
                                                        <form method="POST"
                                                            action="{{ route('product.inactive', $item->getKey()) }}"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-danger"
                                                                title="Inactivate">
                                                                <i class="fa fa-arrow-down"></i></button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('product.active', $item->getKey()) }}"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('put')
                                                            <button type="submit" class="btn btn-success" title="Activate">
                                                                <i class="fa fa-arrow-up"></i></button>
                                                        </form>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->





            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
