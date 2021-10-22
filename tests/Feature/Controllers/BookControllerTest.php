<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Book;

use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_books()
    {
        $books = Book::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('books.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.books.index')
            ->assertViewHas('books');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_book()
    {
        $response = $this->get(route('books.create'));

        $response->assertOk()->assertViewIs('app.books.create');
    }

    /**
     * @test
     */
    public function it_stores_the_book()
    {
        $data = Book::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('books.store'), $data);

        unset($data['category_id']);

        $this->assertDatabaseHas('books', $data);

        $book = Book::latest('id')->first();

        $response->assertRedirect(route('books.edit', $book));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_book()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('books.show', $book));

        $response
            ->assertOk()
            ->assertViewIs('app.books.show')
            ->assertViewHas('book');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_book()
    {
        $book = Book::factory()->create();

        $response = $this->get(route('books.edit', $book));

        $response
            ->assertOk()
            ->assertViewIs('app.books.edit')
            ->assertViewHas('book');
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

        $response = $this->put(route('books.update', $book), $data);

        unset($data['category_id']);

        $data['id'] = $book->id;

        $this->assertDatabaseHas('books', $data);

        $response->assertRedirect(route('books.edit', $book));
    }

    /**
     * @test
     */
    public function it_deletes_the_book()
    {
        $book = Book::factory()->create();

        $response = $this->delete(route('books.destroy', $book));

        $response->assertRedirect(route('books.index'));

        $this->assertDeleted($book);
    }
}
