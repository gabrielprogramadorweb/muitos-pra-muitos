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
    $projetos = Projeto::with("desenvolvedores")->get();
    foreach($projetos as $p) {
        echo "Nome do projeto: " . $p->nome . "<br>";
        echo "Estimativa de horas: " . $p->estimativa_horas . "<br>";
        if (count($p->desenvolvedores ) > 0) {
            echo "Desenvolvedores: <br>";
            echo "<ul>";
            foreach($p->desenvolvedores as $d) {
                echo "<li> Nome do desenvolvedor: " . $d->nome . " | ";
                echo "Cargo: " . $d->cargo . " | ";
                echo "Horas trabalhadas pelo desenvolvedor: " . $d->pivot->horas_semanais . "</li>";
            }
            echo "</ul>";
        }
        echo "<hr>";
    }
    //return $projetos->toJson();
});


Route::get('/alocar', function () {
    $proj = Projeto::find(4);
    if (isset($proj)) {
        // $proj->desenvolvedores()->attach(1, ['horas_semanais' => 50]);
        // $proj->desenvolvedores()->attach(2, ['horas_semanais' => 50]);
        // $proj->desenvolvedores()->attach(3, ['horas_semanais' => 50]);
        
        // ou

        $proj->desenvolvedores()->attach([
            1 => ['horas_semanais' => 40],
            2 => ['horas_semanais' => 50],
            3 => ['horas_semanais' => 60],
        ]);
        return "OK";
    }
    return "Projeto nao encontrado";
});


Route::get('/desalocar', function () {
    $proj = Projeto::find(4);
    if (isset($proj)) {
        $proj->desenvolvedores()->detach(1);
        $proj->desenvolvedores()->detach(2);
        $proj->desenvolvedores()->detach(3);
        return "OK";
    }
    return "Projeto nao encontrado";
});
