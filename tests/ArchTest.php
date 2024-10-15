<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// General code quality checks
arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

// Model-specific checks
arch('models extend eloquent')
    ->expect('JordanPartridge\LaraBikes\Models')
    ->toExtend(Model::class);

arch('models have factories')
    ->expect('JordanPartridge\LaraBikes\Models')
    ->toUse(HasFactory::class);

// Specific model checks
arch('StravaClient model has factory')
    ->expect('JordanPartridge\LaraBikes\Models\StravaClient')
    ->toUse(HasFactory::class);

// Namespace organization checks
arch('models are in the correct namespace')
    ->expect('JordanPartridge\LaraBikes\Models')
    ->toBeClasses()
    ->toExtend(Model::class);
// File location checks
arch('model files are in the correct directory')
    ->expect('JordanPartridge\LaraBikes\Models')
    ->toBeClasses();


// Relationship method checks
arch('Strava client encrypts client secret')
    ->expect('JordanPartridge\LaraBikes\Models\StravaClient')
     ->toHaveMethod('setClientSecretAttribute')
    ->toHaveMethod('getClientSecretAttribute');

// Factory checks
arch('factories are in the correct namespace')
    ->expect('JordanPartridge\LaraBikes\Database\Factories')
    ->toBeClasses()
    ->toExtend('Illuminate\Database\Eloquent\Factories\Factory');


