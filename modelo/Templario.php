<?php
require_once("Personagem.php");

class Templario extends Personagem
{
    public function amedrontar(Personagem $alvo)
    {
        $alvo->setForca($alvo->getForca() - 2);
        print $this->nome . " amedronta " . $alvo->getNome() . "! (-2 de forca)\n";
    }

    public function posturaDefensiva()
    {
        $this->defesa = $this->defesa + 3;
        print $this->nome . " assume postura defensiva! (+3 de defesa)\n";
    }

    public function usarEspecial(Personagem $alvo)
    {
        if ($this->vida < $this->vidaMax / 2) {
            $this->posturaDefensiva();
        } else {
            $this->amedrontar($alvo);
        }
    }
}
