<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Auth;

class PlayerController extends Controller
{
    public function all()
    {
        return response()->json(Player::all());
    }

    public function get($id)
    {
        return response()->json(Player::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
        ]);

        $player = Player::create($request->all());

        return response()->json($player, 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
        ]);

        $player = Player::findOrFail($id);
        $player->update($request->all());

        return response()->json($player, 200);
    }

    public function delete($id)
    {
        Player::findOrFail($id)->delete();
        return response('', 200);
    }
}
