<?php

namespace PHPUnitExample;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Test class for FavoriteMTDSubject
 * @package PHPUnitExample
 */
class FavoriteMTDSubjectTest extends TestCase
{
    /**
     * Tests if the constructor throws an InvalidArgumentException when the argument is an empty string
     * @return void
     */
    public function testConstructorThrowsExceptionOnEmptyFavoriteSubject()
    {
        $this->expectException(InvalidArgumentException::class);
        new FavoriteMTDSubject("");
    }

    /**
     * Tests if the say method outputs the correct string.
     */
    public function testSayFavoriteSubject()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $this->assertEquals("The best subject in MTD is Hypermedia 2!", $subject->say());
    }

    /**
     * Tests, if the respondTo methods outputs agreement if the subject matches.
     * @throws Exception
     */
    public function testRespondToInAgreement()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $opinion = "Hypermedia 2 is the best!";

        $this->assertEquals("Absolutely true!", $subject->respondTo($opinion));
    }

    /**
     * Tests if the respondTo method throws an exception if the subject doesn't match.
     * @throws Exception
     */
    public function testRespondToInDisagreement()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $opinion = "I love Media Technology 2!";

        $this->expectException(Exception::class);

        $subject->respondTo($opinion);
    }
}