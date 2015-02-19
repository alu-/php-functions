<?php
declare(encoding='UTF-8');
namespace alu\phpFunctions\ArrayFunctions;

/**
 * Utility functions for array operations
 * 
 * PHP version 5.3+
 * 
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 alu
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * 
 * @category  Array functions
 * @package   phpFunctions
 * @author    alu <alu@byteberry.net>
 * @copyright 2015 alu
 * @license   http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version   Git: $Id:$
 * @link      https://github.com/alu-/php-functions
 */

/**
 * Sorts a 2D array on value, according to the order of a supplied priority array
 * 
 * @param array  &$aArray Array to sort
 * @param string $sKey    Key in array to sort on
 * @param array  $aOrder  Array with values to sort on, in priority order
 * @return bool  Returns TRUE on success or FALSE on failure. 
 */
function sort2DArrayByPriority( &$aArray = array(), $sKey = '', $aOrder = array() ) {
	if( empty( $aOrder ) || empty( $aArray ) ) {
		return false;
	}

	return usort( $aArray, function( $a, $b ) use ( $sKey, $aOrder ) {
		if( is_object( $a ) ) {
			$sKey1 = $a->$sKey;
		} else if( is_array( $a ) ) {
			$sKey1 = $a[$sKey];
		} else {
			return 0;
		}

		if( is_object( $b ) ) {
			$sKey2 = $b->$sKey;
		} else if( is_array( $b ) ) {
			$sKey2 = $b[$sKey];
		} else {
			return 0;
		}

		if( !in_array( $sKey1, $aOrder ) || !in_array( $sKey2, $aOrder ) ) {
			return 0;
		}

		$sValue1 = array_search( $sKey1, $aOrder );
		$sValue2 = array_search( $sKey2, $aOrder );

		return $sValue1 > $sValue2 ? 1 : -1;
	} );
}
