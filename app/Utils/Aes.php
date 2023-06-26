<?php
namespace App\Utils;

use Exception;

class Aes{

    private $key, $iv;

    public function __construct(){
        $this->key = env('KEY_AES');
    }

    public function enkripAes($data)
   {
    // Pemeriksaan panjang kunci
    if (strlen($this->key) !== 16) {
        throw new Exception("Kunci harus memiliki panjang 16 byte (128 bit).");
    }

    // Enkripsi menggunakan AES-128-CBC
    $encrypted = openssl_encrypt($data, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
    if ($encrypted === false) {
        throw new Exception("Terjadi kesalahan dalam proses enkripsi.");
    }

    // Menginisialisasi ciphertext
    $ciphertext = $encrypted;

    // Base64 encode ciphertext agar dapat dikirimkan sebagai string
    $encodedCiphertext = base64_encode($ciphertext);

    return $encodedCiphertext;
    }

    public function dekripAes($encodedCiphertext)
    {
        // Pemeriksaan panjang kunci
        if (strlen($this->key) !== 16) {
            throw new Exception("Kunci harus memiliki panjang 16 byte (128 bit).");
        }

        // Base64 decode ciphertext
        $ciphertext = base64_decode($encodedCiphertext);

        // Dekripsi menggunakan AES-128-CBC
        $decrypted = openssl_decrypt($ciphertext, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA);
        return $decrypted;
    }
}
