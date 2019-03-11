<?php

use KazamiLabs\WebService\RIPE\Attribute;
use KazamiLabs\WebService\RIPE\MatchedAttribute;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;
use PHPUnit\Framework\TestCase;

class MatchedAttributeTest extends TestCase
{
	public function testAttributeInterfaceIsImplemented()
	{
		$attr = new MatchedAttribute('foo', true, '/x/');
		$this->assertInstanceOf('\KazamiLabs\WebService\RIPE\AttributeInterface', $attr);
	}

	public function testAttributeClassIsExtended()
	{
		$attr = new MatchedAttribute('foo', true, '/x/');
		$this->assertInstanceOf('\KazamiLabs\WebService\RIPE\Attribute', $attr);
	}

	public function testAttributeIsSingle()
	{
		$attr = new MatchedAttribute('foo', true, '/x/');
		$this->assertFalse($attr->isMultiple());
	}

	public function testAttributeRequiredness()
	{
		$attr = new MatchedAttribute('foo', Attr::REQUIRED, '/x/');
		$this->assertTrue($attr->isRequired());

		$attr = new MatchedAttribute('foo', Attr::OPTIONAL, '/x/');
		$this->assertFalse($attr->isRequired());
	}

	public function testGetRegexp()
	{
		$attr = new MatchedAttribute('foo', Attr::REQUIRED, '/\bFizzBuzz\b/');
		$this->assertSame('/\bFizzBuzz\b/', $attr->getRegExp());
	}

	public function testAttributeAcceptsMatchingValue()
	{
		$attr = new MatchedAttribute('foo', Attr::REQUIRED, '/\bFizzBuzz\b/');

		$attr->setValue('Hold onto the FizzBuzz!');
		$this->assertSame('Hold onto the FizzBuzz!', $attr->getValue());
	}

	/**
	 * @expectedException \KazamiLabs\WebService\RIPE\Exceptions\InvalidValueException
	 * @expectedExceptionMessageRegExp # \[bar\] #
	 */
	public function testAttributeDoesNotAcceptUndefinedValue()
	{
		$attr = new MatchedAttribute('bar', Attr::REQUIRED, '/\bFizzBuzz\b/');
		$attr->setValue('get the fizz buzz');
	}

	/**
	 * @expectedException LogicException
	 */
	public function testInvalidRegexpThrowsException()
	{
		$attr = new MatchedAttribute('bar', Attr::REQUIRED, 'string');
	}
}
