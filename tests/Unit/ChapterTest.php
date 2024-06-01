<?php

namespace Tests\Unit;

use App\Models\Chapter;
use PHPUnit\Framework\TestCase;

class ChapterTest extends TestCase
{
    /**
     * Test the toSearchableArray method.
     *
     * @return void
     */
    public function testToSearchableArray()
    {
        // Create a Chapter instance
        $chapter = new Chapter();
        $chapter->id = 1;
        $chapter->name = 'Test Chapter';

        // Call the toSearchableArray method
        $searchableArray = $chapter->toSearchableArray();

        // Assert the array structure and values
        $this->assertIsArray($searchableArray);
        $this->assertArrayHasKey('id', $searchableArray);
        $this->assertArrayHasKey('name', $searchableArray);
        $this->assertEquals(1, $searchableArray['id']);
        $this->assertEquals('Test Chapter', $searchableArray['name']);
    }
}
