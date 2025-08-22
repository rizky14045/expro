<?php

namespace App\Http\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Image;

class QrCodeHelper
{
    public function generateImage($inspection,$user)
    {
        $qrCode = QrCode::format('png')->size(350)->generate(route('scanner',['uuid' => $inspection->uuid]));

        // Save QR code as a temporary file to avoid binary issues
        $tempPath = public_path($inspection->id.'temp-qr-code.png');
        $fontPath = public_path('fonts/Roboto-Bold.ttf');
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

        // Title text
        $this->drawText($canvas, 'INSPECTION', 420, 115, $fontPath, 52);
        $this->drawText($canvas, 'PT Expro Jaya Mandiri', 420, 165, $fontPath, 52);
        $this->drawText($canvas, $user->name, 450, 225, $fontPath, 32);


        // Wrapped address text
        $addressText = $user->address;
        $y = $this->drawWrappedText($canvas, $addressText, 450, 265, $fontPath, 32, 1500, 40);

        // Divider
        $y += 20;
        $this->drawText($canvas, '-------------------------------------------------------------------------------', 450, $y, $fontPath, 32);

        // Type text (wrapped)
        $y += 40;
        $testY = $y;
        $typeText = 'Type : '.$inspection->object_name;
        $y = $this->drawWrappedText($canvas, $typeText, 450, $y, $fontPath, 32, 800, 40);
       
        // Area text — POSISI DINAMIS SESUDAH TYPE
        $y = $this->drawText($canvas, $inspection->object_location, 450, $y, $fontPath, 32, true); // true = return new y

        // Teks kanan (posisi tetap)
        $this->drawText($canvas, 'Test Due : '.$testDate, 1050, $testY, $fontPath, 32);
        $nextDueY = $testY + 40;
        $this->drawText($canvas, 'Next Test Due : '.$nextDate, 1050, $nextDueY, $fontPath, 32);

        unlink($tempPath);
        // 6. Simpan atau tampilkan gambar
        $imageName = 'qrcode-' . time() .'.'.'png';
        $outputPath = public_path('qrcode/'.$imageName);
        $canvas->save($outputPath);

        return $imageName;
    }


    private function drawText($canvas, $text, $x, $y, $fontPath, $fontSize, $returnNewY = false)
    {
        $canvas->text($text, $x, $y, function ($font) use ($fontPath, $fontSize) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color('#000000');
        });

        // Kembalikan posisi Y berikutnya jika diminta
        return $returnNewY ? $y + $fontSize + 10 : null;
    }

    private function drawWrappedText($canvas, $text, $x, $y, $fontPath, $fontSize, $maxWidth, $lineSpacing)
    {
        $lines = $this->wrapText($text, $fontPath, $fontSize, $maxWidth);

        foreach ($lines as $line) {
            $this->drawText($canvas, $line, $x, $y, $fontPath, $fontSize);
            $y += $lineSpacing;
        }

        return $y;
    }

    private function wrapText($text, $fontPath, $fontSize, $maxWidth)
    {
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine ? $currentLine . ' ' . $word : $word;
            $box = imagettfbbox($fontSize, 0, $fontPath, $testLine);
            $lineWidth = abs($box[2] - $box[0]);

            if ($lineWidth > $maxWidth && $currentLine !== '') {
                $lines[] = $currentLine;
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }

        if ($currentLine !== '') {
            $lines[] = $currentLine;
        }

        return $lines;
    }
}
