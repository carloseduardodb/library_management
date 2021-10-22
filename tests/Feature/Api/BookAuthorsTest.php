<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookAuthorsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_book_authors()
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();

        $book->authors()->attach($author);

        $response = $this->getJson(route('api.books.authors.index', $book));

        $response->assertOk()->assertSee($author->name);
    }

    /**
     * @test
     */
    public function it_can_attach_authors_to_book()
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();

        $response = $this->postJson(
            route('api.books.authors.store', [$book, $author])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $book
                ->authors()
                ->where('authors.id', $author->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_authors_from_book()
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();

        $response = $this->deleteJson(
            route('api.books.authors.store', [$book, $author])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $book
                ->authors()
                ->where('authors.id', $author->id)
                ->exists()
        );
    }
}
