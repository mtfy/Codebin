<?php

namespace App\Helpers;


class Helpers
{

	/**
	 * Generate cryptographically secure random string
	 * Based on https://gist.github.com/raveren/5555297
	 * 
	 * 
	 * @param  string  $pattern
	 * @param  integer $length
	 * @return string
	 */
	public static function randomString($pattern = 'alnum', $length = 13) : string
	{
		switch ($pattern)
		{
			case 'alnum':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'alpha':
				$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'hexdec':
				$pool = '0123456789abcdef';
				break;
			case 'numeric':
				$pool = '0123456789';
				break;
			case 'nozero':
				$pool = '123456789';
				break;
			case 'distinct':
				$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
				break;
			default:
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';;
				break;
		}


		$crypto_rand_secure = function ( $min, $max ) {
			$range = $max - $min;
			if ( $range < 0 )
				return $min;

			$log    = \log( $range, 2 );
			$bytes  = ( $log / 8 ) + 1;
			$bits   = $log + 1;
			$filter = ( 1 << $bits ) - 1;
			do {
				$rnd = \hexdec( \bin2hex( \openssl_random_pseudo_bytes( $bytes ) ) );
				$rnd = $rnd & $filter;
			} while ( $rnd >= $range );
			return $min + $rnd;
		};

		$token = '';
		$max   = \mb_strlen( $pool, 'utf-8' );

		for ($i = 0; $i < $length; $i++)
		{
			$token .= $pool[$crypto_rand_secure( 0, $max )];
		}
		
		return $token;
	}


	/**
	 * A helper function to format bytes to human readable
	 * filesize format. Supporting power between 1000 and 1024.
	 * 
	 * Credits to original author:
	 * 		https://stackoverflow.com/a/2510455
	 *
	 * @param  integer $bytes
	 * @param  integer $precision
	 * @param  mixed   $force_unit
	 * @param  boolean $si
	 * @return string
	 */
	public static function formatBytes(int $bytes, int $precision = 2, mixed $force_unit = NULL, bool $si = true) : string
	{
		$force_unit = (\is_null($force_unit) || !\is_string($force_unit)) ? '' : $force_unit;

		// SI prefixes (decimal)
		$units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
		$mod   = 1000;

		// IEC prefixes (binary)
		if (!$si || \mb_strpos($force_unit, 'i', 0, 'utf-8') !== false)
		{
			$units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
			$mod   = 1024;
		}

		// We will not add precisions to < 1 KB
		if ($bytes <= ($mod * 10))
			$precision = 0;

		// Determine unit to use
		$power = \array_search($force_unit, $units);

		if (false === $power)
			$power = ($bytes > 0) ? \floor( \log($bytes, $mod) ) : 0;

		$format = '%01.' . $precision . 'f %s';
		
		return \sprintf($format, ($bytes / \pow($mod, $power)), $units[$power]);
	}

}