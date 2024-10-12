<?php

namespace jordanpartridge\StravaIntegration\Http\Controllers;

final class CallbackController
{
    public function __invoke()
    {
        return 'callback';
    }
}