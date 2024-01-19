<?php

namespace Corpus\RecursiveRequire;

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class LoaderTest extends TestCase {

	private const NO_RETURN = 1;
	private const ALREADY_LOADED = true;

	public function test__invoke() : void {
		$loader = new Loader(__DIR__ . '/TestDir');

		$out = $loader();
		$this->assertSame([
			__DIR__ . '/TestDir/file1.php'                         => self::NO_RETURN,
			__DIR__ . '/TestDir/SubDir1/SubDir2/SubDir3/file4.php' => 'IV',
			__DIR__ . '/TestDir/SubDir1/SubDir2/file3.php'         => 'three',
			__DIR__ . '/TestDir/SubDir1/file2.php'                 => 'foo',
		], $out);
	}

	public function test__invoke_empty() : void {
		$loader = new Loader(__DIR__ . '/EmptyTestDir');

		$this->assertSame([], $loader());
	}

	public function testOnce() : void {
		$loader = new Loader(__DIR__ . '/TestDir', true);

		require_once __DIR__ . '/TestDir/SubDir1/SubDir2/SubDir3/file4.php';

		$data = [
			__DIR__ . '/TestDir/file1.php'                         => self::NO_RETURN,
			__DIR__ . '/TestDir/SubDir1/file2.php'                 => 'foo',
			__DIR__ . '/TestDir/SubDir1/SubDir2/SubDir3/file4.php' => self::ALREADY_LOADED,
			__DIR__ . '/TestDir/SubDir1/SubDir2/file3.php'         => 'three',
		];
		ksort($data);

		$result = $loader();
		ksort($result);
		$this->assertSame($data, $result);

		$data = [
			__DIR__ . '/TestDir/file1.php'                         => self::ALREADY_LOADED,
			__DIR__ . '/TestDir/SubDir1/file2.php'                 => self::ALREADY_LOADED,
			__DIR__ . '/TestDir/SubDir1/SubDir2/SubDir3/file4.php' => self::ALREADY_LOADED,
			__DIR__ . '/TestDir/SubDir1/SubDir2/file3.php'         => self::ALREADY_LOADED,
		];
		ksort($data);

		$result = $loader();
		ksort($result);
		$this->assertSame($data, $result);
	}

}
