<?php

namespace App\Http\Controllers;

use App\Contracts\Services\QrCodeServiceInterface as QrCodeService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function encode(Request $request, QrCodeService $qrCodeService)
    {
        $this->data = $qrCodeService->encode($request->data, 
                                             [
                                                 'title'    => $request->title,
                                                 'subtitle' => $request->subtitle,
                                                 'enCrypt'  => $request->encrypt
                                             ]);

        return view('qrcode.generate', $this->data);
    }

    public function encodeEmail(Request $request, QrCodeService $qrCodeService)
    {
        $this->data = $qrCodeService->encodeEmail($request->email,
                                                  $request->subject,
                                                  $request->body,
                                                  [
                                                      'title'    => $request->title,
                                                      'subtitle' => $request->subtitle,
                                                  ]);

        return view('qrcode.generate', $this->data);
    }

    public function encodePhoneNumber(Request $request, QrCodeService $qrCodeService)
    {
        $this->data = $qrCodeService->encodePhoneNumber($request->phonenumber,
                                                        [
                                                            'title'    => $request->title,
                                                            'subtitle' => $request->subtitle,
                                                        ]);

        return view('qrcode.generate', $this->data);
    }
}
