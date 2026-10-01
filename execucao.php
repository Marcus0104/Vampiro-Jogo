<?php

require_once("modelo/Vampiro.php");
require_once("modelo/Templario.php");
require_once("modelo/Clerigo.php");
require_once("modelo/MagoAtk.php");
require_once("modelo/Demonio.php");
require_once("modelo/Rei.php");

$antes = [
    "PORTAO DE FERRO: um templario e um clerigo bloqueiam a entrada do castelo.",
    "TORRE DOS ARCANOS: um mago gira uma esfera de fogo e te espera.",
    "CRIPTA DO PACTO: um demonio acorrentado guarda o segredo do Rei.",
    "SALAO DO TRONO: o Rei espera sentado. \"Faltava um do seu cla. Entao era voce.\"",
];

$depois = [
    "Os guardas caem e os portoes se abrem.",
    "O mago cai e a esfera de fogo se apaga.",
    "O demonio vira fumaca e o pacto se quebra.",
    "O Rei vira po diante dos seus olhos.",
];

function introducao(): void
{
    print "=== VAMPIRO: A QUEDA DO REI ===\n\n";
    print "O Rei exterminou seu cla. Voce e o ultimo vampiro.\n";
    print "Derrote todos os guardas e acabe com o Rei!\n\n";
}

function finalVitoria(string $nome): void
{
    print "\nVITORIA! O Rei caiu e as sombras agora pertencem a " . $nome . "!\n";
}

function finalDerrota(string $nome): void
{
    print "\nDERROTA... " . $nome . " foi derrotado e o cla se apaga para sempre.\n";
}

function vivos(array $inimigos): array
{
    $lista = [];
    foreach ($inimigos as $inimigo) {
        if ($inimigo->getVida() > 0) {
            $lista[] = $inimigo;
        }
    }
    return $lista;
}
function escolherAlvo(array $inimigos): ?Personagem
{
    $lista = vivos($inimigos);

    if (count($lista) == 1) {
        return $lista[0];
    }

    print "Escolha o alvo:\n";
    foreach ($lista as $i => $inimigo) {
        print ($i + 1) . ". " . $inimigo->getNome() . " (Vida: " . $inimigo->getVida() . "/" . $inimigo->getVidaMax() . ")\n";
    }
    print "Alvo: ";
    $escolha = (int) readline();

    if ($escolha < 1 || $escolha > count($lista)) {
        print "Alvo invalido!\n";
        return null;
    }
    return $lista[$escolha - 1];
}

function mostrarStatus(Vampiro $vampiro, array $inimigos): void
{
    print "\n----------------------------------------\n";

    foreach (vivos($inimigos) as $inimigo) {
        print $inimigo->getNome() . " - Vida: " . $inimigo->getVida() . "/" . $inimigo->getVidaMax();
        if ($inimigo->temBuff()) {
            print " [abencoado]";
        }
        print "\n";
    }

    if ($vampiro->getFormaAtual() == 0) {
        $forma = "humana";
    } else {
        $forma = "besta";
    }

    print $vampiro->getNome() . " (" . $forma . ") - Vida: " . $vampiro->getVida() . "/" . $vampiro->getVidaMax();
    print " - Mana: " . $vampiro->getMana() . "/" . $vampiro->getManaMax() . "\n";

    if ($vampiro->temSede()) {
        print "Voce esta com SEDE! (drenar aura cura o dobro)\n";
    }
    print "----------------------------------------\n";
}

function batalha(Vampiro $vampiro, array $inimigos): bool
{
    $turno = 0;

    while (true) {
        $turno++;
        $vampiro->novoTurno();
        foreach (vivos($inimigos) as $inimigo) {
            $inimigo->novoTurno();
        }

        $gastouTurno = false;
        while (!$gastouTurno) {
            mostrarStatus($vampiro, $inimigos);

            print "1. Atacar\n";
            print "2. Defender\n";
            print "3. Drenar aura (20 mana)\n";
            print "4. Transformar / voltar ao normal (10 mana para virar besta)\n";
            print "5. Meditar (+20 mana)\n";
            print "Escolha: ";
            $option = readline();
            print "\n";

            $gastouTurno = true;

            switch ($option) {
                case 1:
                    $alvo = escolherAlvo($inimigos);
                    if ($alvo == null) {
                        $gastouTurno = false;
                    } else {
                        $vampiro->atacar($alvo);
                    }
                    break;
                case 2:
                    $vampiro->defender();
                    break;
                case 3:
                    $alvo = escolherAlvo($inimigos);
                    if ($alvo == null) {
                        $gastouTurno = false;
                    } else {
                        $gastouTurno = $vampiro->drenarAura($alvo);
                    }
                    break;
                case 4:
                    $gastouTurno = $vampiro->transformar();
                    break;
                case 5:
                    $vampiro->recuperarMana();
                    break;
                default:
                    print "Opcao invalida!\n";
                    $gastouTurno = false;
                    break;
            }
        }

        if (count(vivos($inimigos)) == 0) {
            break;
        }

        foreach (vivos($inimigos) as $inimigo) {
            $inimigo->agir($vampiro, $turno);

            if ($vampiro->getVida() <= 0) {
                break;
            }
        }

        if ($vampiro->getVida() <= 0) {
            break;
        }
    }

    return $vampiro->getVida() > 0;
}

introducao();

print "Nome do seu vampiro: ";
$nome = readline();
if ($nome == "") {
    $nome = "Marnicko";
}

$adaga = new Arma("Adaga de Sangue", 5);
$vampiro = new Vampiro($nome, 100, 10, 3, $adaga);

$templario = new Templario("Templario", 50, 8, 4, new Arma("Espada Sagrada", 4));
$clerigo = new Clerigo("Clerigo", 45, 6, 3, new Arma("Cajado de Luz", 3));
$clerigo->setAliados([$templario, $clerigo]);


$fases = [
    [$templario, $clerigo],
    [new MagoAtk("Mago", 50, 11, 1, new Arma("Cajado Arcano", 5))],
    [new Demonio("Demonio", 85, 11, 5, new Arma("Garras Infernais", 6))],
    [new Rei("O Rei", 140, 13, 6, new Arma("Lamina Real", 8))],
];

$venceu = true;

foreach ($fases as $i => $fase) {
    print "\n========================================\n";
    print $antes[$i] . "\n";
    print "========================================\n";

    foreach ($fase as $inimigo) {
        print "\n>>> " . $inimigo->getNome() . " aparece! <<<";
    }
    print "\n";

    $venceu = batalha($vampiro, $fase);

    if ($venceu == false) {
        break;
    }

    print "\n" . $depois[$i] . "\n";

    if ($i < count($fases) - 1) {
        $vampiro->subirNivel();
    }
}

if ($venceu) {
    finalVitoria($vampiro->getNome());
} else {
    finalDerrota($vampiro->getNome());
}
