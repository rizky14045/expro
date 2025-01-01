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
            <h2>Lisensi anda telah diperbarui</h2>
        </div>
        <div class="paragraf" align="justify">
            <p>Pembaruan status lisensi K3 anda sedang dalam tahap:
                @if ($license->status_level == 1)
                    Diproses
                @endif
                @if ($license->status_level == 2)
                    Disetujui
                @endif
                @if ($license->status_level == 3)
                    Direvisi
                @endif
                @if ($license->status_level == 4)
                    Ditolak
                @endif
                . Kami akan memberi tahu jika ada perkembangan lebih lanjut.</p>
        </div>

        <!-- Details -->
        <div class="details">
            <table>
               <tr>
                  <th class="pe-2 text-nowrap ">Keterangan Status</th> <!-- Adjust spacing with pe-* class -->
                  <td class="text-nowrap"> : {{$license->status}}</td>
               </tr>
               <tr>
                  <th class="pe-2 text-nowrap ">Nomor Lisensi</th> <!-- Adjust spacing with pe-* class -->
                  <td class="text-nowrap"> : {{$license->number_license}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Nama Perusahaan</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap"> : {{$user->name}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Nama Personel</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->license_name}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Tanggal Lahir</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->birthdate}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Jenis Personel</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->personel_type}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Bidang Jasa</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->service_sector}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Jenis Alat</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->tool_type}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Klasifikasi</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->clasification}}</td>
               </tr>
               <tr>
                     <th class="pe-2 text-nowrap ">Kelas</th> <!-- Adjust spacing with pe-* class -->
                     <td class="text-nowrap text-capitalize"> : {{$license->class}}</td>
               </tr>
            </table>
        </div>

    </div>
</body>
</html>
