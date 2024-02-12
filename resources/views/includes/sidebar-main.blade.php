<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="docs-page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="kt_docs_aside" class="docs-aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '275px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_docs_aside_toggle">
            <!--begin::Logo-->
            <div class="docs-aside-logo flex-column-auto h-100px d-flex align-items-center" id="kt_docs_aside_logo">
                <!--begin::Link-->
                <a href="/" class="px-7 w-100 d-flex justify-content-center">
                    <img alt="Logo" src="{{ asset('/assets/images/watermark.png') }}" class="h-150px" />
                </a>
                <!--end::Link-->
            </div>
            <!--end::Logo-->
            <div class="p-2">
                <select class="form-control mt-1" id="select_store">
                   <?php echo stores();?>
                </select>
            </div>
            <!--begin::Menu-->
            <div class="docs-aside-menu flex-column-fluid h-75 overflow-scroll">
                <!--begin::Aside Menu-->
                <div class="hover-scroll-overlay-y m-3 mt-0 pe-lg-n2" id="kt_docs_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="false" data-kt-scroll-dependencies="#kt_docs_aside_logo" data-kt-scroll-wrappers="#kt_docs_aside_menu" data-kt-scroll-offset="10px">
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_docs_aside_menu" data-kt-menu="true">
                    	<?php $modules = softModules();?>
                        @foreach ($modules as $module)
                            <div class="menu-item px-4 mt-1 {{ request()->is($module->url . '*') ? 'active-menu-item' : '' }}">
                                <a class="menu-link py-2" href="{{ route($module->url.'.index') }}">
                                    <span class="menu-title">
                                        <img src="{{ $module->icon ? asset($module->icon) : asset('/assets/images/default-icon.png') }}" class="icon">
                                        <span class="m-4 mb-0 mt-0 fw-normal">{{ $module->name }}</span>
                                    </span>
                                </a>
                            </div>
                        @endforeach

                        {!! Form::open(['route' => ['logout'], 'method' => 'post']) !!}
                        <div class="menu-item px-4 mt-1">
                            {!! Form::button('<span class="menu-title"><img src="' . asset('/assets/images/logout.png') . '" class="icon"><span class="m-4 mb-0 mt-0 fw-normal">Logout</span></span>', ['type' => 'submit', 'class' => 'menu-link py-2 logout', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!--end::Menu-->
            <div class="d-flex justify-content-center position-absolute w-100">
            </div>
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
@push('jsscript')
<script type="text/javascript">
     document.getElementById('select_store').addEventListener('change', function () {
        var store_id = this.value;

        // Use Ajax to update the session value
        fetch('/select-store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Make sure to include CSRF token for Laravel
            },
            body: JSON.stringify({ store_id: store_id })
        })
        .then(response => response.json())
        .then(data => {
            location.reload();  // Reload the page
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endpush
