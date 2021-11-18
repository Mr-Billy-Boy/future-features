<?php

namespace App\Http\Controllers;

use App\Services\Contracts\QrCodeServiceInterface as QrCodeService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function qrCode(Request $request, QrCodeService $qrCodeService)
    {
        $this->data['qrcode'] = $qrCodeService->generate($request);
        $this->data['title'] = $request->title ?: '';
        $this->data['subtitle'] = $request->subtitle ?: '';

        return view('qrcode.generate', $this->data);
    }
}
