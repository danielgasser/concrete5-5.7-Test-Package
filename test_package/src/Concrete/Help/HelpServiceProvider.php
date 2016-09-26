<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/8/15
 * Time: 8:40 AM
 */

namespace Concrete\Package\TestPackage\Help;
use Concrete\Core\Foundation\Service\Provider;

class HelpServiceProvider extends Provider {

    public function register()
    {
        $this->app['help/dashboard']->registerMessageString('/dashboard/test',
            t('HELP')
        );
    }
}