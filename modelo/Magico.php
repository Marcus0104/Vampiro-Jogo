<?php
require_once("Personagem.php");

class Magico extends Personagem
{
    protected float $mana;
    protected float $poder;
    public function recuperarMana() {}

    public function getMana(): float
    {
        return $this->mana;
    }

    public function setMana(float $mana): self
    {
        $this->mana = $mana;

        return $this;
    }

    public function getPoder(): float
    {
        return $this->poder;
    }

    public function setPoder(float $poder): self
    {
        $this->poder = $poder;

        return $this;
    }
}
