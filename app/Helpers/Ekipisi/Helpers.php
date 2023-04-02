<?php
namespace App\Helpers\Ekipisi;
 
use Illuminate\Support\Facades\DB;
 
class Helpers {

    /*
        $bilgiler = array(
            "ad"            => "MUSTAFA",
            "soyad"         => "GENÇ",
            "dogumyili"     => "1985",
            "tckimlikno"    => "xxxxxxxxxxx"
        );
    */
    public static function TcDogrula($info) {
        $text = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
        <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
        <TCKimlikNo>'.$info["tckimlikno"].'</TCKimlikNo>
        <Ad>'.$info["ad"].'</Ad>
        <Soyad>'.$info["soyad"].'</Soyad>
        <DogumYili>'.$info["dogumyili"].'</DogumYili>
        </TCKimlikNoDogrula>
        </soap:Body>
        </soap:Envelope>';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,               "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,    true );
        curl_setopt($ch, CURLOPT_POST,              true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,    false);
        curl_setopt($ch, CURLOPT_HEADER,            false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,        $text);
        curl_setopt($ch, CURLOPT_HTTPHEADER,        array(
            'POST /Service/KPSPublic.asmx HTTP/1.1',
            'Host: tckimlik.nvi.gov.tr',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
            'Content-Length: '.strlen($text)
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return strip_tags($response);
    }

    public static function Guid()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public static function RandomPassword($length = 8)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                 '0123456789';
        $str = '';
        $max = strlen($chars) - 1;

        for ($i=0; $i < $length; $i++)
        $str .= $chars[random_int(0, $max)];

        return $str;
    }

    public static function RandomToken($size, $withSpecialCharacters = false) {
        $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters .= "abcdefghijklmnopqrstuvwxyz";
        $characters .= "0123456789";

        if ($withSpecialCharacters) {
            $characters .= '!@#$%^&*()';
        }

        $token = '';
        $max = strlen($characters);
        for ($i = 0; $i < $size; $i++) {
            $token .= $characters[random_int(0, $max - 1)];
        }
        return $token;
    }

    public static function bytes($bytes, $force_unit = NULL, $format = NULL, $si = TRUE, $disk = FALSE)
    {
        if ($bytes == "unlimited") {
            return "Sınırsız";
        }
        if ($disk) {
            $bytes = $bytes * 1000000;
        }
        $format = ($format === NULL) ? '%01.2f %s' : (string)$format;
        if ($si == FALSE OR strpos($force_unit, 'i') !== FALSE) {
            $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
            $mod = 1024;
        } else {
            $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
            $mod = 1000;
        }
        if (($power = array_search((string)$force_unit, $units)) === FALSE) {
            $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
        }
        return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
    }

    public static function FormatPhone($phone) {
        $phone = str_replace("+", "", $phone);
        $phone = str_replace("(", "", $phone);
        $phone = str_replace(")", "", $phone);
        $phone = str_replace(")", "", $phone);
        $phone = str_replace(" ", "-", $phone);
        return "9" . $phone;
    }

}