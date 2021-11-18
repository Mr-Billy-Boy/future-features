<?php

namespace App\Services;

use App\Contracts\Services\QrCodeServiceInterface;
use Illuminate\Support\Facades\Crypt;
use QrCode;

class QrCodeService implements QrCodeServiceInterface
{
    // for qrcode data or display
    protected $data;
    protected $title;
    protected $subtitle;

    // for qrcode email
    protected $email;
    protected $subject;
    protected $body;

    // for phone number
    protected $phoneNumber;

    // qrcode functions/configuration
    protected $size;
    protected $format;
    protected $style;
    protected $margin;
    protected $merge;
    protected $eyeColor;
    protected $errorCorrection;

    // type of qrcode
    protected $type;

    // is data encrypted?
    protected $enCrypt;

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
        $this->title                    = 'This is the title';
        $this->subtitle                 = 'This is the subtitle';

        // set default email data
        $this->email                    = 'noreply@yondu.com';
        $this->subject                  = 'This is the subject';
        $this->body                     = 'This is the body message';

        // set default phone number
        $this->phoneNumber              = "09123456789";

        // set default qrcode type
        $this->type                     = "text";

        // set default crypt to false;
        $this->enCrypt                  = 0;
    }

    public function encode(string $data,
                           array $args = [])
    {
        $this->init($args);
        $this->data        = $data;

        return [
            'image'        => $this->generate($this->config()),
            'title'        => $this->title,
            'subtitle'     => $this->subtitle,
        ];
    }

    public function encodeEmail(string $email, 
                                string $subject, 
                                string $body, 
                                array $args = [])
    {
        $this->type         = 'email';
        $args['email']      = $email;
        $args['subject']    = $subject;
        $args['body']       = $body;

        return $this->encode('', $args);
    }

    public function phoneNumber(string $phoneNumber, 
                                array $args = [])
    {
        $this->type             = 'phonenumber';
        $args['phonenumber']    = $phoneNumber;

        return $this->encode('', $args);
    }

    private function generate($qrCode)
    {
        switch ($this->type) {
            // default
            case 'text':
                $qrCode = $qrCode->generate($this->enCrypt ?
                                            Crypt::encryptString($this->data) :
                                            $this->data);
                break;

            // ready email with subject and body
            case 'email':
                $qrCode = $qrCode->email($this->email, 
                                         $this->subject,
                                         $this->body);
                break;

            // phone number qrcode
            case 'phonenumber':
                $qrCode = $qrCode->phoneNumber($this->phoneNumber);
                break;
            
            default:
                $qrCode = false;
                break;
        }

        return $qrCode;
    }

    private function config()
    {
        $qrCode         = QrCode::size($this->size);

        // get all variable in the class
        $defaultVariable = get_class_vars(
                get_class(new QrCodeService)
            );

        foreach ($defaultVariable as $key => $value)
        {
            if (in_array($key, $this->qrSettings()))
            {
                if (in_array($key, $this->custom()))
                {
                    // use custom call for multiple parameters in QrCode method/functions
                    $qrCode = $this->customCall($qrCode, 
                                                $key);
                }
                else
                {
                    // call method using class variable
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

    private function customCall($qrCode, 
                                $key)
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

    private function init($args)
    {
        $this->title                = isset($args['title']) ? 
                                      $args['title'] : 
                                      $this->title;
        $this->subtitle             = isset($args['subtitle']) ? 
                                      $args['subtitle'] : 
                                      $this->subtitle;

        $this->size                 = isset($args['size']) ? 
                                      $args['size'] : 
                                      $this->size;
        $this->format               = isset($args['format']) ? 
                                      $args['format'] : 
                                      $this->format;
        $this->style                = isset($args['style']) ? 
                                      $args['style'] : 
                                      $this->style;
        $this->margin               = isset($args['margin']) ? 
                                      $args['margin'] : 
                                      $this->margin;
        $this->errorCorrection      = isset($args['errorCorrection']) ? 
                                      $args['errorCorrection'] : 
                                      $this->errorCorrection;

        $this->enCrypt              = isset($args['enCrypt']) ? 
                                      $args['enCrypt'] : 
                                      $this->enCrypt;

        $this->email                = isset($args['email']) ? 
                                      $args['email'] : 
                                      $this->email;
        $this->subject              = isset($args['subject']) ? 
                                      $args['subject'] : 
                                      $this->subject;
        $this->body                 = isset($args['body']) ? 
                                      $args['body'] : 
                                      $this->body;
    }

    private function qrSettings()
    {
        return [
            'size',
            'format',
            'style',
            'margin',
            'errorCorrection',
            // 'merge',
            // 'eyeColor',
        ];
    }
}