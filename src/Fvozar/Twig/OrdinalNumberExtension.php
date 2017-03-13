<?php

namespace Fvozar\Twig;

/**
 * Class OrdinalNumberExtension
 *
 * @package AppBundle\Twig
 * @author Filip Vozar <filip.vozar@gmail.com>
 */
class OrdinalNumberExtension extends \Twig_Extension
{

	public function getName()
	{
		return 'ordinal';
	}


	public function getFilters()
	{
		return [
			new \Twig_SimpleFilter('ordinal', [$this, 'makeOrdinal']),
		];
	}


	/**
	 * @param mixed $number
	 * @param string $locale
	 * @return string
	 */
	public function makeOrdinal($number, $locale = 'en')
	{
		return !is_numeric($number) ? $number : (new \NumberFormatter($locale, \NumberFormatter::ORDINAL))->format($number);
	}
}
