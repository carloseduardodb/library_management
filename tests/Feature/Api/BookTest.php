<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Book;

use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
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
    public function it_gets_books_list()
    {
        $books = Book::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.books.index'));

        $response->assertOk()->assertSee($books[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_book()
    {
        $data = Book::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.books.store'), $data);

        unset($data['category_id']);

        $this->assertDatabaseHas('books', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_book()
    {
        $book = Book::factory()->create();

        $category = Category::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'pagecount' => $this->faker->randomNumber(0),
            'category' => $this->faker->randomNumber(0),
            'authors' => $this->faker->randomNumber(0),
            'category_id' => $category->id,
        ];

        $response = $this->putJson(route('api.books.update', $book), $data);

        unset($data['category_id']);

        $data['id'] = $book->id;

        $this->assertDatabaseHas('books', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson(route('api.books.destroy', $book));

        $this->assertDeleted($book);

        $response->assertNoContent();
    }
}
