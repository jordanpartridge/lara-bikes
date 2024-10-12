<?php

namespace jordanpartridge\LaraBikes\Http\Controllers;

final class CallbackController
{
    public function __invoke()
    {
        return 'callback';
    }
}