<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return response(TeamResource::collection(Team::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamRequest $teamRequest
     * @return Response
     */
    public function store(TeamRequest $teamRequest): Response
    {
        $team = Team::create($teamRequest->all());
        if (!$team) {
            return response(
                ['errors' => [
                    'status' => 500,
                    'source' => ['pointer' => url()->current()],
                    'title' => 'Internal Server Error',
                    'detail' => 'Could not save team.',
                ]
            ], 500);
        }
        return response(new TeamResource($team), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team): Response
    {
        return response(new TeamResource($team));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team): Response
    {
        $team->update($request->all());
        return response(new TeamResource($team));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Team $team): Response
    {
        try {
            $team->delete();
        } catch (\Exception $exception) {
             return response($exception->getMessage(), $exception->getCode());
        }

        return response(true, 200);
    }
}
