<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return response(PlayerResource::collection(Player::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlayerRequest $playerRequest
     * @return Response
     */
    public function store(PlayerRequest $playerRequest): Response
    {
        $player = Player::create($playerRequest->all());
        if (!$player) {
            return response([
                'errors' => [
                    'status' => 500,
                    'source' => ['pointer' => url()->current()],
                    'title' => 'Internal Server Error',
                    'detail' => 'Could not save player.',
                ]
            ], 500);
        }
        return response(new PlayerResource($player), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player): Response
    {
        return response(new PlayerResource($player));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlayerRequest $playerRequest
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $playerRequest, Player $player): Response
    {
        $player->update($playerRequest->all());
        return response(new PlayerResource($player));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player): Response
    {
        try {
            $player->delete();
        } catch (\Exception $exception) {
            return response($exception->getMessage(), $exception->getCode());
        }

        return response(true, 200);
    }
}
