<?php

use App\Models\Chapter;
use App\Repositories\ChapterRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChapterRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $chapterRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->chapterRepository = new ChapterRepository(new Chapter());
    }

    public function testAll()
    {
        Chapter::factory()->count(3)->create();
        $chapters = $this->chapterRepository->all();
        $this->assertCount(3, $chapters);
    }

    public function testFind()
    {
        $chapter = Chapter::factory()->create();
        $foundChapter = $this->chapterRepository->find($chapter->id);
        $this->assertNotNull($foundChapter);
        $this->assertEquals($chapter->id, $foundChapter->id);
    }

    public function testCreate()
    {
        $data = ['name' => 'New Chapter'];
        $chapter = $this->chapterRepository->create($data);
        $this->assertInstanceOf(Chapter::class, $chapter);
        $this->assertEquals('New Chapter', $chapter->name);
    }

    public function testUpdate()
    {
        $chapter = Chapter::factory()->create();
        $data = ['name' => 'Updated Chapter'];
        $updatedChapter = $this->chapterRepository->update($chapter->id, $data);
        $this->assertNotNull($updatedChapter);
        $this->assertEquals('Updated Chapter', $updatedChapter->name);
    }

    public function testDelete()
    {
        $chapter = Chapter::factory()->create();
        $result = $this->chapterRepository->delete($chapter->id);
        $this->assertTrue($result);
        $this->assertNull(Chapter::find($chapter->id));
    }
}
