<?php

use Illuminate\Support\Facades\Route;
use App\Desenvolvedor;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora crie algo incrível!
|
*/

// Define uma rota para acessar desenvolvedores com seus projetos
Route::get('/desenvolvedor_projeto', function () {
    
    // Obtém todos os desenvolvedores com relacionamento "projetos" pré-carregado
    $desenvolvedores = Desenvolvedor::with('projetos')->get();

    // Converte a coleção de desenvolvedores para JSON e retorna
    return $desenvolvedores->toJson();
});
