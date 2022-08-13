<?php

namespace App\Bootstrap;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Env;

class LoadExtendedEnvironmentVariables {

    protected $envGlobs = [
        '/run/secrets/*.env',
    ];

    /**
     * Bootstrap the given application.
     *
     * @param  Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        if ($app->configurationIsCached()) {
            return;
        }

        $this->loadExtendedEnvironmentVariables();
    }

    protected function loadExtendedEnvironmentVariables()
    {
        try {
            foreach ($this->envGlobs as $envGlob) {
                foreach (glob($envGlob) as $filename) {
                    Dotenv::create(
                        Env::getRepository(),
                        dirname($filename),
                        basename($filename),
                    )->safeLoad();
                }
            }
        } catch (InvalidFileException $e) {
            $this->writeErrorAndDie($e);
        }
    }

}
