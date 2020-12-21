<?php

namespace Corpus\RecursiveRequire;

class Loader {

	/** @var string */
	protected $path;

	/**
	 * @param string $path Root path
	 */
	public function __construct( string $path ) {
		$this->path = rtrim($path, DIRECTORY_SEPARATOR);
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
			$output[(string)$file] = require $file;
		}

		return $output;
	}

}
