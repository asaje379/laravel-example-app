<?php

use App\Models\Demande;
use App\Models\Fourniture;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/fournitures', function () {

    // Creer une fourniture

    // $fourniture = new Fourniture();
    // $fourniture->demandeur = 'Toto 2';
    // $fourniture->service = 'Test service 2';
    // $fourniture->save();

    $fournitures = Fourniture::all();
    return $fournitures;
});

Route::get('/fournitures/{id}', function (string $id) {

    $fourniture = Fourniture::find($id);
    $fourniture->demandes;

    return $fourniture;
});


Route::get('/users', function () {

    // Creer un user
    $user = User::create([
        'name' => 'Jane DOE',
        'email' => 'janedoe@yopmail.com',
        'password' => 'testtest',
    ]);
    $user->save();

    $users = User::all();
    return $users;
});

Route::get('/demandes', function () {

    $demande = new Demande();
    $demande->des = 'Test des';
    $demande->qtd = 4;
    $demande->qts = 2;
    $demande->obs = 'RAS';

    $demande->fourniture_id = 2;
    $demande->user_id = 2;

    $demande->save();

    $demandes = Demande::all();
    return $demandes;
});

Route::get('/demandes/{id}', function (string $id) {
    $demande = Demande::find($id);
    $demande->fourniture;
    $demande->user;
    return $demande;
});


Route::post('/fourniture/store', function (Request $request) {
    $userId = $request->input('user_id');

    // Informations de la fourniture
    // Creation de la Fourniture
    $fourniture = new Fourniture();
    $fourniture->demandeur = $request->input('demandeur');
    $fourniture->service = $request->input('service');
    $fourniture->save();

    $demandes = $request->input('demandes');

    foreach ($demandes as $key => $value) {
        $demande = new Demande();
        $demande->des = $value['des'];
        $demande->qtd = $value['qtd'];
        $demande->qts = $value['qts'];
        $demande->obs = $value['obs'];

        $demande->user_id = $userId;
        $demande->fourniture_id = $fourniture->id;

        $demande->save();
    }

});
