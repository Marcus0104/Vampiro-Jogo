<?php
require_once("Magico.php");

class Clerigo extends Magico
{
    private array $buffs = ['Força', 'Velocidade', 'Defesa'];
    public function darBuff() {
       $buff = rand(1, 3);

       if ($buff == 1) {
            print("O clerigo deu a bença da " . $this->buffs[0] . " para os inimigos.\n");
       }
       elseif($buff == 2){
        print("O clerigo deu a bença da " . $this->buffs[1] . " para os inimigos.\n");  
       }
       else {
        print("O clerigo deu a bença da " . $this->buffs[2] . " para os inimigos.\n");
       }
    }
    public function curar(Templario $vida) {
        if ($vida->getVida() < 100) {
            $vida->setVida($vida->getVida() + 20);
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
}
