<?php

namespace App\Services;

use App\Services\Contracts\QrCodeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use QrCode;

class QrCodeService implements QrCodeServiceInterface
{

    // for qrcode data or display
    protected $data,
        $title,
        $subtitle;

    // qrcode funcstion/configuration
    protected $size,
        $format,
        $style,
        $margin,
        $merge,
        $eyeColor,
        $errorCorrection;

    public function __construct()
    {
        /*
        * Visit this docs for more info about QR Code functions
        * https://www.simplesoftware.io/#/docs/simple-qrcode
        */

        // set default values/configuration
        $this->size                     = 250;
        $this->format                   = 'png';
        $this->style                    = 'square';
        $this->margin                   = 0;
        $this->errorCorrection          = 'H';
        $this->merge                    = '/public/logo/logo.png|.3';
        $this->eyeColor                 = '0|0|0|0|0|0|0';

        // set default data
        $this->data                     = 'No data pass in QR Code';
        $this->title                    = 'This is a sample title';
        $this->subtitle                 = 'Sample Subtitle';
    }

    public function generate($request)
    {
        $this->init($request);

        return ($this->config())
            ->generate(
                Crypt::encryptString($this->data)
            );
    }

    private function config()
    {
        $qrCode         = QrCode::size($this->size);

        $defaultVariable = get_class_vars(
                get_class(new QrCodeService)
            );

        foreach ($defaultVariable as $key => $value)
        {
            if (!in_array($key, $this->except()))
            {
                if (in_array($key, $this->custom()))
                {
                    $qrCode = $this->customCall($qrCode, $key);
                }
                else
                {
                    $qrCode->$key($this->$key);
                }
            }
        }

        return $qrCode;
    }

    private function custom()
    {
        return [
            'merge',
            'eyeColor',
        ];
    }

    private function customCall($qrCode, $key)
    {
        switch ($key) {
            case 'merge':
                // $qrCode->merge('/public/logo/logo.png', .3);
                break;

            case 'eyeColor':
                // $qrCode->eyeColor(0, 0, 0, 0, 0, 0, 0);
                break;
            
            default:
                break;
        }

        return $qrCode;
    }

    private function init($request)
    {
        $this->data                 = $request->data ?: $this->data;
        $this->data                 = $request->data ?: $this->data;
        $this->data                 = $request->data ?: $this->data;

        $this->size                 = $request->size ?: $this->size;
        $this->format               = $request->format ?: $this->format;
        $this->style                = $request->style ?: $this->style;
        $this->margin               = $request->margin ?: $this->margin;
        $this->errorCorrection      = $request->errorCorrection ?: $this->errorCorrection;

        return $request;
    }

    private function except()
    {
        return [
            'data',
            'title',
            'subtitle',
            'size',
        ];
    }
}