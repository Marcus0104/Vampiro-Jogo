<?php
require_once("modelo/Vampiro.php");
require_once("modelo/Templario.php");
require_once("modelo/Clerigo.php");
require_once("modelo/MagoAtk.php");
require_once("modelo/Demonio.php");
require_once("modelo/Rei.php");

// MENU DE STATUS
function mostrarStatus(Vampiro $vampiro, Personagem $inimigo)
{
    print "\n----------------------------------------\n";
    print $inimigo->getNome() . " - Vida: " . $inimigo->getVida() . "/" . $inimigo->getVidaMax() . "\n";

    if ($vampiro->getFormaAtual() == 0) {
        $forma = "humana";
    } else {
        $forma = "besta";
    }

    print $vampiro->getNome() . " (" . $forma . ") - Vida: " . $vampiro->getVida() . "/" . $vampiro->getVidaMax();
    print " - Mana: " . $vampiro->getMana() . "/" . $vampiro->getManaMax() . "\n";

    if ($vampiro->isSede()) {
        print "Voce esta com SEDE! (+cura ao drenar aura)" . "\n";
    }

    print "----------------------------------------\n";
}
