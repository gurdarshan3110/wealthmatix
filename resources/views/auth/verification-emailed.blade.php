<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
        <title>Store Management System</title>
<meta name="title" content="Store Management System">
<meta name="description" content="High-Quality video meetings for any business workflow, including procurement, recruitment, training, selling, support, and onboarding.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:title" content="Store Management System">
<meta property="og:description" content="High-Quality video meetings for any business workflow, including procurement, recruitment, training, selling, support, and onboarding.">
<meta property="og:image" content="{{asset('images/favicon.ico')}}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="">
<meta property="twitter:title" content="Store Management System">
<meta property="twitter:description" content="High-Quality video meetings for any business workflow, including procurement, recruitment, training, selling, support, and onboarding.">
<meta property="twitter:image" content="{{asset('images/favicon.ico')}}">
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
      <div class="d-flex flex-column flex-column-fluid bgi-position-right bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(images/layer-2@3x.png);background-position: right">
        <!--begin::Content-->
        <div class="d-flex flex flex-column flex-column-fluid p-10 pb-lg-20">
          <!--begin::Logo-->
          <a href="/" class="mb-20">
            <img alt="Logo" src="/images/watermark.png" class="h-45px" />
          </a>
          <!--end::Logo-->
          <!--begin::Wrapper-->
          <div class="w-lg-450px bg-body rounded shadow-sm p-20 p-lg-15 mx-auto mt-20">
            <!--begin::Form-->
            <!--begin::Heading-->
              <div class="text-left mb-8 mt-20">
                <!--begin::Title-->
                <h1 class="text-dark fs-2x mb-3">We’ve emailed you!</h1>
                <!--end::Title-->
              </div>
              <!--begin::Heading-->
              <!--begin::Input group-->
              <div class="fv-row mb-10">
                <p>
                  Please check your email <span class="fw-bold">{{$email}}</span>, and activate your account.
                </p>
                <p class="fw-boldest mt-8">
                  If you don’t see an email in few minutes, please follow the following steps:
                </p>
                <ul>
                  <li>Please check if the email is in Spam folder.</li>
                  <li>Please check if you there was a typo or by mistake wrong email id was entered</li>
                </ul>
                <p class="mt-16 mb-20">If any of these points are correct click here to, try again</p>
              </div>
              
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