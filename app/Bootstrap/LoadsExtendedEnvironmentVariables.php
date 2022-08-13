<?php

namespace App\Bootstrap;

trait LoadsExtendedEnvironmentVariables {

    /**
     * Get the bootstrap classes for the application.
     *
     * @return array
     */
    protected function bootstrappers()
    {
        return array_merge(
            [
                LoadExtendedEnvironmentVariables::class,
            ],
            parent::bootstrappers(),
        );
    }

}
