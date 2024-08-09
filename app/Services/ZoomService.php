<?php

namespace App\Services;

use App\Http\Controllers\ZoomController;
use GuzzleHttp\Client;

class ZoomService extends ZoomController
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function createMeeting($topic, $start_time, $duration)
    {
        $response = $this->client->post('https://api.zoom.us/v2/users/me/meetings', [
            'json' => [
                'topic' => $topic,
                'type' => 2, // Scheduled meeting
                'start_time' => $start_time,
                'duration' => $duration,
                'timezone' => 'Asia/Tokyo',
            ],
            'headers' => $this->headers(),
        ]);

        return json_decode($response->getBody(), true);
    }
}
