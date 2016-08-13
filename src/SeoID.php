<?php

namespace Dream;

class SeoID {
	
	private static $_stopwords = [
		'I','a','about','an','are','as','at','be','by','com','for','from',
		'how','in','is','it','of','on','or','that','the','this','to','was',
		'what','when','where','who','will','with','the','www',
	];
	
	
	/**
	 * Accepts a numeric ID an some additional data to
	 * combine into a "SEO-friendly" ID.
	 * 
	 * @param int $seoID
	 * @param string $extra A variable number of additional strings to combine into the final ID.
	 * @return string the "SEO friendly" ID
	 */
	
	public static function build($ID, ...$extra) {

		if (!is_int($ID)) {
			throw new InvalidArgumentException('The ID should be an integer.');
		}
		
		foreach ($extra as $e) {
			if (!is_string($e)) {
				throw new InvalidArgumentException('Only expecting a variadic set of strings');
			}
		}
		
		// Implode variadic args in order
		$extra = implode(' ', $extra);
		
		// Replace all whitespace with single spaces that
		// we can later use for tokenization
		$extra = preg_replace('/\s+/', ' ', trim($extra));

		if (!empty($extra)) {
			
			// Get rid of strange chars
			// Relies on setlocale(LC_ALL, 'en_GB.UTF8'); in Bootstrap
			$extra = iconv('UTF-8', 'ASCII//TRANSLIT', $extra);
			
			// Also get rid of all other puntucation etc..
			// NB! notice the space!
			$extra = preg_replace('/[^a-zA-Z0-9 ]/', '', $extra);
			
			// Lower case always
			$extra = strtolower($extra);

			// Tokenize
			$extra = explode(' ', $extra);

			// Filter stopwords
			$extra = array_diff($extra, self::$_stopwords);
			
			$extra = '-' . implode('-', $extra);
			
		}

		return ((int) $ID) . $extra;

	}
	
	/**
	 * Take a "SEO-friendly ID" along the lines of
	 * 123-awesome-product and parses out the original
	 * ID (In this case 123).
	 * 
	 * @param string $seoID
	 * @return int Original ID
	 */
	
	public static function parse($seoID) {
		
		if (!is_string($seoID)) {
			throw new InvalidArgumentException('The SEO ID should be a string');
		}
			
		// Get the ID from the beginning of the SEO crap
		$seoID = substr($seoID, 0, strspn($seoID, '0123456789'));
		
		if (empty($seoID) || !ctype_digit($seoID)) {
			return NULL;
		}
		
		return (int) $seoID;
		
	}
  
}