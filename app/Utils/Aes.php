<?php
namespace App\Utils;

use Exception;
use function env;

class Aes{

    private $key, $iv;

    public function __construct(){
        $this->key = $this->splitBytes("ThisIsASecretKey");
        $this->iv = $this->splitBytes("ThisIsAnIV123456");
    }

    // Fungsi untuk membagi string menjadi blok byte
    private function splitBytes($string){
        $bytes = [];
        for ($i = 0; $i < strlen($string); $i++) {
            $bytes[] = ord($string[$i]);
        }
        return $bytes;
    }

    // Fungsi untuk menggabungkan blok byte menjadi string
    private function combineBytes($bytes){
        $string = "";
        foreach ($bytes as $byte) {
            $string .= chr($byte);
        }
        return $string;
    }

    // Fungsi untuk melakukan XOR antara dua blok byte
    public function xorBytes($a, $b){
        $result = [];
        for ($i = 0; $i < count($a); $i++) {
            $result[] = $a[$i] ^ $b[$i];
        }
        return $result;
    }

    // Fungsi untuk melakukan substitusi byte berdasarkan S-box
    public function substituteBytes($block){
        $sBox = [
            0x63, 0x7C, 0x77, 0x7B, 0xF2, 0x6B, 0x6F, 0xC5, 0x30, 0x01, 0x67, 0x2B, 0xFE, 0xD7, 0xAB, 0x76,
            0xCA, 0x82, 0xC9, 0x7D, 0xFA, 0x59, 0x47, 0xF0, 0xAD, 0xD4, 0xA2, 0xAF, 0x9C, 0xA4, 0x72, 0xC0,
            0xB7, 0xFD, 0x93, 0x26, 0x36, 0x3F, 0xF7, 0xCC, 0x34, 0xA5, 0xE5, 0xF1, 0x71, 0xD8, 0x31, 0x15,
            0x04, 0xC7, 0x23, 0xC3, 0x18, 0x96, 0x05, 0x9A, 0x07, 0x12, 0x80, 0xE2, 0xEB, 0x27, 0xB2, 0x75,
            0x09, 0x83, 0x2C, 0x1A, 0x1B, 0x6E, 0x5A, 0xA0, 0x52, 0x3B, 0xD6, 0xB3, 0x29, 0xE3, 0x2F, 0x84,
            0x53, 0xD1, 0x00, 0xED, 0x20, 0xFC, 0xB1, 0x5B, 0x6A, 0xCB, 0xBE, 0x39, 0x4A, 0x4C, 0x58, 0xCF,
            0xD0, 0xEF, 0xAA, 0xFB, 0x43, 0x4D, 0x33, 0x85, 0x45, 0xF9, 0x02, 0x7F, 0x50, 0x3C, 0x9F, 0xA8,
            0x51, 0xA3, 0x40, 0x8F, 0x92, 0x9D, 0x38, 0xF5, 0xBC, 0xB6, 0xDA, 0x21, 0x10, 0xFF, 0xF3, 0xD2,
            0xCD, 0x0C, 0x13, 0xEC, 0x5F, 0x97, 0x44, 0x17, 0xC4, 0xA7, 0x7E, 0x3D, 0x64, 0x5D, 0x19, 0x73,
            0x60, 0x81, 0x4F, 0xDC, 0x22, 0x2A, 0x90, 0x88, 0x46, 0xEE, 0xB8, 0x14, 0xDE, 0x5E, 0x0B, 0xDB,
            0xE0, 0x32, 0x3A, 0x0A, 0x49, 0x06, 0x24, 0x5C, 0xC2, 0xD3, 0xAC, 0x62, 0x91, 0x95, 0xE4, 0x79,
            0xE7, 0xC8, 0x37, 0x6D, 0x8D, 0xD5, 0x4E, 0xA9, 0x6C, 0x56, 0xF4, 0xEA, 0x65, 0x7A, 0xAE, 0x08,
            0xBA, 0x78, 0x25, 0x2E, 0x1C, 0xA6, 0xB4, 0xC6, 0xE8, 0xDD, 0x74, 0x1F, 0x4B, 0xBD, 0x8B, 0x8A,
            0x70, 0x3E, 0xB5, 0x66, 0x48, 0x03, 0xF6, 0x0E, 0x61, 0x35, 0x57, 0xB9, 0x86, 0xC1, 0x1D, 0x9E,
            0xE1, 0xF8, 0x98, 0x11, 0x69, 0xD9, 0x8E, 0x94, 0x9B, 0x1E, 0x87, 0xE9, 0xCE, 0x55, 0x28, 0xDF,
            0x8C, 0xA1, 0x89, 0x0D, 0xBF, 0xE6, 0x42, 0x68, 0x41, 0x99, 0x2D, 0x0F, 0xB0, 0x54, 0xBB, 0x16
        ];
        $result = [];
        foreach ($block as $byte) {
            $result[] = $sBox[$byte];
        }
        return $result;
    }

    // Fungsi untuk melakukan shift baris
    public function shiftRows($block){
        $shifted = [];
        $shifted[0] = $block[0];
        $shifted[1] = $block[5];
        $shifted[2] = $block[10];
        $shifted[3] = $block[15];

        $shifted[4] = $block[4];
        $shifted[5] = $block[9];
        $shifted[6] = $block[14];
        $shifted[7] = $block[3];

        $shifted[8] = $block[8];
        $shifted[9] = $block[13];
        $shifted[10] = $block[2];
        $shifted[11] = $block[7];

        $shifted[12] = $block[12];
        $shifted[13] = $block[1];
        $shifted[14] = $block[6];
        $shifted[15] = $block[11];

        return $shifted;
    }

    // Fungsi untuk melakukan mix kolom
    public function mixColumns($block)
    {
        $mixed = [];
        $mixed[0] = galoisMult(0x02, $block[0]) ^ galoisMult(0x03, $block[1]) ^ $block[2] ^ $block[3];
        $mixed[1] = $block[0] ^ galoisMult(0x02, $block[1]) ^ galoisMult(0x03, $block[2]) ^ $block[3];
        $mixed[2] = $block[0] ^ $block[1] ^ galoisMult(0x02, $block[2]) ^ galoisMult(0x03, $block[3]);
        $mixed[3] = galoisMult(0x03, $block[0]) ^ $block[1] ^ $block[2] ^ galoisMult(0x02, $block[3]);

        $mixed[4] = galoisMult(0x02, $block[4]) ^ galoisMult(0x03, $block[5]) ^ $block[6] ^ $block[7];
        $mixed[5] = $block[4] ^ galoisMult(0x02, $block[5]) ^ galoisMult(0x03, $block[6]) ^ $block[7];
        $mixed[6] = $block[4] ^ $block[5] ^ galoisMult(0x02, $block[6]) ^ galoisMult(0x03, $block[7]);
        $mixed[7] = galoisMult(0x03, $block[4]) ^ $block[5] ^ $block[6] ^ galoisMult(0x02, $block[7]);

        $mixed[8] = galoisMult(0x02, $block[8]) ^ galoisMult(0x03, $block[9]) ^ $block[10] ^ $block[11];
        $mixed[9] = $block[8] ^ galoisMult(0x02, $block[9]) ^ galoisMult(0x03, $block[10]) ^ $block[11];
        $mixed[10] = $block[8] ^ $block[9] ^ galoisMult(0x02, $block[10]) ^ galoisMult(0x03, $block[11]);
        $mixed[11] = galoisMult(0x03, $block[8]) ^ $block[9] ^ $block[10] ^ galoisMult(0x02, $block[11]);

        $mixed[12] = galoisMult(0x02, $block[12]) ^ galoisMult(0x03, $block[13]) ^ $block[14] ^ $block[15];
        $mixed[13] = $block[12] ^ galoisMult(0x02, $block[13]) ^ galoisMult(0x03, $block[14]) ^ $block[15];
        $mixed[14] = $block[12] ^ $block[13] ^ galoisMult(0x02, $block[14]) ^ galoisMult(0x03, $block[15]);
        $mixed[15] = galoisMult(0x03, $block[12]) ^ $block[13] ^ $block[14] ^ galoisMult(0x02, $block[15]);

        return $mixed;
    }

    // Fungsi untuk mengalikan dua bilangan dalam Galois Field
    private static function galoisMult($a, $b)
    {
        $p = 0;
        $hbit = 0;
        for ($i = 0; $i < 8; $i++) {
            if ($b & 1) {
                $p ^= $a;
            }
            $hbit = $a & 0x80;
            $a <<= 1;
            if ($hbit) {
                $a ^= 0x1B; // polinomial irreduksi x^8 + x^4 + x^3 + x + 1
            }
            $b >>= 1;
        }
        return $p;
    }

    // Fungsi untuk menghasilkan kunci putar dari kunci utama
    public function generateRoundKeys()
    {
        $roundKeys = [];
        $roundKeys[0] = $this->key;

        for ($i = 1; $i <= 10; $i++) {
            $temp = $roundKeys[$i - 1];

            // Rotasi word
            $temp = $this->rotateWord($temp);

            // Substitusi byte
            $temp = $this->substituteWord($temp);

            // XOR dengan Rcon
            $rcon = [0x00, 0x00, 0x00, 0x00];
            $rcon[0] = 0x01 << ($i - 1);
            $temp = xorBytes($temp, $rcon);

            // XOR dengan word sebelumnya
            $temp = xorBytes($temp, $roundKeys[$i - 1]);

            $roundKeys[$i] = $temp;
        }

        return $roundKeys;
    }

    // Fungsi untuk melakukan rotasi word
    public function rotateWord($word)
    {
        $temp = $word[0];
        $word[0] = $word[1];
        $word[1] = $word[2];
        $word[2] = $word[3];
        $word[3] = $temp;

        return $word;
    }

    // Fungsi untuk melakukan substitusi word berdasarkan S-box
    public function substituteWord($word)
    {
        $result = [];
        foreach ($word as $byte) {
            $result[] = $this->substituteBytes($byte);
        }
        return $result;
    }

    // Fungsi untuk membalikkan shift baris
    public function inverseShiftRows($block)
    {
        $shifted = [];
        $shifted[0] = $block[0];
        $shifted[1] = $block[13];
        $shifted[2] = $block[10];
        $shifted[3] = $block[7];

        $shifted[4] = $block[4];
        $shifted[5] = $block[1];
        $shifted[6] = $block[14];
        $shifted[7] = $block[11];

        $shifted[8] = $block[8];
        $shifted[9] = $block[5];
        $shifted[10] = $block[2];
        $shifted[11] = $block[15];

        $shifted[12] = $block[12];
        $shifted[13] = $block[9];
        $shifted[14] = $block[6];
        $shifted[15] = $block[3];

        return $shifted;
    }

    // Fungsi untuk membalikkan mix kolom
    public static function inverseMixColumns($block)
    {
        $mixed = [];
        $mixed[0] = self::galoisMult(0x0e, $block[0]) ^ self::galoisMult(0x0b, $block[1]) ^ self::galoisMult(0x0d, $block[2]) ^ self::galoisMult(0x09, $block[3]);
        $mixed[1] = self::galoisMult(0x09, $block[0]) ^ self::galoisMult(0x0e, $block[1]) ^ self::galoisMult(0x0b, $block[2]) ^ self::galoisMult(0x0d, $block[3]);
        $mixed[2] = self::galoisMult(0x0d, $block[0]) ^ self::galoisMult(0x09, $block[1]) ^ self::galoisMult(0x0e, $block[2]) ^ self::galoisMult(0x0b, $block[3]);
        $mixed[3] = self::galoisMult(0x0b, $block[0]) ^ self::galoisMult(0x0d, $block[1]) ^ self::galoisMult(0x09, $block[2]) ^ self::galoisMult(0x0e, $block[3]);

        $mixed[4] = self::galoisMult(0x0e, $block[4]) ^ self::galoisMult(0x0b, $block[5]) ^ self::galoisMult(0x0d, $block[6]) ^ self::galoisMult(0x09, $block[7]);
        $mixed[5] = self::galoisMult(0x09, $block[4]) ^ self::galoisMult(0x0e, $block[5]) ^ self::galoisMult(0x0b, $block[6]) ^ self::galoisMult(0x0d, $block[7]);
        $mixed[6] = self::galoisMult(0x0d, $block[4]) ^ self::galoisMult(0x09, $block[5]) ^ self::galoisMult(0x0e, $block[6]) ^ self::galoisMult(0x0b, $block[7]);
        $mixed[7] = self::galoisMult(0x0b, $block[4]) ^ self::galoisMult(0x0d, $block[5]) ^ self::galoisMult(0x09, $block[6]) ^ self::galoisMult(0x0e, $block[7]);

        return $mixed;
    }

    // Fungsi untuk mengenkripsi plaintext menggunakan AES-128 dalam mode CBC
    public function enkripAes($plaintext)
    {
        $state = $this->splitBytes($plaintext);

        // Inisialisasi kunci putar
        $roundKeys = $this->generateRoundKeys($this->key);

        // XOR plaintext dengan IV (Initialization Vector)
        $state = $this->xorBytes($state, $this->iv);

        // Add Round Key (Initial Round)
        $state = $this->xorBytes($state, $roundKeys[0]);

        // Putar 9 ronde
        for ($i = 1; $i <= 9; $i++) {
            $state = $this->substituteBytes($state);
            $state = $this->shiftRows($state);
            $state = $this->mixColumns($state);
            $state = $this->xorBytes($state, $roundKeys[$i]);
        }

        // Substitusi byte dan shift baris pada ronde terakhir
        $state = $this->substituteBytes($state);
        $state = $this->shiftRows($state);

        // Add Round Key (Final Round)
        $state = $this->xorBytes($state, $roundKeys[10]);

        // Menggabungkan blok byte ke dalam string hasil enkripsi
        $ciphertext = $this->combineBytes($state);

        return $ciphertext;
    }

    // Fungsi untuk melakukan dekripsi ciphertext menggunakan AES-128 dalam mode CBC
    public function dekripAes($ciphertext)
    {
        $state = splitBytes($ciphertext);

        // Inisialisasi kunci putar
        $roundKeys = generateRoundKeys($this->key);

        // Add Round Key (Final Round)
        $state = xorBytes($state, $roundKeys[10]);

        // Substitusi byte dan shift baris pada ronde terakhir
        $state = inverseShiftRows($state);
        $state = substituteBytes($state);

        // Putar 9 ronde terbalik
        for ($i = 9; $i >= 1; $i--) {
            $state = xorBytes($state, $roundKeys[$i]);
            $state = inverseMixColumns($state);
            $state = inverseShiftRows($state);
            $state = substituteBytes($state);
        }

        // Add Round Key (Initial Round)
        $state = xorBytes($state, $roundKeys[0]);

        // XOR dengan IV (Initialization Vector)
        $state = xorBytes($state, $this->iv);

        // Menggabungkan blok byte ke dalam string hasil dekripsi
        $plaintext = combineBytes($state);

        return $plaintext;
    }
}
