<?php
require_once("Magico.php");

class MagoAtk extends Magico
{
    private string $elemento;
    private float $danoMagico;

    public function getElemento(): string
    {
        return $this->elemento;
    }

    public function setElemento(string $elemento): self
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
