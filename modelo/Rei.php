<?php
require_once("Personagem.php");

class Rei extends Personagem
{
    private bool $autoridade;
    public function invocarTropas() {}

    public function getAutoridade()
    {
        return $this->autoridade;
    }

    public function isAutoridade(): bool
    {
        return $this->autoridade;
    }

    public function setAutoridade(bool $autoridade): self
    {
        $this->autoridade = $autoridade;

        return $this;
    }
}
