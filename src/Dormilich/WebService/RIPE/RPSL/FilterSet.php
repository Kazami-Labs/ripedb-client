<?php
// FilterSet.php

namespace KazamiLabs\WebService\RIPE\RPSL;

use KazamiLabs\WebService\RIPE\RIPEObject;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;

class FilterSet extends RIPEObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create a FILTER-SET RIPE object.
     * 
     * @param string $value The name of the set (of routers).
     * @return self
     */
    public function __construct($value)
    {
        $this->setType('filter-set');
        $this->setKey('filter-set');
        $this->init();
        $this->setAttribute('filter-set', $value);
    }

    /**
     * Defines attributes for the FILTER-SET RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('filter-set',  Attr::REQUIRED, Attr::SINGLE);
        $this->create('descr',       Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('filter',      Attr::OPTIONAL, Attr::SINGLE);
        $this->create('mp-filter',   Attr::OPTIONAL, Attr::SINGLE);
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
