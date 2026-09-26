<?php
require_once("Magico.php");

class Vampiro extends Magico
{
    private int $formaAtual;
    private bool $sede;

    public function drenarAura() {}

    public function getFormaAtual(): int
    {
        return $this->formaAtual;
    }

    public function setFormaAtual(int $formaAtual): self
    {
        $this->formaAtual = $formaAtual;

        return $this;
    }

    public function isSede(): bool
    {
        return $this->sede;
    }

    public function setSede(bool $sede): self
    {
        $this->sede = $sede;

        return $this;
    }
}
