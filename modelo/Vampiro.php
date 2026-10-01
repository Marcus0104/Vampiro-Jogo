<?php
require_once("Magico.php");

class Vampiro extends Magico
{
    private int $manaMax = 50;
    private int $formaAtual = 0;
    private int $nivel = 1;

    public function getMana(): int
    {
        return $this->mana;
    }
    public function getManaMax(): int
    {
        return $this->manaMax;
    }
    public function getFormaAtual(): int
    {
        return $this->formaAtual;
    }

    public function temSede(): bool
    {
        return $this->vida < $this->vidaMax * 0.3;
    }
    public function drenarAura(Personagem $alvo): bool
    {
        if ($this->mana < 20) {
            print "Mana insuficiente!\n";
            return false;
        }

        $this->mana -= 20;
        $dano = 12;
        $alvo->tomarDano($dano);

        $cura = intdiv($dano, 2);
        if ($this->temSede()) {
            $cura = $dano;
        }
        $this->ganharVida($cura);

        print $this->nome . " drena a aura de " . $alvo->getNome() . ": " . $dano . " de dano e +" . $cura . " de vida!\n";
        return true;
    }
    public function transformar(): bool
    {
        if ($this->formaAtual == 0) {
            if ($this->mana < 10) {
                print "Mana insuficiente!\n";
                return false;
            }
            $this->mana -= 10;
            $this->formaAtual = 1;
            $this->ataque += 5;
            $this->defesa -= 2;
            print $this->nome . " vira uma besta! (+ataque, -defesa)\n";
        } else {
            $this->formaAtual = 0;
            $this->ataque -= 5;
            $this->defesa += 2;
            print $this->nome . " volta ao normal.\n";
        }
        return true;
    }

    public function recuperarMana(): void
    {
        $this->mana = min($this->manaMax, $this->mana + 20);
        print $this->nome . " medita e recupera mana.\n";
    }

    public function subirNivel(): void
    {
        $this->nivel++;
        $this->vidaMax += 15;
        $this->ataque += 2;
        $this->defesa += 1;
        $this->manaMax += 10;
        $this->mana = $this->manaMax;
        $this->ganharVida(rand(25, (int)($this->vidaMax / 2)));
        print "\n*** " . $this->nome . " subiu para o nivel " . $this->nivel . "! ***\n";
    }
}
