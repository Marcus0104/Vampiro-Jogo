<?php
require_once("Arma.php");
require_once("IPersonagem.php");

class Personagem implements IPersonagem
{
    protected string $nome;
    protected int $vida;
    protected int $vidaMax;
    protected int $ataque;
    protected int $defesa;
    protected Arma $arma;
    protected bool $defendendo = false;
    protected int $bonusAtaque = 0;
    protected int $bonusDefesa = 0;
    protected int $esquiva = 0;
    protected int $turnosBuff = 0;

    public function __construct(string $nome, int $vidaMax, int $ataque, int $defesa, Arma $arma)
    {
        $this->nome = $nome;
        $this->vidaMax = $vidaMax;
        $this->vida = $vidaMax;
        $this->ataque = $ataque;
        $this->defesa = $defesa;
        $this->arma = $arma;
    }

    public function novoTurno(): void
    {
        $this->defendendo = false;

        if ($this->turnosBuff > 0) {
            $this->turnosBuff--;
            if ($this->turnosBuff == 0) {
                $this->bonusAtaque = 0;
                $this->bonusDefesa = 0;
                $this->esquiva = 0;
                print "A bencao em " . $this->nome . " acabou.\n";
            }
        }
    }

    public function defender(): void
    {
        $this->defendendo = true;
        print $this->nome . " se protege (defesa dobrada).\n";
    }

    public function atacar(Personagem $alvo): void
    {
        if (rand(1, 100) <= $alvo->getEsquiva()) {
            print $alvo->getNome() . " desvia do ataque de " . $this->nome . "!\n";
            return;
        }

        $defesa = $alvo->getDefesa();
        if ($alvo->isDefendendo()) {
            $defesa = $defesa * 2;
        }

        $dano = $this->ataque + $this->bonusAtaque + $this->arma->getDano() - $defesa;
        if ($dano < 1) {
            $dano = 1;
        }

        $alvo->tomarDano($dano);
        print $this->nome . " ataca com " . $this->arma->getNome() . " e causa " . $dano . " de dano!\n";
    }

    public function tomarDano(int $dano): void
    {
        $this->vida = max(0, $this->vida - $dano);
    }

    public function ganharVida(int $quantidade): void
    {
        $this->vida = min($this->vidaMax, $this->vida + $quantidade);
    }

    public function receberBuff(string $tipo, int $turnos): void
    {
        $this->bonusAtaque = 0;
        $this->bonusDefesa = 0;
        $this->esquiva = 0;

        if ($tipo == 'Força') {
            $this->bonusAtaque = 4;
        } elseif ($tipo == 'Defesa') {
            $this->bonusDefesa = 2;
        } elseif ($tipo == 'Velocidade') {
            $this->esquiva = 40;
        }

        $this->turnosBuff = $turnos;
    }

    public function agir(Personagem $alvo, int $turno): void
    {
        $this->atacar($alvo);
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getVida(): int
    {
        return $this->vida;
    }
    public function getVidaMax(): int
    {
        return $this->vidaMax;
    }
    public function getDefesa(): int
    {
        return $this->defesa + $this->bonusDefesa;
    }
    public function isDefendendo(): bool
    {
        return $this->defendendo;
    }
    public function getEsquiva(): int
    {
        return $this->esquiva;
    }
    public function temBuff(): bool
    {
        return $this->turnosBuff > 0;
    }

    public function setVida(int $vida): void
    {
        $this->vida = max(0, min($this->vidaMax, $vida));
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function setVidaMax(int $vidaMax): self
    {
        $this->vidaMax = $vidaMax;

        return $this;
    }

    public function setAtaque(int $ataque): self
    {
        $this->ataque = $ataque;

        return $this;
    }

    public function setDefesa(int $defesa): self
    {
        $this->defesa = $defesa;

        return $this;
    }

    public function setArma(Arma $arma): self
    {
        $this->arma = $arma;

        return $this;
    }

    public function setDefendendo(bool $defendendo): self
    {
        $this->defendendo = $defendendo;

        return $this;
    }

    public function setBonusAtaque(int $bonusAtaque): self
    {
        $this->bonusAtaque = $bonusAtaque;

        return $this;
    }

    public function setBonusDefesa(int $bonusDefesa): self
    {
        $this->bonusDefesa = $bonusDefesa;

        return $this;
    }

    public function setEsquiva(int $esquiva): self
    {
        $this->esquiva = $esquiva;

        return $this;
    }

    public function setBuff(int $turnosBuff): self
    {
        $this->turnosBuff = $turnosBuff;

        return $this;
    }
}
