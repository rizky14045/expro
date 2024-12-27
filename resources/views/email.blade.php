<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pemberitahuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 120px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
            color: #555;
        }
        .details {
            font-size: 14px;
            line-height: 1.6;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .details th {
            text-align: left;
            padding-right: 10px;
            vertical-align: top;
            width: 30%; /* Memberikan lebar tetap untuk konsistensi */
        }
        .details td {
            text-align: left;
            vertical-align: top;
        }
        .details th, .details td {
            padding: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{asset('logo.png')}}" alt="Logo Image">
            <h2>Lisensi akan kedaluwarsa</h2>
        </div>
        <div class="paragraf" align="justify">
            <p>Lisensi K3 Anda akan segera kedaluwarsa! Kami informasikan bahwa masa berlaku lisensi Keselamatan dan Kesehatan Kerja (K3)  <b>Anda akan berakhir pada {{ date('d F Y', strtotime($license->expired_date)) }}</b>. Untuk memastikan kepatuhan terhadap peraturan dan menjaga kelancaran operasional, kami sarankan Anda segera memperpanjang lisensi sebelum tanggal tersebut. Jika Anda membutuhkan bantuan dalam proses perpanjangan atau informasi lebih lanjut, silakan hubungi tim dukungan kami. Tetap prioritaskan keselamatan di tempat kerja! </p>
        </div>

        <!-- Details -->
        <div class="details">
            <table>
               <tr>
                  <th class="pe-2 text-nowrap ">Nomor Lisensi</th> <!-- Adjust spacing with pe-* class -->
                  <td class="text-nowrap"> : {{$license->number_license}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Nama Lisensi</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->license_name}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Nama Perusahaan</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap"> : {{$user->name}}</td>
               </tr>
            </table>
        </div>
        <div class="paragraf" align="justify">
            <p>Terima kasih atas perhatian Anda. Mari bersama-sama menjaga keselamatan dan kesehatan kerja sebagai prioritas utama di lingkungan kerja! </p>
        </div>

    </div>
</body>
</html>
