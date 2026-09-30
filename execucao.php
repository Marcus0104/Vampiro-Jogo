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

// BATALHA
function batalha(Vampiro $vampiro, Personagem $inimigo): bool
{
    $turno = 0;

    while (true) {
        $turno++;
        $vampiro->novoTurno();
        mostrarStatus($vampiro, $inimigo);

        print "1. Atacar\n";
        print "2. Defender\n";
        print "3. Drenar aura (20 mana)\n";
        print "4. Transformar / voltar ao normal (10 mana para virar besta)\n";
        print "5. Meditar (+20 mana)\n";
        print "Escolha: ";

        $option = readline();

        switch ($option) {
            case 1:
                $vampiro->atacar($inimigo);
                break;
            case 2:
                $vampiro->defender();
                break;
            case 3:
                $vampiro->drenarAura($inimigo);
                break;
            case 4:
                $vampiro->transformar();
                break;
            case 5:
                $vampiro->recuperarMana();
                break;

            default:
                print "Opcao invalida!\n";
                break;
        }

        if ($inimigo->getVida() <= 0) {
            break;
        }

        if ($turno % 3 == 0) {
            $inimigo->usarEspecial($vampiro);
        } else {
            $inimigo->atacar($vampiro);
        }

        if ($vampiro->getVida() <= 0) {
            break;
        }
    }
    return $vampiro->getVida() > 0;
}


print "=== VAMPIRO: A QUEDA DO REI ===\n";
print "O Rei exterminou seu cla. Voce e o ultimo vampiro.\n";
print "Derrote todos os guardas e acabe com o Rei!\n\n";

print "Nome do seu vampiro: ";
$nome = readline();
if ($nome == "") {
    $nome = "Alucard";
}

$adaga = new Arma("Adaga de Sangue", 5, "não sei");
$vampiro = new Vampiro($nome, 100, 10, 3, $adaga);

$inimigos = [
    new Templario("Templario", 50, 8, 4, new Arma("Espada Sagrada", 4, "não sei")),
    // MARCUS coloca os inimigos que você criou aqui <-------
];

$venceu = true;

foreach ($inimigos as $inimigo) {
    print "\n>>> " . $inimigo->getNome() . " aparece! <<<\n";

    $venceu = batalha($vampiro, $inimigo);

    if ($venceu == false) {
        break;
    }

    print "\n" . $inimigo->getNome() . " foi derrotado!\n";

    if ($inimigo->getNome() != "O Rei") {
        $vampiro->subirNivel();
    }
}

if ($venceu) {
    print "\nVITORIA! O Rei caiu e as sombras agora pertencem a " . $vampiro->getNome() . "!\n";
} else {
    print "\nDERROTA... " . $vampiro->getNome() . " foi derrotado e o cla se apaga para sempre.\n";
}
