<?php
namespace BH\Frontend\Frontend;

class Morph
{
	const GENDER_MALE    = 'M';
	const GENDER_FEMALE  = 'F';
	const GENDER_NEUTRAL = '';
	const GENDER_OTHER   = 'O';

	/**
	 * @param        $value
	 * @param string $gender
	 * @param string $set
	 *
	 * @return string
	 */
	public static function getEnd($value, $gender = self::GENDER_NEUTRAL, $set = '')
	{
		if (preg_match('/1\d$/', $value))
			$n = 2;
		elseif (preg_match('/1$/', $value))
			$n = 0;
		elseif (preg_match('/(2|3|4)$/', $value))
			$n = 1;
		else
			$n = 2;

		switch ($gender) {

			case self::GENDER_MALE:
				$ends = array(
					0 => array('', 'а', 'ев'),
					1 => array('', 'а', 'ов'),
					2 => array('', 'я', 'ей'),
					3 => array('', 'а', ''),
					4 => array('ся', 'ось', 'ось'),
					5 => array('ю', 'ям', 'ям'),
					6 => array('я', 'ей', 'ей'),
					7 => array('ень', 'ня', 'ней')
				);

				break;

			case self::GENDER_FEMALE:
				$ends = array(
					1 => array('а', 'и', ''),
					2 => array('я', 'и', 'й'),
					3 => array('ья', 'ьи', 'ей'),
					4 => array('ь', 'и', 'ей'),
					5 => array('а', 'ы', ''),
					6 => array('ка', 'ки', 'ок')
				);

				break;

			case self::GENDER_NEUTRAL:
				$ends = array(
					1 => array('е', 'я', 'й')
				);

				$set = 1;

				break;

			case self::GENDER_OTHER:
			default:
				$ends = array(
					1 => array('', 'о', 'о'),
					2 => array('', 'ах', 'ах')
				);

				break;
		}

		return $ends[$set][$n];
	}
}