<?php
/**
 * This file has been @generated by a phing task by {@link BuildMetadataPHPFromXml}.
 * See [README.md](README.md#generating-data) for more information.
 *
 * Pull requests changing data in these files will not be accepted. See the
 * [FAQ in the README](README.md#problems-with-invalid-numbers] on how to make
 * metadata changes.
 *
 * Do not modify this file directly!
 */

return [
  'id' => '',
  'countryCode' => 31,
  'internationalPrefix' => '',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' => [
	0 => [
	  'pattern' => '([1-578]\\d)(\\d{4})(\\d{3})',
	  'format' => '$1 $2 $3',
	  'leadingDigitsPatterns' => [
		0 => '1[035]|2[0346]|3[03568]|4[0356]|5[0358]|7|8[4578]',
	  ],
	  'nationalPrefixFormattingRule' => '',
	  'domesticCarrierCodeFormattingRule' => '',
	  'nationalPrefixOptionalWhenFormatting' => false,
	],
	1 => [
	  'pattern' => '([1-5]\\d{2})(\\d{2})(\\d{2})(\\d{2})',
	  'format' => '$1 $2 $3 $4',
	  'leadingDigitsPatterns' => [
		0 => '1[16-8]|2[259]|3[124]|4[17-9]|5[124679]',
	  ],
	  'nationalPrefixFormattingRule' => '',
	  'domesticCarrierCodeFormattingRule' => '',
	  'nationalPrefixOptionalWhenFormatting' => false,
	],
  ],
  'intlNumberFormat' => [
  ],
  'mainCountryForCode' => false,
  'leadingZeroPossible' => false,
  'mobileNumberPortableRegion' => false,
];