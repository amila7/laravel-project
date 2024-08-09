<?php

namespace App\Http\Controllers;

class ZoomController extends Controller
{

      /**
     * Headers
     *
     * @return array
     */
    protected function headers()
    {
        return [
            'Authorization' => 'Bearer '.$this->generateOAuth(),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    /**
     * Generate J W T
     *
     * @return string
     */

    // zoom oauth section 'access token not available', 'access token available', 'access token expired' start
    protected function generateOAuth()
{
    $apiEndpoint = 'https://zoom.us/oauth/token';
    $zoom_client_id = env('ZOOM_CLIENT_ID');
    $zoom_aaccount_id = env('ZOOM_ACCOUNT_ID');
    $zoom_client_secret = env('ZOOM_CLIENT_SECRET');
    $params = [
        'grant_type' => 'account_credentials',
        'account_id' => $zoom_client_id,
    ];

    $headers = [
        'Authorization: Basic ' . base64_encode($zoom_aaccount_id . ':' . $zoom_client_secret),
        'Content-Type: application/x-www-form-urlencoded'
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return 'Error: ' . curl_error($ch);
    }

    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
        return $responseData['access_token'];
    } else {
        return 'Error: Access token not found in the response.';
    }
}


}

