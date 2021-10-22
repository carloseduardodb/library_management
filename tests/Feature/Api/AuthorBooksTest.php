<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Book;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorBooksTest extends TestCase
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
    public function it_gets_author_books()
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create();

        $author->books()->attach($book);

        $response = $this->getJson(route('api.authors.books.index', $author));

        $response->assertOk()->assertSee($book->name);
    }

    /**
     * @test
     */
    public function it_can_attach_books_to_author()
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create();

        $response = $this->postJson(
            route('api.authors.books.store', [$author, $book])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $author
                ->books()
                ->where('books.id', $book->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_books_from_author()
    {
        $author = Author::factory()->create();
        $book = Book::factory()->create();

        $response = $this->deleteJson(
            route('api.authors.books.store', [$author, $book])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $author
                ->books()
                ->where('books.id', $book->id)
                ->exists()
        );
    }
}
