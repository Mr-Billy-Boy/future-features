<?php

namespace App\Contracts\Services;

interface QrCodeServiceInterface 
{
    /*
     * Generate plain text QR Code
     *
     * @param string $data
     * @param array $args[]
     * @return array with image base64
     */
    public function encode(string $data, 
                           array $args = []);

    /*
     * Generate ready email QR Code
     *
     * @param string $email
     * @param string $title
     * @param string $subtitle
     * @return array with image base64
     */
    public function encodeEmail(string $email, 
                                string $subject, 
                                string $body, 
                                array $args = []);

    /**
     * Generate Phone Number QR Code
     *
     * @param string $phoneNumber
     * @return array with image base64
     */
    public function phoneNumber(string $phoneNumber, 
                                array $args = []);
}