<?php

namespace JordanPartridge\LaraBikes\Contracts;

interface Stravable
{
    public function getAthleteId(): int;

    public function getClientId(): string;

    public function getClientSecret(): string;
}
