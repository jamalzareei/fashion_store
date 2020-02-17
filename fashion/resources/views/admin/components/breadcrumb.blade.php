<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-12">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-md-8 col-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>