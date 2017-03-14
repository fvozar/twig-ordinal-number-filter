<?php

namespace FvozarTests\Twig;

use Fvozar\Twig\OrdinalNumberExtension;

require_once __DIR__ . '/../../../vendor/autoload.php';

/**
 * Class OrdinalNumberExtensionTest
 *
 * @package FvozarTests\Twig
 * @author Filip Vozar <filip.vozar@gmail.com>
 */
class OrdinalNumberExtensionTest extends \PHPUnit_Framework_TestCase
{

	public function testExtensionLoad()
	{
		$loader = new \Twig_Loader_Array(['foo' => '']);
		$twig = new \Twig_Environment($loader);
		$twig->addExtension(new OrdinalNumberExtension());
		$this->addToAssertionCount(1);
		$twig->render('foo');
	}


	public function testBasicIntegerValue()
	{
		$filter = new OrdinalNumberExtension();

		$numbers = [0 => '0th', 1 => '1st', 2 => '2nd', 3 => '3rd', 4 => '4th', 5 => '5th'];

		foreach ($numbers as $number => $ordinal) {
			$this->assertEquals($ordinal, $filter->makeOrdinal($number));
		}
	}


	public function testBasicStringNumericValue()
	{
		$filter = new OrdinalNumberExtension();

		$numbers = ['0' => '0th', '1' => '1st', '2' => '2nd', '3' => '3rd', '4' => '4th', '5' => '5th'];

		foreach ($numbers as $number => $ordinal) {
			$this->assertEquals($ordinal, $filter->makeOrdinal($number));
		}
	}


	public function testInvalidStringValue()
	{
		$filter = new OrdinalNumberExtension();

		$foo = 'bar';

		$this->assertEquals('bar', $filter->makeOrdinal($foo));
	}


	public function testBigIntegerValue()
	{
		$filter = new OrdinalNumberExtension();

		$number = 100000;
		$this->assertEquals("100,000th", $filter->makeOrdinal($number));
	}


	public function testDecimalNumberValue()
	{
		$filter = new OrdinalNumberExtension();

		$number = 64.32789;
		$this->assertEquals("64th", $filter->makeOrdinal($number));
	}


	public function testNegativeNumberValue()
	{
		$filter = new OrdinalNumberExtension();

		$number = -64.32789;
		$this->assertEquals("−64th", $filter->makeOrdinal($number));
	}


	public function testNonNumberValue()
	{
		$filter = new OrdinalNumberExtension();

		$value = 'foo bar';

		$this->assertEquals("foo bar", $filter->makeOrdinal($value));
	}


	public function testObjectValue()
	{
		$filter = new OrdinalNumberExtension();

		$value = new \stdClass();
		$value->foo = 'bar';

		$this->assertEquals($value, $filter->makeOrdinal($value));
	}


	public function testArrayValue()
	{
		$filter = new OrdinalNumberExtension();

		$value = ['foo' => 'bar', 'baz'];

		$this->assertEquals($value, $filter->makeOrdinal($value));
	}


	public function testLocalizedNumberValue()
	{
		$filter = new OrdinalNumberExtension();

		$value = 1000000;

		$this->assertEquals('1 000 000.', $filter->makeOrdinal($value, 'sk'));
	}
}
