@php
$categories = App\Models\Category::orderBy('nama_kategori', 'ASC')->get();
$subcategories = App\Models\SubCategory::latest()->get();
@endphp

<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Kategori</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach ($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon {{ $category->ikon_kategori }}"
                            aria-hidden="true"></i>{{ $category->nama_kategori }}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                <div class="px-5 col-menu">
                                    <ul class="links">
                                        @foreach ($subcategories as $subcategory)
                                            @if ($subcategory->category->nama_kategori == $category->nama_kategori)
                                                <li class="col-xs-12 col-sm-6 col-md-3"><a
                                                        href="{{ url('/product/subcategory/' . $subcategory->getKey()) }}">{{ $subcategory->nama_subkategori }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.col -->
                                <!-- /.yamm-content -->
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.menu-item -->
            @endforeach


        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->
