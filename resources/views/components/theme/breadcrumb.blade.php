<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">{{ isset($page_name) ? $page_name : Request::segment(1) }}</h4>
            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
						@foreach ($menus as $menu)
							@if ($menu['url'] == "{$path}/")
								@foreach ($menu['breadcrumb'] as $br)
									@if(!next($menu['breadcrumb']))
										<li class="breadcrumb-item active" aria-current="page">
											{{ $br }}
										</li>
									@else
										<li class="breadcrumb-item">{{ $br }}</li>
									@endif
								@endforeach
							@endif
						
						@endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
