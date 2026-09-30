<?php
class Arma{
    private string $nome;
    private float $dano;
    

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDano(): float
    {
        return $this->dano;
    }

    public function setDano(float $dano): self
    {
        $this->dano = $dano;

        return $this;
    }
}