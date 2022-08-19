<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ApiTest extends TestCase
{

    //Se crea funcion para obtener token en las pruebas
    protected function authenticated(){

        $user  = User::where('email', 'pruebas@pruebas.com')->first();

        if(! Auth::attempt(['email'=> $user->email, 
                            'password'=>'password'])){
            return response()->json('message','Login failed');
        }

        $token = $user->createToken('prueba')->plainTextToken;

        return $token;

    }


    //Se crea test para el servicio Login
    public function testLogin(){

        $infoLogin = [
            'email'=> 'pruebas@pruebas.com',
            'password' => 'password'
        ];

        $this->json('POST','api/login', $infoLogin,['accept'=>'application/json'])
             ->assertStatus(200);

    }

    //Se crea test para el servicio Create
    public function testCreateProduct(){

        $token = $this->authenticated();

        $infoData = [
            'description'=> 'Elemento prueba',
            'category_id'=> '2',
            'value'      => '200'
        ];

        $response = $this->post('api/v1/products',
                                $infoData,
                                ['Accept'=>'application/json',
                                'authorization'=>'Bearer '.$token]);

        $response->assertStatus(200);

    }


    //Se crea test para el servicio PUT
    public function testProductPut(){

        $token = $this->authenticated();

        $infoData = [
            'description'=> 'Elemento prueba',
            'category_id'=> '2',
            'value'      => '200'
        ];

        $response = $this->put('api/v1/products/1',
                               $infoData,  
                              ['Accept'=>'application/json',
                              'authorization'=>'Bearer '.$token]);

        $response->assertStatus(200);
    }


    //Se crea test para el servicio Show
    public function testProductShow(){

        $token = $this->authenticated();

        $response = $this->get('api/v1/products/1',
                              ['Accept'=>'application/json',
                              'authorization'=>'Bearer '.$token]);

        $response->assertStatus(200);
    }


    //Se crea test para el servicio GET(obtiene todos los productos)
    public function testProductsGet(){

        $token = $this->authenticated();

        $response = $this->get('api/v1/products',
                              ['Accept'=>'application/json',
                              'authorization'=>'Bearer '.$token]);

        $response->assertStatus(200);
    }    


    //Se crea test para el servicio Delete
    public function testProductDelete(){

        $token = $this->authenticated();

        $response = $this->get('api/v1/products/1',
                              ['Accept'=>'application/json',
                              'authorization'=>'Bearer '.$token]);

        $response->assertStatus(200);
    }        
    
}
