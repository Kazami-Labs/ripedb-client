<?php
// PeeringSet.php

namespace KazamiLabs\WebService\RIPE\RPSL;

use KazamiLabs\WebService\RIPE\RIPEObject;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;

class PeeringSet extends RIPEObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create a PEERING-SET RIPE object.
     * 
     * @param string $value The name of the set.
     * @return self
     */
    public function __construct($value)
    {
        $this->setType('peering-set');
        $this->setKey('peering-set');
        $this->init();
        $this->setAttribute('peering-set', $value);
    }

    /**
     * Defines attributes for the PEERING-SET RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('peering-set', Attr::REQUIRED, Attr::SINGLE);
        $this->create('descr',       Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('peering',     Attr::OPTIONAL, Attr::SINGLE);
        $this->create('mp-peering',  Attr::OPTIONAL, Attr::SINGLE);
        $this->create('remarks',     Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('org',         Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('tech-c',      Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('admin-c',     Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('notify',      Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('mnt-by',      Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('mnt-lower',   Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('source',      Attr::REQUIRED, Attr::SINGLE);

        $this->generated('created');
        $this->generated('last-modified');
    }
}
