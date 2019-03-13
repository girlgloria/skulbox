<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function init(array $data)
    {
        $client = new Client();

        try{
            $response = $client->request('POST','https://upesa.co.ke/lipa254/api/v1/transact',[
                'form_params' => $data
            ]);

            return json_decode($response->getBody()->getContents());
        }
        catch (BadResponseException $badResponseException){

            return ['error' => $badResponseException->getMessage()];
        }
    }
}
