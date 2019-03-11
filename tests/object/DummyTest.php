<?php

use KazamiLabs\WebService\RIPE\AttributeInterface as A;
use KazamiLabs\WebService\RIPE\Dummy;
use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{
	public function testObjectTypeIsCorrectlySet()
	{
		$obj = new Dummy('foo', 'bar');
		$this->assertSame('foo', $obj->getType());
		$this->assertSame('bar', $obj->getPrimaryKeyName());

		$obj = new Dummy('foo');
		$this->assertSame('foo', $obj->getType());
		$this->assertSame('foo', $obj->getPrimaryKeyName());
	}

	public function testNonExistingAttributeGetsCreated()
	{
		$obj = new Dummy('foo');
		$obj['fizz'] = 'buzz';

		$this->assertInstanceOf('\KazamiLabs\WebService\RIPE\Attribute', 
			$obj->getAttribute('fizz'));
	}

	public function testDefaultCreatedAttributeProperties()
	{
		$obj = new Dummy('foo');
		$obj['fizz'] = 'buzz';

		$this->assertFalse($obj->getAttribute('fizz')->isRequired());
		$this->assertTrue($obj->getAttribute('fizz')->isMultiple());
	}

	public function testSetupAttributeProperties()
	{
		$obj = new Dummy('foo');
		$obj->setupAttribute('buzz', A::REQUIRED, A::SINGLE);

		$this->assertTrue($obj->getAttribute('buzz')->isRequired());
		$this->assertFalse($obj->getAttribute('buzz')->isMultiple());
	}
}
