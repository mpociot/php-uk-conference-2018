<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatController extends Controller
{
	
	public function handle(Request $request, Client $client)
	{
		$response = $client->post('http://'.$request->getHost().'/botman', [
			'form_params' => [
				'driver' => 'web',
				'userId' => 9999999,
				'message' => $request->get('message')
			]
		]);

		return json_decode($response->getBody()->getContents(), true);
	}

	public function say()
	{
		$botman = app('botman');
		$botman->say('Hello!', 9999999);
	}

}