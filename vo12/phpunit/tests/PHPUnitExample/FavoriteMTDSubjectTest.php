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
        $subject = new FavoriteMTDSubject("Web Technologies");
        $this->assertEquals("The best subject in MTD is Web Technologies!", $subject->say());
    }

    /**
     * Tests, if the respondTo method outputs agreement if the subject matches.
     * @throws Exception
     */
    public function testRespondToInAgreement()
    {
        $subject = new FavoriteMTDSubject("Web Technologies");
        $opinion = "Web Technologies is the best!";

        $this->assertEquals("Absolutely true!", $subject->respondTo($opinion));
    }

    /**
     * Tests if the respondTo method throws an exception if the subject doesn't match.
     * @throws Exception
     */
    public function testRespondToInDisagreement()
    {
        $subject = new FavoriteMTDSubject("Web Technologies");
        $opinion = "I love Algorithmic Thinking!";

        $this->expectException(Exception::class);

        $subject->respondTo($opinion);
    }
}