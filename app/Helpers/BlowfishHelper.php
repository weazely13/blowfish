<?php

namespace App\Helpers;

class BlowfishHelper
{
    private static function getKey(): string
    {
        $key = substr(hash('sha256', env('BLOWFISH_KEY', 'your-secret-key'), true), 0, 16);
        file_put_contents(storage_path('logs/blowfish-key.txt'), base64_encode($key));
        return $key;
    }
    public static function encryptText($plaintext): string
    {
        $iv = openssl_random_pseudo_bytes(8); // 64-bit IV for Blowfish
        $ciphertext = openssl_encrypt($plaintext, 'BF-CBC', self::getKey(), OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext);
    }

    public static function decryptText($encrypted): string
    {
        $data = base64_decode($encrypted, true);
        if ($data === false) {
            return 'Failed to decode base64.';
        }

        if (strlen($data) < 8) {
            return 'Invalid encrypted data. Too short for IV.';
        }

        $iv = substr($data, 0, 8);
        $ciphertext = substr($data, 8);
        $decrypted = openssl_decrypt($ciphertext, 'BF-CBC', self::getKey(), OPENSSL_RAW_DATA, $iv);

        return $decrypted !== false ? $decrypted : 'Decryption failed. Possibly incorrect key or tampered data.';
    }


    public static function encryptFile(string $fileContent): string
    {
        $iv = openssl_random_pseudo_bytes(8);
        $ciphertext = openssl_encrypt($fileContent, 'BF-CBC', self::getKey(), OPENSSL_RAW_DATA, $iv);
        return $iv . $ciphertext; // ✅ Return raw binary (not base64)
    }


    public static function decryptFile(string $encryptedContent): string
    {
        if (strlen($encryptedContent) < 8) return '';

        $iv = substr($encryptedContent, 0, 8);
        $ciphertext = substr($encryptedContent, 8);

        return openssl_decrypt($ciphertext, 'BF-CBC', self::getKey(), OPENSSL_RAW_DATA, $iv);
    }



}
