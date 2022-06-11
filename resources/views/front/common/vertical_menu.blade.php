@php
$categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
$subcategories = App\Models\SubCategory::latest()->get();
@endphp

<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach ($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon {{ $category->category_icon }}"
                            aria-hidden="true"></i>{{ $category->category_name }}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                <div class="px-5 col-menu">
                                    <ul class="links">
                                        @foreach ($subcategories as $subcategory)
                                            @if ($subcategory->category->category_name == $category->category_name)
                                                <li class="col-xs-12 col-sm-6 col-md-3"><a
                                                        href="#">{{ $subcategory->subcategory_name }}</a>
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
