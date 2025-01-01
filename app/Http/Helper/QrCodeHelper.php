<?php

namespace App\Http\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;

class QrCodeHelper
{
    public static function generateImage($inspection,$user)
    {
        $qrCode = QrCode::format('png')->size(350)->generate(route('scanner',['uuid' => $inspection->uuid]));

        // Save QR code as a temporary file to avoid binary issues
        $tempPath = public_path($inspection->id.'temp-qr-code.png');
        file_put_contents($tempPath, $qrCode);
        
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Failed to generate QR code file.'], 500);
        }
        // Load the QR code into Intervention/Image
        $qrImage = Image::make($tempPath);
        
        $testDate = Carbon::parse($inspection->inspection_date)->format('d F Y');
        $nextDate = Carbon::parse($inspection->next_test_date)->format('d F Y');
        // 2. Buat canvas utama
        $canvas = Image::canvas(1600, 480, '#ffffff'); // Ukuran gambar 800x300 dengan latar belakang putih

        // 3. Tambahkan QR Code ke canvas
        $canvas->insert($qrImage, 'left', 50, 50); // QR Code di sebelah kiri

        // 4. Tambahkan teks (seperti di contoh)

        $canvas->text('#Expro Jaya Mandiri', 420, 115, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf')); // Pastikan font file ada
            $font->size(64);
            $font->color('#000000');
        });

        $canvas->text($user->name, 465, 170, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });
        $canvas->text($user->address, 465, 220, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        $canvas->text('-------------------------------------------------------------------------------', 465, 280, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        $canvas->text('Type :'.$inspection->object_name, 465, 365, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        $canvas->text($inspection->object_location, 465, 415, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        $canvas->text('Test Due : '.$testDate, 1050, 365, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        $canvas->text('Next Test Due : '.$nextDate, 1050, 415, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(32);
            $font->color('#000000');
        });

        unlink($tempPath);
        // 6. Simpan atau tampilkan gambar
        $imageName = 'qrcode-' . time() .'.'.'png';
        $outputPath = public_path('qrcode/'.$imageName);
        $canvas->save($outputPath);

        return $imageName;
    }
}
