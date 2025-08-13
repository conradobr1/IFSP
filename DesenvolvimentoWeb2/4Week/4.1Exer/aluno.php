<?php

class Aluno {
    public $nome;
    public $nascimento;
    public $curso;
    public $matricula;

    public function __construct($nome, $dataNascimento, $curso, $matricula) {
        $this->nome = $nome;
        $this->nascimento = $dataNascimento;
        $this->curso = $curso;
        $this->matricula = $matricula;
    }
    
    public function idade() {
        $dataNascimento = new DateTime($this->nascimento);
        $dataAtual = new DateTime();
        $diferenca = $dataAtual->diff($dataNascimento);
        return $diferenca->y;
    }
}

?>

