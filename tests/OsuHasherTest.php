<?php

class OsuHasherTest extends PHPUnit_Framework_TestCase {

	public $password = "password";
	public $badPassword = "frankenstein";

	public function __construct() {
		$this->hasher = new hiro\Hashing\OsuHasher;
		$this->hash = $this->hasher->make($this->password);
	}

	public function testMutates() {
		$this->assertTrue($this->hash !== $this->password);
	}

	public function testBcryptIdentifier() {
		$this->assertTrue(strpos($this->hash, "$2a$") === 0);
	}

	public function testValidates() {
		$this->assertTrue(strlen($this->hash) == 60);
	}

	public function testFail() {
		$this->assertFalse($this->hasher->check($this->badPassword, $this->hash));
	}

	public function testRehash() {
		$hash = $this->hasher->make($this->password, ["cost" => 8]);
		$this->assertTrue($this->hasher->needsRehash($hash));
	}

	public function testNoRehash() {
		$this->assertFalse($this->hasher->needsRehash($this->hash));
	}

}
