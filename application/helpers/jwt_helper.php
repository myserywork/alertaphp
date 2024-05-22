<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('gerar_jwt')) {
    function gerar_jwt($payload)
    {
        $CI = &get_instance();
        $CI->load->config('config');

        $key = $CI->config->item('encryption_key');
        $expiration = 60 * 60 * 24; // 1 dia em segundos

        $header = base64UrlEncode('{"alg":"HS256","typ":"JWT"}');
        $payload = base64UrlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = base64UrlEncode($signature);

        $jwt = "$header.$payload.$signature";

        return $jwt;
    }
}

if (!function_exists('processar_jwt')) {
    function processar_jwt($jwt)
    {
        $CI = &get_instance();
        $CI->load->config('config');

        $key = $CI->config->item('encryption_key');
        $parts = explode('.', $jwt);

        if (count($parts) === 3) {
            $header = $parts[0];
            $payload = $parts[1];
            $signature = $parts[2];

            $validSignature = hash_hmac('sha256', "$header.$payload", $key, true);
            $validSignature = base64UrlEncode($validSignature);

            if ($validSignature === $signature) {
                $decodedPayload = base64UrlDecode($payload);
                $payloadData = json_decode($decodedPayload);

                return $payloadData;
            }
        }

        // Token inválido ou expirado
        return null;
    }
}

if (!function_exists('base64UrlEncode')) {
    function base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        $base64Url = strtr($base64, '+/', '-_');
        $base64Url = rtrim($base64Url, '=');

        return $base64Url;
    }
}

if (!function_exists('base64UrlDecode')) {
    function base64UrlDecode($data)
    {
        $base64Url = strtr($data, '-_', '+/');
        $base64 = str_pad($base64Url, strlen($base64Url) % 4, '=', STR_PAD_RIGHT);

        return base64_decode($base64);
    }
}