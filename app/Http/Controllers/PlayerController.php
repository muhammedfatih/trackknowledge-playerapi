<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;

class PlayerController extends Controller
{
    public function all()
    {
        $retval=[];
        foreach(Player::all() as $player){
            $client = new Client();

            $response = $client->request('GET', env('SERVICE_ADDRESS_CONTENT').'/nationalities/'.$player->nationality_id, ['headers' => ['Authorization'=>'Bearer '.env('SERVICE_AUTHKEY')]]);
            $nationality=json_decode(json_encode(json_decode($response->getBody())), true);

            $player['nationality']=$nationality;
            array_push($retval, $player);
        }
        return response()->json($retval);
    }

    public function get($id)
    {
        $player=Player::find($id);
        $client = new Client();
        $response = $client->request('GET', env('SERVICE_ADDRESS_CONTENT').'/nationalities/'.$player->nationality_id, ['headers' => ['Authorization'=>'Bearer '.env('SERVICE_AUTHKEY')]]);
        $nationality=json_decode(json_encode(json_decode($response->getBody())), true);
        $player["nationality"]=$nationality;
        return response()->json($player);
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
