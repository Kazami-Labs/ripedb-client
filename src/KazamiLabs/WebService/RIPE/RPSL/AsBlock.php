<?php
// AsBlock.php

namespace KazamiLabs\WebService\RIPE\RPSL;

use KazamiLabs\WebService\RIPE\RIPEObject;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;

class AsBlock extends RIPEObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create a AS-BLOCK RIPE object.
     * 
     * @param string $value The range of AS numbers in this block.
     * @return self
     */
    public function __construct($value)
    {
        $this->setType('as-block');
        $this->setKey('as-block');
        $this->init();
        $this->setAttribute('as-block', $value);
    }

    /**
     * Defines attributes for the AS-BLOCK RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('as-block',  Attr::REQUIRED, Attr::SINGLE);
        $this->create('descr',     Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('remarks',   Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('org',       Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('notify',    Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('mnt-lower', Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('mnt-by',    Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('source',    Attr::REQUIRED, Attr::SINGLE);

        $this->generated('created');
        $this->generated('last-modified');
    }
}
