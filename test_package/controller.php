<?php

namespace Concrete\Package\TestPackage;
use Concrete\Core\Asset;
use Concrete\Core\Foundation\Service\ProviderList;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Package\TestPackage\Help\HelpServiceProvider;
use Illuminate\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\ClassLoader\Psr4ClassLoader;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

    /**
     * @var string
     */
    protected $pkgHandle = 'test_package';
    protected $appVersionRequired = '5.7.4.2';
    protected $pkgVersion = '0.9';
    protected $pkgAutoloaderMapCoreExtensions = true;

    public function getPackageDescription()
    {
        return t("Test Packaged.");
    }

    public function getPackageName()
    {
        return t("Test Package");
    }


    public function install()
    {
        $pkg = parent::install();
        $this->installOrUpgrade($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();
        $pkg = self::getPackageHandle();
    }

    public function uninstall()
    {
        parent::uninstall();
    }

    public function on_start()
    {
        $app = \Core::make('app');
        $provider = new HelpServiceProvider($app);
        $provider->register();
    }

    private function installOrUpgrade($pkg)
    {

        $this->getOrAddSinglePage($pkg, '/dashboard/test', 'Test');

    }

    private function getOrAddSinglePage($pkg, $cPath, $cName = '', $cDescription = '') {
        \Loader::model('single_page');

        $sp = SinglePage::add($cPath, $pkg);

        if (is_null($sp)) {
            $sp = Page::getByPath($cPath);
        } else {
            $data = array();
            if (!empty($cName)) {
                $data['cName'] = $cName;
            }
            if (!empty($cDescription)) {
                $data['cDescription'] = $cDescription;
            }

            if (!empty($data)) {
                $sp->update($data);
            }
        }

        return $sp;
    }


}