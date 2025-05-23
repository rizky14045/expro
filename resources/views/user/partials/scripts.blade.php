<!-- Vendor -->
<script>
    // Fungsi untuk mengatur event listener pada semua elemen input picker
    function enablePickerOnFocus() {
        // Ambil semua elemen input dengan tipe date, month, dan datetime-local di halaman
        const pickerInputs = document.querySelectorAll('input[type="date"], input[type="month"], input[type="datetime-local"]');

        // Iterasi setiap elemen input dan tambahkan event listener
        pickerInputs.forEach(input => {
            input.addEventListener('focus', () => {
                // Buka picker saat area input diklik
                input.showPicker();
            });
        });
    }

    // Panggil fungsi saat halaman selesai di-load
    window.addEventListener('DOMContentLoaded', enablePickerOnFocus);
</script>
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script> --}}
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
            allowClear: true,
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
<script type="text/javascript">
    function printQRCode(button) {
        var img = $(button).closest('tr').find('img.qrcode')[0];
        if (!img) {
            console.error("Gambar QR Code tidak ditemukan!");
            return;
        }
        var iframe = $(button).closest('tr').find('.iframe-qrcode')[0];
        if (!iframe) {
            console.error("Iframe tidak ditemukan!");
            return;
        }
        var doc = iframe.contentWindow.document;
        doc.open();
        doc.write('<html><body><img style="height:4cm;width:auto;" src="' + $(img).attr('src') + '"/><script>window.onload = print<\/script><\/body></html>');
        doc.close();
    }
</script>

