<?php
require_once("Personagem.php");

class Templario extends Personagem
{

    public function golpeSagrado(Personagem $alvo): void
    {
        $dano = $this->ataque + $this->bonusAtaque + $this->arma->getDano() + 3;
 
        if ($alvo instanceof Vampiro && $alvo->getFormaAtual() == 1) {
            $dano += 4;
        }
 
        $alvo->tomarDano($dano);
        print $this->nome . " usa GOLPE SAGRADO! " . $dano . " de dano (ignora defesa)!\n";
    }

    public function agir(Personagem $alvo, int $turno): void
    {
        if ($turno % 3 == 0) {
            $this->golpeSagrado($alvo);
        } else {
            $this->atacar($alvo);
        }
    }
}
