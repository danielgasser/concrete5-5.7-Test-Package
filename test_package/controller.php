<?php

namespace Concrete\Package\TestPackage;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Package\Package;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Package\TestPackage\Help\HelpServiceProvider;

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
        $pkg = $this;
        $al = AssetList::getInstance();
        $al->register(
            'css', 'foo', 'css/foo.css', array('position' => \Asset::ASSET_POSITION_HEADER), $pkg
        );
        $al->register(
            'javascript', 'foo', 'js/foo.js', array('position' => \Asset::ASSET_POSITION_FOOTER), $pkg
        );
        $al->register(
            'css', 'selectize', 'js/libs/selectize/css/selectize.css', array('position' => \Asset::ASSET_POSITION_HEADER), $pkg
        );
        $al->register(
            'javascript', 'selectize', 'js/libs/selectize/js/selectize.js', array('position' => \Asset::ASSET_POSITION_FOOTER), $pkg
        );
        $al->registerGroup('foo-bar', array(
            array('css', 'selectize'),
            array('javascript', 'selectize'),
            array('javascript', 'foo'),
            array('css', 'foo'),
        ));
    }

    private function installOrUpgrade($pkg)
    {
        $this->getOrAddSinglePage($pkg, '/dashboard/test', 'Test');
        BlockType::installBlockType('test_package_block', $pkg);
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
