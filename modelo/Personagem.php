<?php
require_once("Arma.php");
require_once("IPersonagem.php");

class Personagem implements IPersonagem
{
    protected string $nome;
    protected float $forca;
    protected float $defesa;
    protected Arma $arma;

    public function atacar(){

    }

    public function defender(){

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

    public function getForca(): float
    {
        return $this->forca;
    }

    public function setForca(float $forca): self
    {
        $this->forca = $forca;

        return $this;
    }

    public function getDefesa(): float
    {
        return $this->defesa;
    }

    public function setDefesa(float $defesa): self
    {
        $this->defesa = $defesa;

        return $this;
    }

    public function getArma(): Arma
    {
        return $this->arma;
    }

    public function setArma(Arma $arma): self
    {
        $this->arma = $arma;

        return $this;
    }
}
