<?php
require_once("Personagem.php");

class Rei extends Personagem
{
    private bool $furia = false;

    public function decretoReal(Personagem $alvo): void
    {
        $dano = $this->ataque + $this->bonusAtaque + $this->arma->getDano() + 4;
        $alvo->tomarDano($dano);
        print $this->nome . " profere o DECRETO REAL! " . $dano . " de dano (ignora defesa)!\n";
    }

    public function agir(Personagem $alvo, int $turno): void
    {
        if (!$this->furia && $this->vida < $this->vidaMax * 0.5) {
            $this->furia = true;
            $this->ataque += 4;
            print "\n" . $this->nome . " solta um rugido: a coroa racha e ele entra em FURIA!\n\n";
        }

        $intervalo = 3;
        if ($this->furia) {
            $intervalo = 2;
        }

        if ($turno % $intervalo == 0) {
            $this->decretoReal($alvo);
        } else {
            $this->atacar($alvo);
        }
    }

    public function isFuria(): bool
    {
        return $this->furia;
    }

    public function setFuria(bool $furia): self
    {
        $this->furia = $furia;

        return $this;
    }
}
