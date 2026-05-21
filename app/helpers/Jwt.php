<?php

class Jwt
{
    private static $secret = 'SECRET_KEY_KAMU';

    public static function generate($payload)
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        $payload['iat'] = time();
        $payload['exp'] = time() + (60 * 60 * 24);

        $payload = json_encode($payload);

        $base64Header = self::base64UrlEncode($header);
        $base64Payload = self::base64UrlEncode($payload);

        $signature = hash_hmac(
            'sha256',
            $base64Header . "." . $base64Payload,
            self::$secret,
            true
        );

        $base64Signature = self::base64UrlEncode($signature);

        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }

    public static function verify($jwt)
    {
        $tokenParts = explode('.', $jwt);

        if (count($tokenParts) !== 3) {
            return false;
        }

        [$header, $payload, $signature] = $tokenParts;

        $validSignature = self::base64UrlEncode(
            hash_hmac(
                'sha256',
                $header . "." . $payload,
                self::$secret,
                true
            )
        );

        if (!hash_equals($validSignature, $signature)) {
            return false;
        }

        $payloadData = json_decode(
            self::base64UrlDecode($payload),
            true
        );

        if ($payloadData['exp'] < time()) {
            return false;
        }

        return $payloadData;
    }

    private static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}