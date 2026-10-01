<?php
class Arma
{
    private string $nome;
    private int $dano;

    public function __construct(string $nome, int $dano)
    {
        $this->nome = $nome;
        $this->dano = $dano;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDano(): int
    {
        return $this->dano;
    }

    public function setDano(int $dano): self
    {
        $this->dano = $dano;

        return $this;
    }
}
