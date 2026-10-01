<?php
require_once("Magico.php");

class Demonio extends Magico
{
    public function chamasInfernais(Personagem $alvo): void
    {
        $dano = $this->ataque + $this->bonusAtaque + $this->arma->getDano();
        $alvo->tomarDano($dano);
        $this->ganharVida(intdiv($dano, 2));
        print $this->nome . " solta CHAMAS INFERNAIS! " . $dano . " de dano (ignora defesa) e rouba vida!\n";
    }

    public function agir(Personagem $alvo, int $turno): void
    {
        if ($turno % 3 == 0) {
            $this->chamasInfernais($alvo);
        } else {
            $this->atacar($alvo);
        }
    }
}
