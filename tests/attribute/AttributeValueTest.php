<?php

use KazamiLabs\WebService\RIPE\Attribute;
use KazamiLabs\WebService\RIPE\AttributeInterface as Attr;
use KazamiLabs\WebService\RIPE\AttributeValue;
use KazamiLabs\WebService\RIPE\FixedAttribute;
use KazamiLabs\WebService\RIPE\MatchedAttribute;
use PHPUnit\Framework\TestCase;
use Test\RegObject;

class AttributeValueTest extends TestCase
{
	public function testAttributeAcceptsValueObject()
	{
		$reg   = new RegObject;
		$value = new AttributeValue('something');

		$this->assertSame('something', $value->getValue());

		$reg['register'] = $value;

		$this->assertEquals('something',  $reg['register']);
		$this->assertNotSame('something', $reg['register']);
	}

	public function testAttributeValueWithComment()
	{
		$reg   = new RegObject;
		$value = new AttributeValue('something');
		$value->setComment('else');

		$this->assertSame('else', $value->getComment());

		$reg['register'] = $value;

		$this->assertEquals('something # else', $reg['register']);
	}

	public function testAttributeValueWithReference()
	{
		$reg   = new RegObject;
		$value = new AttributeValue('something');
		$value->setType('poem');

		$reg['register'] = $value;

		$this->assertEquals('something', $reg['register']);

		$poem = $reg['register']->getObject();
		$this->assertInstanceOf('KazamiLabs\WebService\RIPE\RPSL\Poem', $poem);
		$this->assertSame('something', $poem->getPrimaryKey());
	}

	/**
	 * @expectedException KazamiLabs\WebService\RIPE\Exceptions\InvalidDataTypeException
	 */
	public function testGetObjectWithoutTypeFails()
	{
		$value = new AttributeValue('something');
		$value->getObject();
	}

	/**
	 * @expectedException KazamiLabs\WebService\RIPE\Exceptions\InvalidValueException
	 */
	public function testGetObjectWithUnknownTypeFails()
	{
		$value = new AttributeValue('something');
		$value->setType('foo')->getObject();
	}

	public function testAttributeValueWithLink()
	{
		$reg   = new RegObject;
		$value = new AttributeValue('something');
		$link  = 'http://www.example.com/something';
		$value->setLink($link);

		$reg['register'] = $value;

		$this->assertEquals($link, $reg['register']->getLink());
	}

	public function testFixedAttributeWithValueObject()
	{
		$attr  = new FixedAttribute('foo', Attr::REQUIRED, ['a', 'b', 'c']);
		$value = new AttributeValue('a');

		$attr->setValue($value);
		$this->assertSame('a', $attr->getValue());
	}

	public function testMatchedAttributeWithValueObject()
	{
		$attr  = new MatchedAttribute('foo', Attr::REQUIRED, '/x/');
		$value = new AttributeValue('xyz');

		$attr->setValue($value);
		$this->assertSame('xyz', $attr->getValue());
	}

	public function testAttributeValueToArray() {
		$reg   = new RegObject;
		$value = new AttributeValue('something');
		$value->setLink('http://www.example.com/something');

		$reg['source'] = 'TEST';
		$reg['register'] = $value;

		$this->assertEquals($reg->toArray()['objects']['object'][0]['attributes']['attribute'], [
			['name' => 'register', 'value' => 'something'],
			['name' => 'source', 'value' => 'TEST']
		]);
	}

	public function testSingleAttributeWithValueObject()
	{
		$attr = new Attribute('test', Attr::REQUIRED, Attr::SINGLE);

		$value = new AttributeValue('something');
		$value->setType('example')->setLink('http://www.example.com/something');

		$attr->addValue($value);

		$this->assertInternalType('object', $attr->getValue());
	}

	public function testMultipleAttributeWithValueObject()
	{
		$attr = new Attribute('test', Attr::REQUIRED, Attr::MULTIPLE);

		$value = new AttributeValue('something');
		$value->setType('example')->setLink('http://www.example.com/something');

		$attr->addValue($value);

		$data = $attr->getValue();

		$this->assertInternalType('array', $data);
		$this->assertCount(1, $data);
		$this->assertInternalType('object', $data[0]);
	}
}
