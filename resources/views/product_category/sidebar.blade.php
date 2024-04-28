<aside class="col-12 col-md-2 p-0 bg-dark flex-shrink-1">
    <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
        <div class="collapse navbar-collapse ">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="{{ route('/') }}"><i class="fa fa-bullseye fa-fw"></i> <span class="font-weight-bold">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('product.list') }}"><i class="fa fa-shopping-basket fa-fw"></i> <span class="d-none d-md-inline">Product</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link pl-0" href="{{ route('product_category.list') }}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Category</span></a>
                </li>
            </ul>
        </div>
    </nav>
</aside>