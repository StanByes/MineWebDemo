<?php
/**
 * Case Folding Properties.
 *
 * Provides case mapping of Unicode characters for code points U+0530 through U+058F
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
$config['0530_058f'][] = ['upper' => 1329, 'status' => 'C', 'lower' => [1377]]; /* ARMENIAN CAPITAL LETTER AYB */
$config['0530_058f'][] = ['upper' => 1330, 'status' => 'C', 'lower' => [1378]]; /* ARMENIAN CAPITAL LETTER BEN */
$config['0530_058f'][] = ['upper' => 1331, 'status' => 'C', 'lower' => [1379]]; /* ARMENIAN CAPITAL LETTER GIM */
$config['0530_058f'][] = ['upper' => 1332, 'status' => 'C', 'lower' => [1380]]; /* ARMENIAN CAPITAL LETTER DA */
$config['0530_058f'][] = ['upper' => 1333, 'status' => 'C', 'lower' => [1381]]; /* ARMENIAN CAPITAL LETTER ECH */
$config['0530_058f'][] = ['upper' => 1334, 'status' => 'C', 'lower' => [1382]]; /* ARMENIAN CAPITAL LETTER ZA */
$config['0530_058f'][] = ['upper' => 1335, 'status' => 'C', 'lower' => [1383]]; /* ARMENIAN CAPITAL LETTER EH */
$config['0530_058f'][] = ['upper' => 1336, 'status' => 'C', 'lower' => [1384]]; /* ARMENIAN CAPITAL LETTER ET */
$config['0530_058f'][] = ['upper' => 1337, 'status' => 'C', 'lower' => [1385]]; /* ARMENIAN CAPITAL LETTER TO */
$config['0530_058f'][] = ['upper' => 1338, 'status' => 'C', 'lower' => [1386]]; /* ARMENIAN CAPITAL LETTER ZHE */
$config['0530_058f'][] = ['upper' => 1339, 'status' => 'C', 'lower' => [1387]]; /* ARMENIAN CAPITAL LETTER INI */
$config['0530_058f'][] = ['upper' => 1340, 'status' => 'C', 'lower' => [1388]]; /* ARMENIAN CAPITAL LETTER LIWN */
$config['0530_058f'][] = ['upper' => 1341, 'status' => 'C', 'lower' => [1389]]; /* ARMENIAN CAPITAL LETTER XEH */
$config['0530_058f'][] = ['upper' => 1342, 'status' => 'C', 'lower' => [1390]]; /* ARMENIAN CAPITAL LETTER CA */
$config['0530_058f'][] = ['upper' => 1343, 'status' => 'C', 'lower' => [1391]]; /* ARMENIAN CAPITAL LETTER KEN */
$config['0530_058f'][] = ['upper' => 1344, 'status' => 'C', 'lower' => [1392]]; /* ARMENIAN CAPITAL LETTER HO */
$config['0530_058f'][] = ['upper' => 1345, 'status' => 'C', 'lower' => [1393]]; /* ARMENIAN CAPITAL LETTER JA */
$config['0530_058f'][] = ['upper' => 1346, 'status' => 'C', 'lower' => [1394]]; /* ARMENIAN CAPITAL LETTER GHAD */
$config['0530_058f'][] = ['upper' => 1347, 'status' => 'C', 'lower' => [1395]]; /* ARMENIAN CAPITAL LETTER CHEH */
$config['0530_058f'][] = ['upper' => 1348, 'status' => 'C', 'lower' => [1396]]; /* ARMENIAN CAPITAL LETTER MEN */
$config['0530_058f'][] = ['upper' => 1349, 'status' => 'C', 'lower' => [1397]]; /* ARMENIAN CAPITAL LETTER YI */
$config['0530_058f'][] = ['upper' => 1350, 'status' => 'C', 'lower' => [1398]]; /* ARMENIAN CAPITAL LETTER NOW */
$config['0530_058f'][] = ['upper' => 1351, 'status' => 'C', 'lower' => [1399]]; /* ARMENIAN CAPITAL LETTER SHA */
$config['0530_058f'][] = ['upper' => 1352, 'status' => 'C', 'lower' => [1400]]; /* ARMENIAN CAPITAL LETTER VO */
$config['0530_058f'][] = ['upper' => 1353, 'status' => 'C', 'lower' => [1401]]; /* ARMENIAN CAPITAL LETTER CHA */
$config['0530_058f'][] = ['upper' => 1354, 'status' => 'C', 'lower' => [1402]]; /* ARMENIAN CAPITAL LETTER PEH */
$config['0530_058f'][] = ['upper' => 1355, 'status' => 'C', 'lower' => [1403]]; /* ARMENIAN CAPITAL LETTER JHEH */
$config['0530_058f'][] = ['upper' => 1356, 'status' => 'C', 'lower' => [1404]]; /* ARMENIAN CAPITAL LETTER RA */
$config['0530_058f'][] = ['upper' => 1357, 'status' => 'C', 'lower' => [1405]]; /* ARMENIAN CAPITAL LETTER SEH */
$config['0530_058f'][] = ['upper' => 1358, 'status' => 'C', 'lower' => [1406]]; /* ARMENIAN CAPITAL LETTER VEW */
$config['0530_058f'][] = ['upper' => 1359, 'status' => 'C', 'lower' => [1407]]; /* ARMENIAN CAPITAL LETTER TIWN */
$config['0530_058f'][] = ['upper' => 1360, 'status' => 'C', 'lower' => [1408]]; /* ARMENIAN CAPITAL LETTER REH */
$config['0530_058f'][] = ['upper' => 1361, 'status' => 'C', 'lower' => [1409]]; /* ARMENIAN CAPITAL LETTER CO */
$config['0530_058f'][] = ['upper' => 1362, 'status' => 'C', 'lower' => [1410]]; /* ARMENIAN CAPITAL LETTER YIWN */
$config['0530_058f'][] = ['upper' => 1363, 'status' => 'C', 'lower' => [1411]]; /* ARMENIAN CAPITAL LETTER PIWR */
$config['0530_058f'][] = ['upper' => 1364, 'status' => 'C', 'lower' => [1412]]; /* ARMENIAN CAPITAL LETTER KEH */
$config['0530_058f'][] = ['upper' => 1365, 'status' => 'C', 'lower' => [1413]]; /* ARMENIAN CAPITAL LETTER OH */
$config['0530_058f'][] = ['upper' => 1366, 'status' => 'C', 'lower' => [1414]]; /* ARMENIAN CAPITAL LETTER FEH */
