<!-- Vendor -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<!-- Apexcharts JS -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- for basic area chart -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

<!-- Widgets Init Js -->
<script src="{{asset('assets/js/pages/analytics-dashboard.init.js')}}"></script>

<!-- App js-->
<script src="{{asset('assets/js/app.js')}}"></script>


<!-- Apexcharts JS -->
<script src="{{asset('assets/select-2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2({
            allowClear: true      // Tombol hapus
        });
    });
</script>
<script type="text/javascript" src="{{asset('assets/date-range/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/date-range/daterangepicker.min.js')}}"></script>
<script>
    $('input[name="range_date"]').daterangepicker({
        
        locale: {
                    format: 'YYYY-MM-DD',
                    }
    });
</script>
<script type="text/javascript" src="{{asset('assets/swal/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script> <!-- DataTables -->
