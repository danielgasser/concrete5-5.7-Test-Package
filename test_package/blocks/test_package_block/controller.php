<?php
namespace Concrete\Package\TestPackage\Block\TestPackageBlock;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Mail\Service;
use Concrete\Core\User\User;
use Concrete\Core\User\UserInfo;
use Concrete\Package\ToessLabMenuCard\Controller\SinglePage\Dashboard\Menucard\Menucard;
use Concrete\Package\ToessLabMenuCard\Entity\ToessLabMenuCardOrder;
use Concrete\Package\ToessLabMenuCard\Helper\Helper;
use Concrete\Package\ToessLabMenuCard\SMS\Send;
use Doctrine\DBAL\DBALException;

class Controller extends BlockController
{
    protected $btTable = 'btTestPackageBlock';
    protected $btBlockSet = null;
    protected $btInterfaceWidth = '500';
    protected $btInterfaceHeight = '300';
    protected $btCacheBlockRecord = true;
    protected $btDefaultSet = 'test_package_block';

    public function getBlockTypeName()
    {
        return t('Test Package Block');
    }

    public function getBlockTypeDescription()
    {
        return t('Test Package Block');
    }

    public function view()
    {
        $this->requireAsset('css', 'jquery/ui');
        $this->requireAsset('javascript', 'jquery/ui');
        $this->set('test', array('foo', 'bar'));
    }

}