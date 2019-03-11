<?php

use KazamiLabs\WebService\RIPE\Attribute;
use KazamiLabs\WebService\RIPE\FixedAttribute;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;
use PHPUnit\Framework\TestCase;

class FixedAttributeTest extends TestCase
{
	public function testAttributeInterfaceIsImplemented()
	{
		$attr = new FixedAttribute('foo', true, []);
		$this->assertInstanceOf('\KazamiLabs\WebService\RIPE\AttributeInterface', $attr);
	}

	public function testAttributeClassIsExtended()
	{
		$attr = new FixedAttribute('foo', true, []);
		$this->assertInstanceOf('\KazamiLabs\WebService\RIPE\Attribute', $attr);
	}

	public function testAttributeIsSingle()
	{
		$attr = new FixedAttribute('foo', true, []);
		$this->assertFalse($attr->isMultiple());
	}

	public function testAttributeRequiredness()
	{
		$attr = new FixedAttribute('foo', Attr::REQUIRED, []);
		$this->assertTrue($attr->isRequired());

		$attr = new FixedAttribute('foo', Attr::OPTIONAL, []);
		$this->assertFalse($attr->isRequired());
	}

	public function testAttributeAcceptsDefinedValues()
	{
		$attr = new FixedAttribute('foo', Attr::REQUIRED, ['a', 'b', 'c']);

		$attr->setValue('a');
		$this->assertSame('a', $attr->getValue());

		$attr->setValue('b');
		$this->assertSame('b', $attr->getValue());

		$attr->setValue('c');
		$this->assertSame('c', $attr->getValue());
	}

	/**
	 * @expectedException \KazamiLabs\WebService\RIPE\Exceptions\InvalidValueException
	 * @expectedExceptionMessageRegExp # \[bar\] #
	 */
	public function testAttributeDoesNotAcceptUndefinedValue()
	{
		$attr = new FixedAttribute('bar', Attr::REQUIRED, ['a', 'b', 'c']);
		$attr->setValue('x');
	}
}
