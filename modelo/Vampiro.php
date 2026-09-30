<?php
require_once("Magico.php");

class Vampiro extends Magico
{
    private int $formaAtual = 0; // 0 = humana. 1 = besta
    private bool $sede = false;

    public function drenarAura(Personagem $alvo): bool
    {
        if ($this->mana < 20) {
            print "Mana insuficiente!\n";
            return false;
        }
        $this->mana -= 20;

        $dano = $this->poder * 2 - $alvo->getDefesa();
        if ($dano < 1) {
            $dano = 1;
        }
        $danoCausado = $alvo->receberDano($dano);

        if ($this->sede) {
            $cura = $danoCausado;
        } else {
            $cura = (int)($danoCausado / 2);
        }
        $this->vida += $cura;
        if ($this->vida > $this->vidaMax) {
            $this->vida = $this->vidaMax;
        }

        print $this->nome . " drena a aura de " . $alvo->getNome() . ": causa " . $danoCausado . " de dano e recupera " . $cura . " de vida.\n";
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
            $this->forca += 6;
            $this->defesa -= 2;

            print $this->nome . " vira uma besta! (+6 forca, -2 defesa)\n";

        } else {
            $this->formaAtual = 0;
            $this->forca = $this->forca - 6;
            $this->defesa = $this->defesa + 2;

            print $this->nome . " volta para a forma humana.\n";
        }
        return true;
    }

    public function novoTurno()
    {
        $this->defendendo = false;
        $this->sede = $this->vida < $this->vidaMax / 2;
    }

    public function subirNivel()
    {
        $this->vidaMax += 10;
        $this->forca += 2;
        $this->defesa += 1;
        $this->poder += 3;
        $this->manaMax += 5;
        $this->vida = $this->vidaMax;
        $this->mana = $this->manaMax;

        print $this->nome . " subiu de nivel e se recuperou por completo!\n";
    }

    public function getFormaAtual(): int
    {
        return $this->formaAtual;
    }

    public function setFormaAtual(int $formaAtual): self
    {
        $this->formaAtual = $formaAtual;

        return $this;
    }

    public function isSede(): bool
    {
        return $this->sede;
    }

    public function setSede(bool $sede): self
    {
        $this->sede = $sede;

        return $this;
    }
}
