<?php

class ApiClient
{
    public static function getJson(string $url, array $query = []): array
    {
        if (!empty($query)) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($query);
        }

        $response = @file_get_contents($url);

        if ($response === false) {
            return ['error' => 'HTTP_REQUEST_FAILED'];
        }

        $decoded = json_decode($response, true);

        if (!is_array($decoded)) {
            return ['error' => 'INVALID_JSON'];
        }

        return $decoded;
    }
}
