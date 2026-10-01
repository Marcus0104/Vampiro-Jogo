<?php
require_once("Personagem.php");

class Magico extends Personagem
{
    protected int $mana = 50;

    public function getMana(): int
    {
        return $this->mana;
    }

    public function setMana(int $mana): self
    {
        $this->mana = $mana;

        return $this;
    }
}
