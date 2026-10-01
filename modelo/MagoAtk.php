<?php
require_once("Magico.php");

class MagoAtk extends Magico
{
    public function bolaDeFogo(Personagem $alvo): void
    {
        $this->mana -= 20;
 
        $dano = $this->ataque + $this->bonusAtaque + $this->arma->getDano() + 5;
        $alvo->tomarDano($dano);
        print $this->nome . " conjura BOLA DE FOGO! " . $dano . " de dano (ignora defesa)!\n";
    }
 
    public function agir(Personagem $alvo, int $turno): void
    {
        if ($turno % 2 == 0 && $this->mana >= 20) {
            $this->bolaDeFogo($alvo);
        } else {
            $this->atacar($alvo);
            $this->mana = min(50, $this->mana + 5);
        }
    }
}
