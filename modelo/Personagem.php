<?php
require_once("Arma.php");
require_once("IPersonagem.php");

class Personagem implements IPersonagem
{
    protected string $nome;
    protected int $forca;
    protected int $defesa;
    protected Arma $arma;
    protected int $vida;
    protected int $vidaMax;
    protected bool $defendendo = false;

    public function atacar(Personagem $alvo)
    {
        $dano = $this->forca + $this->arma->getDano() - $alvo->getDefesa();
        if ($dano < 1) {
            $dano = 1;
        }
        $danoCausado = $alvo->receberDano($dano);
        print $this->nome . " ataca com " . $this->arma->getNome() . " e causa " . $danoCausado . " de dano em " . $alvo->getNome() . ".\n";
    }

    public function defender()
    {
        $this->defendendo = true;
        print $this->nome . " se defende (recebe metade do dano).\n";
    }

    public function usarEspecial(Personagem $alvo)
    {
        $this->atacar($alvo);
    }

    public function receberDano(int $dano): int
    {
        if ($this->defendendo) {
            $dano = (int)($dano / 2);
        }
        if ($dano < 1) {
            $dano = 1;
        }
        $this->vida -= $dano;
        if ($this->vida < 0) {
            $this->vida = 0;
        }
        return $dano;
    }

    public function novoTurno()
    {
        $this->defendendo = false;
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

    public function getForca(): int
    {
        return $this->forca;
    }

    public function setForca(int $forca): self
    {
        $this->forca = $forca;

        return $this;
    }

    public function getDefesa(): int
    {
        return $this->defesa;
    }

    public function setDefesa(int $defesa): self
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

    public function getVida(): int
    {
        return $this->vida;
    }

    public function getVidaMax(): int
    {
        return $this->vidaMax;
    }
}
