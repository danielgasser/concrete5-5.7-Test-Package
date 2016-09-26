<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 8/19/15
 * Time: 5:20 PM
 */

namespace Concrete\Package\TestPackage\Entity;

/**
 * @Entity
 * @Table(name="TestTable")
 */

class TestTable
{

    /**
     * @Id
     * @Column(type="integer")
     */
    protected $testID;


    /**
     * @Id
     * @Column(type="string")
     */
    protected $testField;

    public function getTestID()
    {
        return $this->testID;
    }

    public function getTestField()
    {
        return $this->testField;
    }

    public function setTestField($testField)
    {
        $this->testField = $testField;
    }

}