<?php

namespace Concrete\Package\TestPackage\Controller\SinglePage\Dashboard;
use Concrete\Core\Config;
use Concrete\Package\TestPackage\Entity\TestTable;
use Loader;
use Concrete\Core\Page;
use Concrete\Core\Area;
use \Concrete\Core\Page\Controller\DashboardPageController;

class Test extends DashboardPageController
{

    public function view()
    {
        $entity = new TestTable();
        $this->set('test', $entity);
    }

}