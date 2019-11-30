<?php

namespace App\Http\Controllers;
use App\Advancer;
use App\Department;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


class GuzzleController extends Controller
{
    public function index()
    {
        $client = new Client();
      //  $request = $client->get('http://localhost/advance_lara/public/api/regis1');
        // $response = $request->getBody();
       // $get_data= $request->getBody();

      //  return view("guzzleData", ['all_data' => json_decode($get_data)]);
        $promise = $client->getAsync('http://localhost/advance_lara/public/api/regis1')->then(
            function ($response) {
                return $response->getBody();
               
            },
            function ($exception) {
                return $exception->getMessage();
            }
        );
        $response = $promise->wait();
        //echo $response;
        $department = Department::all();
        return view("guzzleData", ['all_data' => json_decode($response)], compact("department"));
    }
    public function create(){
        return view("guzzleAdd");
    }

    public function store(Request $request){
        $client = new Client();
     //   $request = $client->post('http://localhost/advance_lara/public/api/api_add', [
           // 'json' => $request->all()
          //  ]);


 

        $promise = $client->postAsync('http://localhost/advance_lara/public/api/api_add', [
            'json' => $request->all()
        ])->then(
            function ($response) {
                return $response->getBody();
            },
            function ($exception) {
               // return $exception->getMessage();
            }
        );
      
        $response = $promise->wait();
        // return view("guzzleAdd", ['add' => json_decode($response)]);
        session()->flash('success', json_decode($response));
            return redirect()->route('add_create');
      // dd(json_decode($response));
    }

    public function edit(Advancer $id)
    {
        return view("guzzle_edit_view", compact("id"));
    }

    public function update(Request $request,$id)
    {
       
        $client = new Client();
       
       // dd(json_decode($id));
        $promise = $client->putAsync('http://localhost/advance_lara/public/api/edit_data/'.$id, [
            'json' => $request->all()
        ])->then(
            function ($response) {
                return $response->getBody();
            },
            function ($exception) {
                // return $exception->getMessage();
            }
        );
      //  dd($promise);
        $response = $promise->wait();
       // dd(json_decode($response));
        // return view("guzzleAdd", ['add' => json_decode($response)]);
        session()->flash('success', json_decode($response));
        return redirect()->route('gData');
       
    }
    public function delete($id)
    {
       
        $client = new Client();
       
       // dd(json_decode($id));
        $promise = $client->deleteAsync('http://localhost/advance_lara/public/api/delete_data/'.$id)->then(
            function ($response) {
                return $response->getBody();
            },
            function ($exception) {
                // return $exception->getMessage();
            }
        );
      //  dd($promise);
        $response = $promise->wait();
       // dd(json_decode($response));
        // return view("guzzleAdd", ['add' => json_decode($response)]);
        session()->flash('success', json_decode($response));
        return redirect()->route('gData');
       
    }
}
