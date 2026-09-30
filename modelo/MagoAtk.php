<?php
require_once("Magico.php");

class MagoAtk extends Magico
{
    private array $elemento = ['Fogo', 'Agua'];
    private float $danoMagico;

    public function __construct() {

    }
    public function getElemento(): array
    {
        return $this->elemento;
    }

    public function setElemento(array $elemento): self
    {
        $this->elemento = $elemento;

        return $this;
    }

    public function getDanoMagico(): float
    {
        return $this->danoMagico;
    }

    public function setDanoMagico(float $danoMagico): self
    {
        $this->danoMagico = $danoMagico;

        return $this;
    }
}
