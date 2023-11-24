<?php

class TOTPGenerator
{
    public function generateSecretKey()
    {
        return $this->base32_encode(random_bytes(16));
    }

    public function generateQRCodeUrl($name, $secret, $issuer = "Kapecafe")
    {
        $name = urlencode($name);
        $issuer = urlencode($issuer);
        $url = "otpauth://totp/" . $issuer . ":" . $name . "?secret=" . $secret . "&issuer=" . $issuer . "&algorithm=SHA1&digits=6&period=30";
        return $url;
    }

    public function generateTOTP($secret)
    {
        $time = floor(time() / 30);
        $data = pack('J', $time);
        $secret = $this->base32_decode($secret);

        $hash = hash_hmac('sha1', $data, $secret, true);
        $offset = ord(substr($hash, -1)) & 0x0F;
        $truncatedHash = substr($hash, $offset, 4);

        $code = unpack('N', $truncatedHash)[1];
        $code = ($code & 0x7FFFFFFF) % 1000000;

        return str_pad($code, 6, '0', STR_PAD_LEFT);
    }

    // Custom base32 encoding function
    private function base32_encode($data)
    {
        $base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
        $base32 = "";
        $pos = 0;
        $bits = 0;

        foreach (str_split($data) as $byte) {
            $bits += (ord($byte) << $pos);
            $pos += 8;

            while ($pos >= 5) {
                $base32 .= $base32chars[($bits & 0x1F)];
                $bits >>= 5;
                $pos -= 5;
            }
        }

        if ($pos > 0) {
            $base32 .= $base32chars[($bits << (5 - $pos)) & 0x1F];
        }

        return $base32;
    }

    // Custom base32 decoding function
    private function base32_decode($base32)
    {
        $base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
        $base32charsFlipped = array_flip(str_split($base32chars));

        $output = '';
        $v = 0;
        $vbits = 0;

        for ($i = 0; $i < strlen($base32); $i++) {
            $v <<= 5;
            $v += $base32charsFlipped[$base32[$i]];
            $vbits += 5;

            if ($vbits >= 8) {
                $vbits -= 8;
                $output .= chr(($v & (0xFF << $vbits)) >> $vbits);
            }
        }

        return $output;
    }

    public function generateQRCodeImage($qrCodeUrl)
    {
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qrCodeUrl&choe=UTF-8";
    }
}
