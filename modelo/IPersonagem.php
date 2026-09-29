<?php

interface IPersonagem
{
    public function atacar(Personagem $alvo);
    public function defender();
}
