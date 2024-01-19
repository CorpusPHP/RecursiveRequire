<?php

namespace Corpus\RecursiveRequire;

/**
 * Helper to recursively require all PHP files in a directory
 */
class Loader {

	protected string $path;
	protected bool $once;

	/**
	 * @param string $path Root path to recursively require
	 * @param bool   $once Whether to use `require_once` instead of `require`
	 */
	public function __construct( string $path, bool $once = false ) {
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
		$this->once = $once;
	}

	/**
	 * Trigger the `require`(s)
	 *
	 * Note: The order in which files are required is not guaranteed.
	 * It will vary based on the Operating System and filesystem.
	 * Do not rely on the order in which files are required.
	 *
	 * @param string $regex A regex to filter the files to require
	 * @return array<string,mixed> The result as a map of filename to return value.
	 */
	public function __invoke( string $regex = "/\\.php$/" ) : array {
		$output = [];

		$dir   = new \RecursiveDirectoryIterator($this->path);
		$ite   = new \RecursiveIteratorIterator($dir);
		$files = new \RegexIterator($ite, $regex);

		foreach( $files as $file ) {
			$output[(string)$file] = $this->once ? (require_once $file) : (require $file);
		}

		return $output;
	}

}
