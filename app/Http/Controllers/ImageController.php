<?php

namespace App\Http\Controllers;

use App\Contracts\Services\QrCodeServiceInterface as QrCodeService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function qrCode(Request $request, QrCodeService $qrCodeService)
    {
        $this->data = $qrCodeService->encode($request->data, 
                                             [
                                                 'title'    => $request->title,
                                                 'subtitle' => $request->subtitle,
                                                 'enCrypt'  => $request->encrypt
                                             ]);

        // $this->data = $qrCodeService->encodeEmail($request->email,
        //                                           $request->subject,
        //                                           $request->body,
        //                                           [
        //                                               'title'    => $request->title,
        //                                               'subtitle' => $request->subtitle,
        //                                               'enCrypt'  => $request->encrypt
        //                                           ]);

        // $this->data = $qrCodeService->phoneNumber($request->phonenumber,
        //                                           [
        //                                               'title'    => $request->title,
        //                                               'subtitle' => $request->subtitle,
        //                                               'enCrypt'  => $request->encrypt
        //                                           ]);

        return view('qrcode.generate', $this->data);
    }
}
