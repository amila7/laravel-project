<?php

namespace App\Http\Controllers;

use App\Services\ZoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    protected $zoomService;

    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|max:255',
            'start_time' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'duration' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $meeting = $this->zoomService->createMeeting(
            $request->input('topic'),
            $request->input('start_time'),
            $request->input('duration')
        );

        return response()->json($meeting);
    }


    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string|max:255',
            'start_time' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'duration' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $meeting = $this->zoomService->createMeeting(
            $request->input('topic'),
            $request->input('start_time'),
            $request->input('duration')
        );

        return response()->json($meeting);
    }
}
