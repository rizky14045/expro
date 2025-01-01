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
                                    <h5 class="text-center">Detail Inspeksi</h5>
                                    <div class="d-flex justify-content-center align-item-center">
                                        <!--Content table-->
                                        <table class="w-50-mobile w-50">
                                         
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Nomor Form</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->number_inspection}}</td>
                                              </tr>
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Nama Perusahaan</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->user->name ?? ''}}</td>
                                              </tr>
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Alamat Perusahaan</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->user->address ?? ''}}</td>
                                              </tr>
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Objek yang diuji</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->object_name}}</td>
                                              </tr>
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Lokasi Objek</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->object_location}}</td>
                                              </tr>
                                              <tr>
                                                  <th class="pe-2 text-nowrap ">Tanggal Inspeksi</th> <!-- Adjust spacing with pe-* class -->
                                                  <td> : {{$inspection->inspection_date}}</td>
                                              </tr>
                                              <tr>
                                                <th class="pe-2 text-nowrap ">Status</th> <!-- Adjust spacing with pe-* class -->
                                                <td> : 
                                                    @if ($inspection->status_level == 1)
                                                        Diproses
                                                    @endif
                                                    @if ($inspection->status_level == 2)
                                                        Disetujui
                                                    @endif
                                                    @if ($inspection->status_level == 3)
                                                        Revisi
                                                    @endif
                                                    @if ($inspection->status_level == 4)
                                                        Ditolak
                                                    @endif
                                                </td>
                                              </tr>
                                              <tr>
                                                <th class="pe-2 text-nowrap ">Download File</th> <!-- Adjust spacing with pe-* class -->
                                                <td> : 
                                                    @if ($inspection->inspection_file)
                                                        <a href="{{asset('uploads/inspection_file/'.$inspection->inspection_file)}}" class="btn btn-success btn-sm" download="">Download</a>
                                                    @endif
                                                </td>
                                            </tr>

                                          </table>
                                          
                                            </div>
                                        </div>                     
                                    </div>       
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
        @include('sweetalert::alert')
    </body>
</html>