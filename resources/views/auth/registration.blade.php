<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <title>Loanshope</title>
    <meta name="title" content="Mzigo - Logistics Solutions">
    <meta property="og:image" content="{{asset('images/favicon.ico')}}">

    <!-- Twitter -->
    <meta property="twitter:image" content="{{asset('images/favicon.ico')}}">
    <meta property="twitter:image" content="{{asset('images/fav.ico')}}">
    <link rel="icon" href="{{asset('/images/favicon.png')}}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link href="{{asset('assets/css/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
      <!--begin::Authentication - Sign-in -->
      <div class="d-flex flex-column flex-column-fluid bgi-position-right bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(images/tps.png);background-position: right;background-size: contain">
        <!--begin::Content-->
        <div class="d-flex flex flex-column align-items-center p-10  mx-auto w-100 my-auto">
          
          <a href="/" class="mb-12">
            <img alt="Logo" src="{{asset('/assets/images/watermark.png')}}" class="h-200px" />
          </a>
          <!--end::Logo-->
          <!--begin::Wrapper-->
          <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100"  method="POST" novalidate="novalidate" id="kt_sign_up_form" action="{{ route('register.custom') }}">
              @csrf
              <!--begin::Heading-->
              <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">Create your free account</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-4">Already have an account?
                <a href="{{route('login')}}" class="link-primary fw-bolder">Sign in</a></div>
                <!--end::Link-->
              </div>
              <!--begin::Heading-->
              <!--begin::Input group-->
              <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark">Full Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-lg form-control-solid" id="name" name="name" placeholder="David Candy" required autofocus autocomplete="off"/>
                @if ($errors->has('name'))
                    <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('name') }}</div>
                  @endif
                <!--end::Input-->
              </div>
              <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="text" name="email" id="email" placeholder="eg. david@loanshopee.com" autocomplete="off" />
                @if ($errors->has('email'))
                    <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('email') }}</div>
                  @endif
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="false">
                <!--begin::Wrapper-->
                <div class="mb-1">
                  <!--begin::Label-->
                  <label class="form-label fw-bolder text-dark fs-6">Phone No</label>
                  <!--end::Label-->
                  <!--begin::Input wrapper-->
                  <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" id="phone_no" name="phone_no" autocomplete="off">
                    <!-- <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                      <i class="bi bi-eye-slash fs-2"></i>
                      <i class="bi bi-eye fs-2 d-none"></i>
                    </span> -->
                  </div>
                  <!--end::Input wrapper-->
                </div>
                <!--end::Wrapper-->
                @if ($errors->has('password'))
                  <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
              </div>
              <!--end::Input group-->
              <!--begin::Actions-->
              <div class="text-center">
                <!--begin::Submit button-->
                <button type="submit" id="" class="btn btn-lg btn-primary w-100 mb-5">
                  <span class="indicator-label">Continue</span>
                  <span class="indicator-progress">Please wait...
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Submit button-->
                <!--begin::Separator-->
                <div class="text-center text-muted text-uppercase fw-bolder mb-5">or continue with</div>
                <!--end::Separator-->
                <!--begin::Google link-->
              
              
              </div>
              <!--end::Actions-->
            </form>
            <!--end::Form-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Content-->
      </div>
      <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
  </body>
  <!--end::Body-->
</html>