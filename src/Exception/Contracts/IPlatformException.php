<?php

namespace App\Exceptions\Contracts;

interface IPlatformException
{
    public function getType();

    public function getLogLevel();

    public function getErrors();
}
