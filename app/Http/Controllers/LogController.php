<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
//        $user=Auth::user();
        $fetch = Log::orderBy('id', 'desc')->get();
        $logs = [];
        foreach ($fetch as $key => $log) {
            $logs[$key] = $log;
            $logs[$key]['shamsi_created_at'] = Verta::instance($log->created_at)->formatJalaliDatetime();
            $logs[$key]['data'] = json_decode($log['data']);
        }

        return $this->generateResponse($logs);
    }

    public function logsBySeen(int $seen, bool $getCount = null)
    {
        if ($getCount) {
            return Log::seen($seen)->orderBy('id', 'desc')->count();
        }
        return Log::seen($seen)->orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->input('data');


        $log = new Log();
        $log->status = $data['response']['status'];
        $log->data = $this->jsonEncoder($data);
        $log->save();
        return $this->generateResponse(true);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $log = Log::find($id);
        $log->seen = $request->input('seen');
        $log->save();

        return $this->generateResponse($log);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
