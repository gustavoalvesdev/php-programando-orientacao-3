<?php

use Livro\Database\Record;

class Cidade extends Record
{
    const TABLENAME = 'cidade';

    public function getEstado()
    {
        //return (new Estado($this->idEstado))->nome;
    }

}