<?php
require_once("Magico.php");

class Clerigo extends Magico
{
    private array $buffs = ['Força', 'Velocidade', 'Defesa'];
    private array $aliados = [];
    private int $curasRestantes = 2;

    public function darBuff(): void
    {
        $buff = $this->buffs[rand(0, count($this->buffs) - 1)];

        print("O clerigo deu a bença da " . $buff . " para os inimigos.\n");

        foreach ($this->aliados as $aliado) {
            if ($aliado->getVida() > 0 && !($aliado instanceof Vampiro)) {
                $aliado->receberBuff($buff, 3);
            }
        }
    }

    public function curar(Templario $templario): void
    {
        if ($templario->getVida() < $templario->getVidaMax()) {
            $templario->setVida($templario->getVida() + 20);
            $this->curasRestantes--;
            print("O clerigo curou o Templario em 20 de vida.\n");
        }
    }

    public function agir(Personagem $alvo, int $turno): void
    {
        $templario = null;
        foreach ($this->aliados as $aliado) {
            if ($aliado instanceof Templario && $aliado->getVida() > 0) {
                $templario = $aliado;
            }
        }

        if ($turno % 3 == 0) {
            $this->darBuff();
        } elseif ($templario != null && $this->curasRestantes > 0 && $templario->getVida() < $templario->getVidaMax() * 0.5) {
            $this->curar($templario);
        } else {
            $this->atacar($alvo);
        }
    }


    public function getBuffs(): array
    {
        return $this->buffs;
    }

    public function setBuffs(array $buffs): self
    {
        $this->buffs = $buffs;

        return $this;
    }

    public function getAliados(): array
    {
        return $this->aliados;
    }

    public function setAliados(array $aliados): self
    {
        $this->aliados = $aliados;

        return $this;
    }
    public function getCurasRestantes(): int
    {
        return $this->curasRestantes;
    }

    public function setCurasRestantes(int $curasRestantes): self
    {
        $this->curasRestantes = $curasRestantes;

        return $this;
    }
}
