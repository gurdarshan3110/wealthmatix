<div class="d-flex d-lg-none align-items-center ms-n2 me-2">
	<!--begin::Aside mobile toggle-->
	<div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
		<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
		<span class="svg-icon svg-icon-2x">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
				<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<a href="{{route('dashboard.index')}}" class="d-flex align-items-center">
		<img alt="Logo" src="{{asset('/assets/images/watermark.png')}}" class="h-30px" />
	</a>
	<!--end::Aside mobile toggle-->
</div>

@push('jsscript')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const mobileToggle = document.getElementById("kt_aside_toggle");
    const mobileMenu = document.getElementById("kt_docs_aside"); // Replace with your menu ID

    mobileToggle.addEventListener("click", function () {
        mobileMenu.classList.toggle("drawer-on"); 
    });

    document.addEventListener("click", function (event) {
        // Check if the click is outside the menu and toggle off the "show" class
        if (!mobileMenu.contains(event.target) && !mobileToggle.contains(event.target)) {
            mobileMenu.classList.remove("drawer-on");
        }
    });
});
</script>
@endpush