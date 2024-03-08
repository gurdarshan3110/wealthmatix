<!DOCTYPE html>

<html lang="en">
  
  <head>
    <title>Loanshope</title>
    <meta name="title" content="Store Management System">
    <meta property="og:image" content="{{asset('/assets/images/favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <meta property="twitter:image" content="{{asset('/assets/images/favicon.ico')}}">
    <meta property="twitter:image" content="{{asset('/assets/images/fav.ico')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    
    
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    
    
    <link href="{{asset('assets/css/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
  </head>  
  
  <body id="kt_body" class="bg-body">
    
    <div class="d-flex flex-column flex-root">
      
      <div class="d-flex flex-column flex-column-fluid bgi-position-right bgi-no-repeat bgi-size-contain bgi-attachment-fixed" >
        
        <div class="d-flex flex flex-column align-items-center p-10  mx-auto w-100 my-auto">
          
          <a href="/" class="mb-12">
            <img alt="Logo" src="{{asset('/assets/images/watermark.png')}}" class="h-200px" />
          </a>
          
          
          <div class="w-lg-500px w-100 bg-body rounded shadow-sm p-10 p-lg-15">
            
            <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST" action="{{ route('login') }}">
              @csrf
              
              <div class="text-center mb-10">
                
                <h1 class="text-dark mb-3">Sign In</h1>
                
              </div>
              
              
              <div class="fv-row mb-10">
                
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                
                
                <input class="form-control form-control-lg form-control-solid" type="text" name="email" id="email" placeholder="eg. david@hextechnologies.in" autocomplete="off" />
                @if ($errors->has('email'))
                    <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('email') }}</div>
                  @endif
                
              </div>
              
              
              <div class="fv-row mb-10">
                
                <div class="d-flex flex-stack mb-2">
                  
                  <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                  
                </div>
                
                
                <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" />
                @if ($errors->has('password'))
                  <div class="fv-plugins-message-container invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
                
              </div>
              
              <div class="fv-plugins-message-container invalid-feedback pt-5 pb-5">{{session()->get('error')}}</div>
              
              <div class="text-center">
                
                <button type="submit" id="" class="btn btn-lg btn-primary w-100 mb-5">
                  <span class="indicator-label">Continue</span>
                  <span class="indicator-progress">Please wait...
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                
              </div>
              
            </form>
            
          </div>
        </div>
        
      </div>
      
    </div>
    
    <script>var hostUrl = "assets/";</script>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
    
    
  </body>
  
</html>