<?php


class prueba
{
    protected $Fibonachi = [];

    public function __construct()
    {
        $this->Fibonachi = [0, 1];
    }

    protected function calcularNumerosFibonachi(int $cantidad)
    {
        $fibonacci = [0, 1];
        for ($i = 2; $i <= $cantidad - 1; $i++) {
            $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }
        $this->Fibonachi = $fibonacci;
    }

    public function verNumerosFibonachi(int $cantidad)
    {
        $this->calcularNumerosFibonachi($cantidad);
        echo '<pre>';
        for ($i = 0; $i <= $cantidad - 1; $i++) {
            echo $this->Fibonachi[$i] . '<br>';
        }
        echo '</pre>';
    }

    public function getCantidad()
    {
        return count($this->Fibonachi);
    }
}

$fibonachi = new prueba();

$fibonachi->verNumerosFibonachi(10);
echo $fibonachi->getCantidad();

