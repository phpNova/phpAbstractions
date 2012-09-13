<?php

/**
 * PHP abstraction functions for common operations not natively aliased.  --Kris
 */

class Abstraction
{
	/**
	 * Convert seconds into an appropriate timespan value.
	 * 
	 * @param int $secs
	 *   The number of seconds being represented.
	 * 
	 * @param bool $include_zeroes
	 *   If set to TRUE, preceding units with 0 values will be included.
	 * 
	 * @return string
	 *   Returns the timespan.  For example, 65 seconds would return "1 minute 5 seconds."
	 */
	public static function timespan( $secs, $include_zeroes = FALSE )
	{
		/* We'll put these here so we only have to specify the formulas once.  --Kris */
		$secs_minute = 60;
		$secs_hour = pow( $secs_minute, 2 );
		$secs_day = $secs_hour * 24;
		$secs_week = $secs_day * 7;
		$secs_year = $secs_day * 365.25;
		
		/* Get the individual units.  --Kris */
		$years = floor( $secs / $secs_year );
		$weeks = floor( ($secs - ($years * $secs_year)) / $secs_week );
		$days = floor( ($secs - ($years * $secs_year) - ($weeks * $secs_week)) / $secs_day );
		$hours = floor( ($secs - ($years * $secs_year) - ($weeks * $secs_week) - ($days * $secs_day)) / $secs_hour );
		$minutes = floor( ($secs - ($years * $secs_year) - ($weeks * $secs_week) - ($days * $secs_day) - ($hours * $secs_hour)) / $secs_minute );
		$seconds = $secs - ($years * $secs_year) - ($weeks * $secs_week) - ($days * $secs_day) - ($hours * $secs_hour) - ($minutes * $secs_minute);
		
		/* Create the output string.  --Kris */
		$out = NULL;
		
		if ( $years > 0 
			|| $include_zeroes == TRUE )
		{
			$out .= $years . " year" . ( $years == 1 ? NULL : "s" ) . " ";
		}
		
		if ( $weeks > 0 
			|| $include_zeroes == TRUE )
		{
			$out .= $weeks . " week" . ( $weeks == 1 ? NULL : "s" ) . " ";
		}
		
		if ( $days > 0 
			|| $include_zeroes == TRUE )
		{
			$out .= $days . " day" . ( $days == 1 ? NULL : "s" ) . " ";
		}
		
		if ( $hours > 0 
			|| $include_zeroes == TRUE )
		{
			$out .= $hours . " hour" . ( $hours == 1 ? NULL : "s" ) . " ";
		}
		
		if ( $minutes > 0 
			|| $include_zeroes == TRUE )
		{
			$out .= $minutes . " minute" . ( $minutes == 1 ? NULL : "s" ) . " ";
		}
		
		if ( $seconds > 0 
			|| $include_zeroes == TRUE 
			|| $out == NULL )
		{
			$out .= $seconds . " second" . ( $seconds == 1 ? NULL : "s" );
		}
		
		return $out;
	}
	
	/**
	 * Recursively get all positions of specified string within specified string.
	 * 
	 * @param string $needle
	 *   What we're searching for.
	 * @param string $haystack
	 *   The string being searched.
	 * @param bool $case_sensitive
	 *   Whether or not the search is case-sensitive.
	 * @param int $offset
	 *   Where to begin the search.
	 * @param array $indexes
	 *   The indexes retrieved thus far.
	 * 
	 * @return array
	 *   A zero-indexed incremental array containing the index location(s) in ascending order.
	 */
	public static function strpos_recursive( $haystack, $needle, $case_sensitive = TRUE, $offset = 0, $indexes = array() )
	{
		$pos = ( $case == TRUE ? strpos( $haystack, $needle, $offset ) : stripos( $haystack, $needle, $offset ) );
		
		if ( $pos === FALSE )
		{
			return $indexes;
		}
		else
		{
			$indexes[] = $pos;
			
			return self::strpos_recursive( $haystack, $needle, $case, ($pos + 1), $indexes );
		}
	}
	
	/**
	 * Alias for strpos_recursive with $case_sensitive set to FALSE.
	 * 
	 * @param string $needle
	 *   See description for strpos_recursive.
	 * @param string $haystack
	 *   See description for strpos_recursive.
	 * @param int $offset
	 *   See description for strpos_recursive.
	 * 
	 * @return array
	 *   The value returned by strpos_recursive.
	 */
	public static function stripos_recursive( $haystack, $needle, $offset = 0 )
	{
		return self::strpos_recursive( $haystack, $needle, FALSE, $offset );
	}
	
	/**
	 * Convert foreign 8859-1 characters into HTML entities.
	 * 
	 * @param string $str
	 *   The string being parsed.
	 * 
	 * @return string
	 *   The converted string.
	 */
	public static function convert_chars_to_entities( $str )
	{
		$str = str_replace( 'À', '&#192;', $str );
		$str = str_replace( 'Á', '&#193;', $str );
		$str = str_replace( 'Â', '&#194;', $str );
		$str = str_replace( 'Ã', '&#195;', $str );
		$str = str_replace( 'Ä', '&#196;', $str );
		$str = str_replace( 'Å', '&#197;', $str );
		$str = str_replace( 'Æ', '&#198;', $str );
		$str = str_replace( 'Ç', '&#199;', $str );
		$str = str_replace( 'È', '&#200;', $str );
		$str = str_replace( 'É', '&#201;', $str );
		$str = str_replace( 'Ê', '&#202;', $str );
		$str = str_replace( 'Ë', '&#203;', $str );
		$str = str_replace( 'Ì', '&#204;', $str );
		$str = str_replace( 'Í', '&#205;', $str );
		$str = str_replace( 'Î', '&#206;', $str );
		$str = str_replace( 'Ï', '&#207;', $str );
		$str = str_replace( 'Ð', '&#208;', $str );
		$str = str_replace( 'Ñ', '&#209;', $str );
		$str = str_replace( 'Ò', '&#210;', $str );
		$str = str_replace( 'Ó', '&#211;', $str );
		$str = str_replace( 'Ô', '&#212;', $str );
		$str = str_replace( 'Õ', '&#213;', $str );
		$str = str_replace( 'Ö', '&#214;', $str );
		$str = str_replace( '×', '&#215;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris
		$str = str_replace( 'Ø', '&#216;', $str );
		$str = str_replace( 'Ù', '&#217;', $str );
		$str = str_replace( 'Ú', '&#218;', $str );
		$str = str_replace( 'Û', '&#219;', $str );
		$str = str_replace( 'Ü', '&#220;', $str );
		$str = str_replace( 'Ý', '&#221;', $str );
		$str = str_replace( 'Þ', '&#222;', $str );
		$str = str_replace( 'ß', '&#223;', $str );
		$str = str_replace( 'à', '&#224;', $str );
		$str = str_replace( 'á', '&#225;', $str );
		$str = str_replace( 'â', '&#226;', $str );
		$str = str_replace( 'ã', '&#227;', $str );
		$str = str_replace( 'ä', '&#228;', $str );
		$str = str_replace( 'å', '&#229;', $str );
		$str = str_replace( 'æ', '&#230;', $str );
		$str = str_replace( 'ç', '&#231;', $str );
		$str = str_replace( 'è', '&#232;', $str );
		$str = str_replace( 'é', '&#233;', $str );
		$str = str_replace( 'ê', '&#234;', $str );
		$str = str_replace( 'ë', '&#235;', $str );
		$str = str_replace( 'ì', '&#236;', $str );
		$str = str_replace( 'í', '&#237;', $str );
		$str = str_replace( 'î', '&#238;', $str );
		$str = str_replace( 'ï', '&#239;', $str );
		$str = str_replace( 'ð', '&#240;', $str );
		$str = str_replace( 'ñ', '&#241;', $str );
		$str = str_replace( 'ò', '&#242;', $str );
		$str = str_replace( 'ó', '&#243;', $str );
		$str = str_replace( 'ô', '&#244;', $str );
		$str = str_replace( 'õ', '&#245;', $str );
		$str = str_replace( 'ö', '&#246;', $str );
		$str = str_replace( '÷', '&#247;', $str );  // Yeah, I know.  But otherwise the gap is confusing.  --Kris
		$str = str_replace( 'ø', '&#248;', $str );
		$str = str_replace( 'ù', '&#249;', $str );
		$str = str_replace( 'ú', '&#250;', $str );
		$str = str_replace( 'û', '&#251;', $str );
		$str = str_replace( 'ü', '&#252;', $str );
		$str = str_replace( 'ý', '&#253;', $str );
		$str = str_replace( 'þ', '&#254;', $str );
		$str = str_replace( 'ÿ', '&#255;', $str );
		
		return $str;
	}
	
	/**
	 * Recursively delete all files/subdirectories in a given path.
	 * 
	 * @param string $dir
	 *   The directory whose contents are to be deleted.
	 * @param bool $preserve
	 *   (optional) If TRUE, the contents of $dir will be deleted but $dir itself will not.
	 *   If FALSE, both the contents of $dir and $dir itself will be deleted.
	 * 
	 * @return bool
	 *   TRUE on success, FALSE on failure.
	 */
	public static function rmdir( $dir, $preserve = FALSE )
	{
		if ( !is_dir( $dir ) )
		{
			return TRUE;
		}
		
		$contents = array_diff( scandir( $dir ), array( '.', '..' ) );
		
		$success = TRUE;
		foreach ( $contents as $fso )
		{
			$fso = realpath( $dir . '/' . $fso );
			
			if ( is_dir( $fso ) )
			{
				if ( !self::rmdir( $fso ) )
				{
					$success = FALSE;
				}
			}
			else if ( is_file( $fso ) )
			{
				if ( !unlink( $fso ) )
				{
					$success = FALSE;
				}
			}
			else
			{
				self::error( "Unknown FSO type for '$fso'!", __METHOD__ );
				
				$success = FALSE;
			}
		}
		
		if ( $preserve == FALSE )
		{
			if ( !rmdir( $dir ) )
			{
				$success = FALSE;
			}
		}
		
		return $success;
	}
	
	/**
	 * Handy little function for retrieving a PHP constant name by value.
	 * 
	 * @param mixed $value
	 *   The value of the constant whose name you're looking for.
	 * @param string $category
	 *   (optional) If specified, the function will only look for constants that fall 
	 *   under the category as described at http://www.php.net/get_defined_constants.
	 * 
	 * @return mixed
	 *   If one matching constant is found, the name is returned as a string.
	 *   If multiple matches are found, the names are returned as a zero-indexed array of strings.
	 *   If no matches are found, return FALSE.
	 */
	public static function get_constant_by_value( $value, $category = NULL )
	{
		$results = array();
		if ( $category == NULL )
		{
			foreach ( get_defined_constants( FALSE ) as $name => $val )
			{
				if ( $val == $value )
				{
					$results[] = $name;
				}
			}
		}
		else
		{
			foreach ( get_defined_constants( TRUE ) as $cat => $constants )
			{
				if ( strcmp( $cat, $category ) == 0 )
				{
					foreach ( $constants as $name => $val )
					{
						if ( $val == $value )
						{
							$results[] = $name;
						}
					}
				}
			}
		}
		
		if ( empty( $results ) )
		{
			$results = FALSE;
		}
		else if ( count( $results ) == 1 )
		{
			$results = $results[0];
		}
		
		return $results;
	}
	
	/**
	 * Log an error from an Abstract function.
	 * 
	 * This function is only intended for use by other methods within the Abstract class!
	 * Change the code to tie-in with whatever framework you're using, if applicable.
	 * 
	 * @param string $error
	 *   The error message.
	 * @param string $method
	 *   (optional) The method in which the error occurred.
	 * @param int $severity
	 *   (optional) The severity of the error.  Corresponds to PHP E_* error constants.
	 * @param int $newline
	 *   (optional) If > 0, append $newline line breaks at the end of the error message.
	 * 
	 * @return bool
	 *   TRUE on success, FALSE on failure.
	 */
	private static function error( $error, $method = NULL, $severity = E_RECOVERABLE_ERROR, $newline = 1 )
	{
		$errtype = self::get_constant_by_value( $severity, "Core" );
		
		if ( is_array( $errtype ) )
		{
			$newtype = NULL;
			foreach ( $errtype as $type )
			{
				if ( strcmp( substr( $type, 0, 2 ), "E_" ) )
				{
					continue;
				}
				
				if ( $newtype != NULL )
				{
					$newtype .= ' && ';
				}
				
				$newtype .= $type;
			}
			
			$errtype = $newtype;
		}
		else if ( strcmp( substr( $errtype, 0, 2 ), "E_" ) )
		{
			$errtype = "UNKNOWN";
		}
		
		$errmsg = "(" . $errtype . ") : $error" . ( $method != NULL ? " $method" : NULL );
		
		for ( $i = 1; $i <= $newline; $i++ )
		{
			if ( strcasecmp( php_sapi_name(), "cli" ) == 0 )
			{
				$errmsg .= "\r\n";
			}
			else
			{
				$errmsg .= "<br />";
			}
		}
		
		print $errmsg;
		
		return TRUE;
	}
	
	/**
	 * Return a recursive directory tree as an array.
	 * 
	 * @param string $dir
	 *   The directory being scanned.
	 * @param mixed $relative
	 *   (optional)	If TRUE, convert all paths from absolute to relative.
	 *   		If FALSE, all paths are absolute.
	 * 		If 2, there will be duplicate entries; one absolute, the other relative.
	 * 
	 * @return array
	 *   Each array represents a directory.  Strings represent files.  For exmple:
	 * 
	 *   array( 
	 *   	[0] => string $file1, 
	 *   	[1] => string $file2, 
	 *   	[string $dir1] => array( 
	 * 		[0] => string $file1, 
	 *   		[string $dir1] => array( .... ) 
	 *   	), 
	 *   	[2] => string $file3, 
	 *   	[string $dir2] => array( .... ) 
	 *   )
	 */
	public static function tree( $dir, $relative = FALSE, $exclude = array() )
	{
		$contents = array_diff( scandir( $dir ), array( '.', '..' ) );
		
		$tree = array();
		foreach ( $contents as $fso )
		{
			if ( in_array( basename( $fso ), $exclude ) )
			{
				continue;
			}
			
			$fso = realpath( $dir . '/' . $fso );
			
			$path = ( $relative != FALSE ? basename( $fso ) : $fso );
			if ( is_dir( $fso ) )
			{
				$tree[$path] = self::tree( $fso, $relative, $exclude );
			}
			else if ( is_file( $fso ) )
			{
				$tree[] = $path;
			}
			else
			{
				self::error( "Unknown FSO type for '$fso'!", __METHOD__ );
			}
		}
		
		if ( $relative == 2 )
		{
			$tree2 = array();
			foreach ( $contents as $fso )
			{
				if ( in_array( basename( $fso ), $exclude ) )
				{
					continue;
				}
				
				$fso = realpath( $dir . '/' . $fso );
				
				if ( is_dir( $fso ) )
				{
					$tree2[$fso] = self::tree( $fso, $relative, $exclude );
				}
				else if ( is_file( $fso ) )
				{
					$tree2[] = $fso;
				}
				else
				{
					self::error( "Unknown FSO type for '$fso'!", __METHOD__ );
				}
			}
			
			$tree = array( "ABSOLUTE" => $tree2, "RELATIVE" => $tree );
		}
		
		return $tree;
	}
	
	/**
	 * Add a file to a ZIP archive.
	 * 
	 * @param string $file
	 *   The file being zipped.
	 * @param string $topdir
	 *   The top-level directory in the zip.
	 * @param string $location
	 *   The filename as it will appear in the zip.
	 * @param mixed $zip
	 *   The object instance of ZipArchive.  If FALSE, create one.
	 * @param string $outfile
	 *   The path to the zip file being created.
	 */
	public static function zip_file( $file, $topdir = '/', $location = NULL, $zip = FALSE, $outfile = NULL )
	{
		if ( $location == NULL )
		{
			$location = $file;
		}
		
		$location = str_replace( $topdir, NULL, $location );
		
		if ( $zip === FALSE )
		{
			if ( $outfile == NULL )
			{
				$outfile = microtime( TRUE ) . ".zip";
			}
			
			$zip = new ZipArchive();
			if ( $zip->open( $outfile, ZIPARCHIVE::CREATE ) !== TRUE )
			{
				self::error( "Unable to create ZIP file '$outfile'!", __METHOD__ );
				
				return FALSE;
			}
		}
		
		$zip->addFile( $file, $location );
		
		return $zip;
	}
	
	/**
	 * Compress the contents of a directory into a ZIP file.
	 * 
	 * @param string $dir
	 *   The directory being zipped.
	 * @param string $topdir
	 *   The top-level directory in the zip.
	 * @param mixed $zip
	 *   The object instance of ZipArchive.  If FALSE, create one.
	 * @param string $outfile
	 *   The path to the zip file being created.
	 */
	public static function zip_dir( $dir, $topdir = '/', $zip = FALSE, $outfile = NULL )
	{
		if ( $outfile == NULL )
		{
			$outfile = microtime( TRUE ) . ".zip";
		}
		
		if ( !is_dir( $dir ) )
		{
			self::error( "'$dir' is not a directory!", __METHOD__ );
			
			return FALSE;
		}
		
		if ( $zip === FALSE )
		{
			if ( $outfile == NULL )
			{
				$outfile = microtime( TRUE ) . ".zip";
			}
			
			$zip = new ZipArchive();
			if ( $zip->open( $outfile, ZIPARCHIVE::CREATE ) !== TRUE )
			{
				self::error( "Unable to create ZIP file '$outfile'!", __METHOD__ );
				
				return FALSE;
			}
		}
		
		$location = str_replace( $topdir, NULL, $dir );
		
		$tree = self::tree( $dir, FALSE, array( ".git" ) );
		
		foreach ( $tree as $key => $fso )
		{
			if ( is_array( $fso ) )
			{
				$zip->addEmptyDir( str_replace( $topdir, NULL, $key ) ) or self::error( "Directory add for '$key' failed!", __METHOD__ );
				
				$zip = self::zip_dir( $key, $topdir, $zip, $outfile );
			}
			else
			{
				$zip = self::zip_file( $fso, $topdir, NULL, $zip, $outfile );
			}
		}
		
		return $zip;
	}
}
