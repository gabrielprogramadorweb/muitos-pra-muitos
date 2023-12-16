<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{   
    // Usado para renomear o nome da tabela no banco de dados
    protected $table = 'desenvolvedores';

    // Define um relacionamento muitos para muitos com o modelo Projeto
    function projetos(){
        // Retorna uma instância de BelongsToMany
        // - O primeiro parâmetro é a classe do modelo relacionado (App\Projeto)
        // - O segundo parâmetro é o nome da tabela intermediária que armazena as alocações (alocacoes)
        return $this->belongsToMany("App\Projeto", "alocacoes")->withPivot('horas_semanais');
    }
}
