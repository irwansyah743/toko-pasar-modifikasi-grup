@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!--   ------------ Add Search Page -------- -->


                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pencarian berdasarkan Tanggal </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('search-by-date') }}">
                                    @csrf


                                    <div class="form-group">
                                        <h5>Pilih Tanggal <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" class="form-control">
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>
                                </form>


                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>




                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pencarian Berdasarkan bulan </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('search-by-month') }}">
                                    @csrf


                                    <div class="form-group">
                                        <h5>Pilih Bulan <span class="text-danger">*</span></h5>
                                        <div class="controls">

                                            <select name="month" class="form-control" required>
                                                <option label="Choose One"></option>
                                                <option value="January">Januari</option>
                                                <option value="February">Februari</option>
                                                <option value="March">Maret</option>
                                                <option value="April">April</option>
                                                <option value="May">Mei</option>
                                                <option value="June">Juni</option>
                                                <option value="July">Juli</option>
                                                <option value="August">Augustus</option>
                                                <option value="September">September</option>
                                                <option value="October">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="December">Desember</option>


                                            </select>

                                            @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>Pilih Tahun <span class="text-danger">*</span></h5>
                                        <div class="controls">

                                            <select name="year_name" class="form-control">
                                                <option label="Choose One"></option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>

                                            @error('year_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>
                                </form>


                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>





                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Select Year </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('search-by-year') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Select Year <span class="text-danger">*</span></h5>
                                        <div class="controls">

                                            <select name="year" class="form-control">
                                                <option label="Choose One"></option>

                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>

                                            @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                                    </div>
                                </form>


                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>








                <!--   ------------End  Add Search Page -------- -->


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
