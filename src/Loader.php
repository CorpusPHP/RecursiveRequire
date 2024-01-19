<?php

namespace Corpus\RecursiveRequire;

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
	 * Trigger the require's
	 *
	 * @return array The result as a map of filename to return value.
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
