<?php
/**
 * Case Folding Properties.
 *
 * Provides case mapping of Unicode characters for code points U+2C80 through U+2CFF
 *
 * @see http://www.unicode.org/Public/UNIDATA/UCD.html
 * @see http://www.unicode.org/Public/UNIDATA/CaseFolding.txt
 * @see http://www.unicode.org/reports/tr21/tr21-5.html
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       Cake.Config.unicode.casefolding
 * @since         CakePHP(tm) v 1.2.0.5691
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * The upper field is the decimal value of the upper case character
 *
 * The lower filed is an array of the decimal values that form the lower case version of a character.
 *
 *    The status field is:
 * C: common case folding, common mappings shared by both simple and full mappings.
 * F: full case folding, mappings that cause strings to grow in length. Multiple characters are separated by spaces.
 * S: simple case folding, mappings to single characters where different from F.
 * T: special case for uppercase I and dotted uppercase I
 *   - For non-Turkic languages, this mapping is normally not used.
 *   - For Turkic languages (tr, az), this mapping can be used instead of the normal mapping for these characters.
 *     Note that the Turkic mappings do not maintain canonical equivalence without additional processing.
 *     See the discussions of case mapping in the Unicode Standard for more information.
 */
$config['2c80_2cff'][] = ['upper' => 11392, 'status' => 'C', 'lower' => [11393]]; /* COPTIC CAPITAL LETTER ALFA */
$config['2c80_2cff'][] = ['upper' => 11394, 'status' => 'C', 'lower' => [11395]]; /* COPTIC CAPITAL LETTER VIDA */
$config['2c80_2cff'][] = ['upper' => 11396, 'status' => 'C', 'lower' => [11397]]; /* COPTIC CAPITAL LETTER GAMMA */
$config['2c80_2cff'][] = ['upper' => 11398, 'status' => 'C', 'lower' => [11399]]; /* COPTIC CAPITAL LETTER DALDA */
$config['2c80_2cff'][] = ['upper' => 11400, 'status' => 'C', 'lower' => [11401]]; /* COPTIC CAPITAL LETTER EIE */
$config['2c80_2cff'][] = ['upper' => 11402, 'status' => 'C', 'lower' => [11403]]; /* COPTIC CAPITAL LETTER SOU */
$config['2c80_2cff'][] = ['upper' => 11404, 'status' => 'C', 'lower' => [11405]]; /* COPTIC CAPITAL LETTER ZATA */
$config['2c80_2cff'][] = ['upper' => 11406, 'status' => 'C', 'lower' => [11407]]; /* COPTIC CAPITAL LETTER HATE */
$config['2c80_2cff'][] = ['upper' => 11408, 'status' => 'C', 'lower' => [11409]]; /* COPTIC CAPITAL LETTER THETHE */
$config['2c80_2cff'][] = ['upper' => 11410, 'status' => 'C', 'lower' => [11411]]; /* COPTIC CAPITAL LETTER IAUDA */
$config['2c80_2cff'][] = ['upper' => 11412, 'status' => 'C', 'lower' => [11413]]; /* COPTIC CAPITAL LETTER KAPA */
$config['2c80_2cff'][] = ['upper' => 11414, 'status' => 'C', 'lower' => [11415]]; /* COPTIC CAPITAL LETTER LAULA */
$config['2c80_2cff'][] = ['upper' => 11416, 'status' => 'C', 'lower' => [11417]]; /* COPTIC CAPITAL LETTER MI */
$config['2c80_2cff'][] = ['upper' => 11418, 'status' => 'C', 'lower' => [11419]]; /* COPTIC CAPITAL LETTER NI */
$config['2c80_2cff'][] = ['upper' => 11420, 'status' => 'C', 'lower' => [11421]]; /* COPTIC CAPITAL LETTER KSI */
$config['2c80_2cff'][] = ['upper' => 11422, 'status' => 'C', 'lower' => [11423]]; /* COPTIC CAPITAL LETTER O */
$config['2c80_2cff'][] = ['upper' => 11424, 'status' => 'C', 'lower' => [11425]]; /* COPTIC CAPITAL LETTER PI */
$config['2c80_2cff'][] = ['upper' => 11426, 'status' => 'C', 'lower' => [11427]]; /* COPTIC CAPITAL LETTER RO */
$config['2c80_2cff'][] = ['upper' => 11428, 'status' => 'C', 'lower' => [11429]]; /* COPTIC CAPITAL LETTER SIMA */
$config['2c80_2cff'][] = ['upper' => 11430, 'status' => 'C', 'lower' => [11431]]; /* COPTIC CAPITAL LETTER TAU */
$config['2c80_2cff'][] = ['upper' => 11432, 'status' => 'C', 'lower' => [11433]]; /* COPTIC CAPITAL LETTER UA */
$config['2c80_2cff'][] = ['upper' => 11434, 'status' => 'C', 'lower' => [11435]]; /* COPTIC CAPITAL LETTER FI */
$config['2c80_2cff'][] = ['upper' => 11436, 'status' => 'C', 'lower' => [11437]]; /* COPTIC CAPITAL LETTER KHI */
$config['2c80_2cff'][] = ['upper' => 11438, 'status' => 'C', 'lower' => [11439]]; /* COPTIC CAPITAL LETTER PSI */
$config['2c80_2cff'][] = ['upper' => 11440, 'status' => 'C', 'lower' => [11441]]; /* COPTIC CAPITAL LETTER OOU */
$config['2c80_2cff'][] = ['upper' => 11442, 'status' => 'C', 'lower' => [11443]]; /* COPTIC CAPITAL LETTER DIALECT-P ALEF */
$config['2c80_2cff'][] = ['upper' => 11444, 'status' => 'C', 'lower' => [11445]]; /* COPTIC CAPITAL LETTER OLD COPTIC AIN */
$config['2c80_2cff'][] = ['upper' => 11446, 'status' => 'C', 'lower' => [11447]]; /* COPTIC CAPITAL LETTER CRYPTOGRAMMIC EIE */
$config['2c80_2cff'][] = ['upper' => 11448, 'status' => 'C', 'lower' => [11449]]; /* COPTIC CAPITAL LETTER DIALECT-P KAPA */
$config['2c80_2cff'][] = ['upper' => 11450, 'status' => 'C', 'lower' => [11451]]; /* COPTIC CAPITAL LETTER DIALECT-P NI */
$config['2c80_2cff'][] = ['upper' => 11452, 'status' => 'C', 'lower' => [11453]]; /* COPTIC CAPITAL LETTER CRYPTOGRAMMIC NI */
$config['2c80_2cff'][] = ['upper' => 11454, 'status' => 'C', 'lower' => [11455]]; /* COPTIC CAPITAL LETTER OLD COPTIC OOU */
$config['2c80_2cff'][] = ['upper' => 11456, 'status' => 'C', 'lower' => [11457]]; /* COPTIC CAPITAL LETTER SAMPI */
$config['2c80_2cff'][] = ['upper' => 11458, 'status' => 'C', 'lower' => [11459]]; /* COPTIC CAPITAL LETTER CROSSED SHEI */
$config['2c80_2cff'][] = ['upper' => 11460, 'status' => 'C', 'lower' => [11461]]; /* COPTIC CAPITAL LETTER OLD COPTIC SHEI */
$config['2c80_2cff'][] = ['upper' => 11462, 'status' => 'C', 'lower' => [11463]]; /* COPTIC CAPITAL LETTER OLD COPTIC ESH */
$config['2c80_2cff'][] = ['upper' => 11464, 'status' => 'C', 'lower' => [11465]]; /* COPTIC CAPITAL LETTER AKHMIMIC KHEI */
$config['2c80_2cff'][] = ['upper' => 11466, 'status' => 'C', 'lower' => [11467]]; /* COPTIC CAPITAL LETTER DIALECT-P HORI */
$config['2c80_2cff'][] = ['upper' => 11468, 'status' => 'C', 'lower' => [11469]]; /* COPTIC CAPITAL LETTER OLD COPTIC HORI */
$config['2c80_2cff'][] = ['upper' => 11470, 'status' => 'C', 'lower' => [11471]]; /* COPTIC CAPITAL LETTER OLD COPTIC HA */
$config['2c80_2cff'][] = ['upper' => 11472, 'status' => 'C', 'lower' => [11473]]; /* COPTIC CAPITAL LETTER L-SHAPED HA */
$config['2c80_2cff'][] = ['upper' => 11474, 'status' => 'C', 'lower' => [11475]]; /* COPTIC CAPITAL LETTER OLD COPTIC HEI */
$config['2c80_2cff'][] = ['upper' => 11476, 'status' => 'C', 'lower' => [11477]]; /* COPTIC CAPITAL LETTER OLD COPTIC HAT */
$config['2c80_2cff'][] = ['upper' => 11478, 'status' => 'C', 'lower' => [11479]]; /* COPTIC CAPITAL LETTER OLD COPTIC GANGIA */
$config['2c80_2cff'][] = ['upper' => 11480, 'status' => 'C', 'lower' => [11481]]; /* COPTIC CAPITAL LETTER OLD COPTIC DJA */
$config['2c80_2cff'][] = ['upper' => 11482, 'status' => 'C', 'lower' => [11483]]; /* COPTIC CAPITAL LETTER OLD COPTIC SHIMA */
$config['2c80_2cff'][] = ['upper' => 11484, 'status' => 'C', 'lower' => [11485]]; /* COPTIC CAPITAL LETTER OLD NUBIAN SHIMA */
$config['2c80_2cff'][] = ['upper' => 11486, 'status' => 'C', 'lower' => [11487]]; /* COPTIC CAPITAL LETTER OLD NUBIAN NGI */
$config['2c80_2cff'][] = ['upper' => 11488, 'status' => 'C', 'lower' => [11489]]; /* COPTIC CAPITAL LETTER OLD NUBIAN NYI */
$config['2c80_2cff'][] = ['upper' => 11490, 'status' => 'C', 'lower' => [11491]]; /* COPTIC CAPITAL LETTER OLD NUBIAN WAU */
