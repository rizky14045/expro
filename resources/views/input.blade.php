<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Expro Jaya Mandiri</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('fav.ico')}}">
    
        <!-- App css -->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    
        <!-- Icons -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            /* Ensure full-height without white space */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            
            .account-page, .vh-100, .bg-primary {
                min-height: 100vh; /* Always use full viewport height */
                margin: 0;
                padding: 0;
                background-color: #44546e;
            }
    
            /* Remove extra space */
            .container-fluid {
                padding: 0 !important;
            }
    
            /* Remove card overflow on smaller screens */
            .card {
                max-height: 95vh;
                overflow-y: auto;
            }
            .qrcode-mobile{
                display:none;
            }
            @media (max-width: 576px) {
                .w-50-mobile {
                    width: auto !important; /* Reset width on larger screens */
                }
                .qrcode-desktop{
                    display: none;
                }
                .qrcode-mobile{
                    display: flex;
                }
            }
            
            
        </style>
    </head>
   
    <body class="bg-white">
        <!-- Begin page -->
        <div class="account-page ">
            <div class="container-fluid p-0">
                <div style="background-color:#44546e; background-size: cover;background-repeat: no-repeat;" class="vh-100">
                    <div class="row d-flex align-items-center justify-content-center vh-100">
                        <div class="col-md-12 col-xl-9 col-sm-8 shadow-sm">
                            <div class="card p-4" style="max-height: 95vh; overflow-x: auto; max-width:100vw;">
                                <div class="card-body">
                                    <div class="text-center pb-3">
                                        <img src="{{asset('logo.png')}}" alt="logo-dark" class="mx-auto" height="50" />
                                    </div>
                                    <h5 class="text-center"></h5>
                                    <div class="d-flex justify-content-center align-item-center">
                                    <form action="{{route('inputScanner',['uuid'=>$uuid])}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                                    </form>
                                </div> <!-- end card body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- App js-->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/swal/sweetalert2.all.min.js')}}"></script>
    </body>
</html>