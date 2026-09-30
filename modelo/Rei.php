<?php
require_once("Personagem.php");

class Rei extends Personagem
{
    private bool $autoridade = true;

    public function invocarTropas(Personagem $alvo)
    {
        $dano = $alvo->receberDano(15);
        print "O Rei invoca as tropas reais! Flechas causam " . $dano . " de dano em " . $alvo->getNome() . "!\n";
    }

    public function usarEspecial(Personagem $alvo)
    {
        $this->invocarTropas($alvo);
    }

    public function receberDano(int $dano): int
    {
        if ($this->autoridade) {
            $dano = (int)($dano * 0.75);
        }
        $danoRecebido = parent::receberDano($dano); //Chama o metodo da classe pai

        if ($this->autoridade and $this->vida < $this->vidaMax / 2) {
            $this->autoridade = false;
            $this->forca += 5;
            print "A coroa do Rei racha! Ele perde a autoridade e entra em furia! (+5 de forca)\n";
        }
        return $danoRecebido;
    }

    public function isAutoridade(): bool
    {
        return $this->autoridade;
    }

    public function setAutoridade(bool $autoridade): self
    {
        $this->autoridade = $autoridade;

        return $this;
    }
}
