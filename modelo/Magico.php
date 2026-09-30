<?php
require_once("Personagem.php");

class Magico extends Personagem
{
    protected int $manaMax;
    protected float $mana;
    protected string $poder;

    public function recuperarMana() {
        if ($this->mana == 100) {
            print("Sua mana já esta cheia");
        }
        else{
            $this->mana = 100;
            print("Sua mana foi recuperada");
        }
    }
  
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
