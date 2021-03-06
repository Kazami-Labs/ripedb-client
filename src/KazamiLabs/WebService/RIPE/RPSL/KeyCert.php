<?php
// KeyCert.php

namespace KazamiLabs\WebService\RIPE\RPSL;

use KazamiLabs\WebService\RIPE\RIPEObject;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;

/**
 * Be aware that the 'method', 'owner' and 'fingerpr' attributes 
 * must not be set/updated/deleted by the user.
 */
class KeyCert extends RIPEObject
{
    /**
     * The version of the RIPE DB used for attribute definitions.
     */
    const VERSION = '1.92';

    /**
     * Create a key certification (KEY-CERT) RIPE object.
     * 
     * @param string $value The key ID.
     * @return self
     */
    public function __construct($value)
    {
        $this->setType('key-cert');
        $this->setKey('key-cert');
        $this->init();
        $this->setAttribute('key-cert', $value);
    }

    /**
     * Defines attributes for the KEY-CERT RIPE object. 
     * 
     * @return void
     */
    protected function init()
    {
        $this->create('key-cert', Attr::REQUIRED, Attr::SINGLE);
        $this->create('certif',   Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('org',      Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('remarks',  Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('notify',   Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('admin-c',  Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('tech-c',   Attr::OPTIONAL, Attr::MULTIPLE);
        $this->create('mnt-by',   Attr::REQUIRED, Attr::MULTIPLE);
        $this->create('source',   Attr::REQUIRED, Attr::SINGLE);

        $this->generated('method');
        $this->generated('owner', Attr::MULTIPLE);
        $this->generated('fingerpr');
        $this->generated('created');
        $this->generated('last-modified');
    }
}
