<?php

use Dream\SeoID;

class SeoIDTest extends PHPUnit_Framework_TestCase
{
	
    public function testBuild()
    {
        $this->assertEquals(
			"123",
			SeoID::build(123)
		);
		
        $this->assertEquals(
			"123-foo-bar",
			SeoID::build(123, 'foo', 'bar')
		);
		
        $this->assertEquals(
			"123-foo-bar-69",
			SeoID::build(123, 'Foo', 'BAR', '69')
		);
		
        $this->assertEquals(
			"123-foo-b-r-eurxxx", // "a" is skipped due to stopwords!
			SeoID::build(123, 'foo', 'B A  R' . "\n" . '%€"#$&@/.;,()XXX')
		);
		
        $this->assertEquals(
			"123-foo-bar-oaou",
			SeoID::build(123, 'foo', 'bar', 'õäöü')
		);
		
    }
	
    public function testParse()
    {
        $this->assertEquals(
			123,
			SeoID::parse('123')
		);
		
        $this->assertEquals(
			123,
			SeoID::parse('123-foo-b-r-eurxxx')
		);
		
    }
	
}