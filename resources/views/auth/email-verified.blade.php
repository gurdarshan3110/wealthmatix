@include('includes.header')
<link rel="stylesheet" href="https://www.jquery-az.com/jquery/css/intlTelInput/intlTelInput.css">
<div class="modal fade  bg-light" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" id="firstEntry" tabindex="-1">
    <!--begin::Modal dialog-->
    <img alt="Logo" src="/images/watermark.png" srcset="/images/watermark@2x.png 2x,/images/watermark@3x.png 3x" class="p-10">
    <div class="modal-dialog pt-20 mw-425px">
      	<!--begin::Modal content-->
        <div class="bg-light modal-content shadow-none">
            <div class="modal-title text-center fs-2x fw-boldest pb-2 bg-light" id="">
            	<img src="/images/layer-16.png" srcset="/images/layer-16@2x.png 2x,/images/layer-16@3x.png 3x" class="icon-2x">
            	Hello {{$user->name}} !
            </div>
            <div class="modal-title text-center fs-4 pb-8 mb-5 bg-light" id="">
            	Good to see you here
            </div>
            <div class="modal-title text-center fs-4 p-2 bg-light overlapped-msg" id="">
            	<img src="/images/iconmonstr-checkbox-20-32.png" srcset="/images/iconmonstr-checkbox-20-32@2x.png 2x,/images/iconmonstr-checkbox-20-32@3x.png 3x"> Your email is now verified!
            </div>
            <div class="modal-content">
	        <!--begin::Form-->

	        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_modal_add_customer_form">
	          <!--begin::Modal body-->
	          <div class="modal-body py-10 px-lg-12">
	          	<h2 class="fw-bolder mb-6">Personalise experience as a final step</h2>
	            <!--begin::Scroll-->
	            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
	              <div class="fv-row mb-7 fv-plugins-icon-container">
	                <!--begin::Label-->
	                <label class="fs-6 fw-bold mb-2">Location</label>
	                <!--end::Label-->
	                <!--begin::Input-->
	                <input type="text" class="form-control" placeholder="Enter City / Country" name="location" id="location">
	                <!--end::Input-->
	              	<div class="fv-plugins-message-container invalid-feedback"></div>
	              </div>
	              <div class="fv-row mb-7 fv-plugins-icon-container">
	                <!--begin::Label-->
	                <label class="fs-6 fw-bold mb-2 w-100">Mobile No.</label>
	                <!--end::Label-->
	                <!--begin::Input-->
	                <input type="tel" class="form-control w-100" placeholder="eg. +971 xx xxx xxxx" name="phone_no" id="phone_no">
	                <!--end::Input-->
	              	<div class="fv-plugins-message-container invalid-feedback"></div>
	              </div>
	              <div class="fv-row mb-7 fv-plugins-icon-container">
	                <!--begin::Label-->
	                <label class="fs-6 fw-bold mb-2">Website</label>
	                <!--end::Label-->
	                <!--begin::Input-->
	                <input type="text" class="form-control" placeholder="eg. https://yourwebsite.com" name="website" id="website">
	                <!--end::Input-->
	              	<div class="fv-plugins-message-container invalid-feedback"></div>
	              </div>
	            </div>
	            <!--end::Scroll-->
	            <!--begin::Button-->
	            <button type="submit" id="saveProfile" class="btn btn-primary mt-6 w-100">
	              <span class="indicator-label">We are done</span>
	            </button>
	            <!--end::Button-->
	          </div>
	          <!--end::Modal body-->
	          
	        </form>
	        <!--end::Form-->
	      </div>
        </div>
        <div class="text-center mt-6 bg-light modal-content shadow-none">
        	<a class="text-link" href="/"><img src="/images/iconmonstr-arrow-71-17.png" srcset="/images/iconmonstr-arrow-71-17@2x.png 2x,/images/iconmonstr-arrow-71-17@3x.png 3x" class="fs-3"> Skip for now</a>
        </div>
    </div>
</div>
<div class="modal fade  bg-light" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" id="quickSetup" tabindex="-1">
    <!--begin::Modal dialog-->
    <img alt="Logo" src="/images/watermark.png" srcset="/images/watermark@2x.png 2x,/images/watermark@3x.png 3x" class="p-10">
    <div class="modal-dialog pt-20 mw-425px">
      	<!--begin::Modal content-->
        <div class="bg-light modal-content shadow-none">
            <div class="modal-title text-center fs-2x fw-boldest pb-2 bg-light" id="">
            	<img src="/images/layer-16.png" srcset="/images/layer-16@2x.png 2x,/images/layer-16@3x.png 3x" class="icon-2x">
            	Hello {{$user->name}} !
            </div>
            <div class="modal-title text-center fs-4 pb-6 bg-light" id="">
            	Good to see you here
            </div>
            <div class="modal-content">
	        <!--begin::Form-->
	        <form class="form fv-plugins-bootstrap5 fv-plugins-framework" id="kt_modal_add_customer_form">
	        	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
	          <!--begin::Modal body-->
	          <div class="modal-body py-10 px-lg-12">
	          	<h4 class="fw-bolder text-center">
	          		Welcome! Quickstart & deploy an embedable video conferencing app
	          	</h4>
	          	<p class="mb-6 text-center">Without writing a single code. No server setup.</p>
	            <!--begin::Scroll-->
	            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
	              <div class="fv-row mb-7 fv-plugins-icon-container">
	                <!--begin::Label-->
	                <label class="required fs-6 fw-bold mb-2">Project Name/Title</label>
	                <!--end::Label-->
	                <!--begin::Input-->
	                <input type="text" class="form-control" placeholder="Enter Name / Title" name="project_name" id="project_name">
	                <!--end::Input-->
	              	<div class="fv-plugins-message-container invalid-feedback"></div>
	              </div>
	            </div>
	            <!--end::Scroll-->
	            <!--begin::Button-->
	            <button type="submit" id="quickStart" class="btn btn-primary mt-6 w-100">
	              <span class="indicator-label" id="save">Get Started at No Cost</span>
	            </button>
	            <!--end::Button-->
	          </div>
	          <!--end::Modal body-->
	          
	        </form>
	        <!--end::Form-->
	      </div>
        </div>
        <div class="text-center mt-6 bg-light modal-content shadow-none">
        	<a class="text-link" href="/"><img src="/images/iconmonstr-arrow-71-17.png" srcset="/images/iconmonstr-arrow-71-17@2x.png 2x,/images/iconmonstr-arrow-71-17@3x.png 3x" class="fs-3"> Skip for now</a>
        </div>
    </div>
</div>
<div class="modal fade  bg-light" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" id="defaultProject" tabindex="-1">
    <!--begin::Modal dialog-->
    <img alt="Logo" src="/images/watermark.png" srcset="/images/watermark@2x.png 2x,/images/watermark@3x.png 3x" class="p-10">
    <div class="modal-dialog pt-20 mw-350px">
      	<!--begin::Modal content-->
        <div class="bg-light modal-content shadow-none">
            <div class="modal-title text-center fs-1 fw-boldest pb-6 bg-light" id="headingText">Getting Started</div>
            <div class="card p-10">
              <div class="successImage text-center d-none"><img src="/images/party.png" srcset="/images/party@2x.png 2x,/images/party@3x.png 3x" class="party"></div>
              <h1 class="successText text-center d-none">Yay!</h1>
              <h3 class="text-center pb-5" id="popupHeading">Creating a default project for you at a speed of the jet</h3>
              <div class="row mt-3">
                <div class="col-sm-4 justify-content-end d-flex">
                  <img src="/images/iconmonstr-forbidden-3-32-copy-2.png" id="creatingProject" class="icon"/>
                </div>
                <div class="col-sm-8 justify-content-start d-flex" id="creatingProjectText">Creating Project</div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-4 justify-content-end d-flex">
                  <img src="/images/iconmonstr-forbidden-3-32-copy-2.png" id="creatingRoles" class="icon">
                </div>
                <div class="col-sm-8 justify-content-start d-flex" id="creatingRolesText">Creating Roles</div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-4 justify-content-end d-flex">
                  <img src="/images/iconmonstr-forbidden-3-32-copy-2.png" id="assigningPermissions" class="icon">
                </div>
                <div class="col-sm-8 justify-content-start d-flex" id="assigningPermissionsText">Assigning Permissions</div>
              </div>
              <div class="row mt-2">
                <div class="col-sm-4 justify-content-end d-flex">
                  <img src="/images/iconmonstr-forbidden-3-32-copy-2.png" id="generatingsApis" class="icon">
                </div>
                <div class="col-sm-8 justify-content-start d-flex" id="generatingsApisText">Generating Api Keys</div>
              </div>
              <p class="text-center fs-4 pt-5" id="supportingText">Please stay tuned, while we finish in <br>less than a minute!</p>
              <div class="projectLink mt-8 text-center"></div>
          	</div>
        </div>
    </div>
</div>
<div class="modal fade  bg-light" data-bs-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" id="quickCode" tabindex="-1">
    <!--begin::Modal dialog-->
    <img alt="Logo" src="/images/watermark.png" srcset="/images/watermark@2x.png 2x,/images/watermark@3x.png 3x" class="p-10">
    <div class="modal-dialog pt-20 mw-1000px">
      	<!--begin::Modal content-->
        <div class="bg-light modal-content shadow-none">
            <div class="modal-title text-center fs-2x fw-boldest pb-2 bg-light" id="">
            	Install your white-labeled<br>video meeting project
            </div>
            <div class="modal-title text-center fs-4 pb-6 bg-light" id="">
            	What will you use this video meeting project for?
            </div>
            <div class="modal-content p-10">
	        	<div class="py-5">
                  <!--begin::Highlight-->
                  <div class="highlight">
                    <button class="highlight-copy btn" data-bs-toggle="tooltip" title="" data-bs-original-title="Copy code">copy</button>
                    <div class="highlight-code">
                      <pre class=" language-html fs-6" tabindex="0"><code class=" language-html fs-6"></code></pre>
                    </div>
                  </div>
                  <!--end::Highlight-->
                </div>
	      </div>
        </div>
        <div class="text-center mt-6 bg-light modal-content shadow-none">
        	<a class="text-link" href="/"><img src="/images/iconmonstr-arrow-71-17.png" srcset="/images/iconmonstr-arrow-71-17@2x.png 2x,/images/iconmonstr-arrow-71-17@3x.png 3x" class="fs-3"> Go to Dashboard instead</a>
        </div>
    </div>
</div>

@include('includes.footer-outer')