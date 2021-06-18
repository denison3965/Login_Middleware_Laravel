<?php

use App\Http\Controllers\ProdutoControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', [ProdutoControlador::class, 'index']);

Route::get('/negado', function() {
    return "Acesso negado";
})->name('negado');

Route::get('/negadologin', function () {
    return "Olá, para acessar essa página, voce precisa ser adiministrador, e sua conta não é";
})->name('negadologin');

Route::post('/login', function (Request $request) {


    $login_ok = false;
    $admin = false;

    switch($request->input('user'))
    {
        case 'joao':
            $login_ok = $request->input('password') === "senhajoao";
            $admin = true;
            break;
        
        case 'marcos':
            $login_ok = $request->input('password') === 'senhamarcos';
            break;

        case 'default':
            $login_ok = false;
    }

    if($login_ok)
    {
        $login = ['user' => $request->input('user'), 'admin' => $admin];
        $request->session()->put('login', $login);
        return response('Login ok', 200);
    }
    else
    {
        $request->session()->flush();
        return response('Erro no login', 404);
    }
});

Route::get('logout', function(Request $request) {
    $request->session()->flush();
    return response("Usuário saiu", 200);
});