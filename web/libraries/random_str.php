<?php

class RandomSTRGenerator{
    // Constantes de generacion
    const DEFAULT_LENGTH = 100;
    const DEFAULT_KEYSPACE = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Atributos
    public $length;
    public $keyspace;

    public function __construct($length = RandomSTRGenerator::DEFAULT_LENGTH, $keyspace = RandomSTRGenerator::DEFAULT_KEYSPACE){
        $this->length = $length;
        $this->keyspace = $keyspace;
    }

    public function generate(){
        if ($this->length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($this->keyspace, '8bit') - 1;
        for ($i = 0; $i < $this->length; ++$i) {
            $pieces []= $this->keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}

?>
