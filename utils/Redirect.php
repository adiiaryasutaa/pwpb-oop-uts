<?php 

/**
 * 
 * 
 */
class Redirect
{

	/**
	 * 
	 * 
	 */
	public static function to(string $uri): void
	{
		header("Location: $uri");
		exit();
	}

	/**
	 * 
	 * 
	 */
	public static function toIf(bool $bool, string $uri): void
	{
		if ($bool) static::to($uri);
	}
}


?>