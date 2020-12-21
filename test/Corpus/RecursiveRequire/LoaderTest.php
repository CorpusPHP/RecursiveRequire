<?php

namespace Corpus\RecursiveRequire;

use PHPUnit\Framework\TestCase;

class LoaderTest extends TestCase {

	public function test__invoke() : void {
		$loader = new Loader(__DIR__ . '/TestDir');

		$out = $loader();
		$this->assertEquals([
			__DIR__ . '/TestDir/file1.php'         => true,
			__DIR__ . '/TestDir/SubDir1/file2.php' => 'foo',
		], $out);
	}

	public function test__invoke_empty() : void {
		$loader = new Loader(__DIR__ . '/EmptyTestDir');

		$this->assertSame([], $loader());
	}

}
