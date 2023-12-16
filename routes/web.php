<?php

use Illuminate\Support\Facades\Route;
use App\Desenvolvedor;
use App\Projeto;

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
Route::get('/desenvolvedor_projetos', function () {
    // Carrega todos os desenvolvedores com seus projetos relacionados
    $desenvolvedores = Desenvolvedor::with("projetos")->get();

    // Itera sobre cada desenvolvedor
    foreach($desenvolvedores as $d) {
        // Exibe informações do desenvolvedor
        echo "Nome do desenvolvedor: " . $d->nome . "<br>";
        echo "Cargo: " . $d->cargo . "<br>";

        // Verifica se o desenvolvedor possui projetos
        if (count($d->projetos) > 0) {
            // Exibe a lista de projetos do desenvolvedor
            echo "Projetos: <br>";
            echo "<ul>";
            foreach($d->projetos as $p) {
                // Exibe informações de cada projeto relacionado ao desenvolvedor
                echo "<li> Nome do projeto: " . $p->nome . " | ";
                echo "Horas do projeto: " . $p->estimativa_horas . " | ";
                echo "Horas trabalhadas pelo desenvolvedor: " . $p->pivot->horas_semanais . "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
});

// Define uma rota para acessar projetos com seus desenvolvedores relacionados
Route::get('/projeto_desenvolvedores', function () {
    // Carrega todos os projetos com seus desenvolvedores relacionados
    $projetos = Projeto::with('desenvolvedores')->get();

    // Retorna os projetos em formato JSON
    return $projetos->toJson();
});
