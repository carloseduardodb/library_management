<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Author;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorControllerTest extends TestCase
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
    public function it_displays_index_view_with_authors()
    {
        $authors = Author::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('authors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.index')
            ->assertViewHas('authors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_author()
    {
        $response = $this->get(route('authors.create'));

        $response->assertOk()->assertViewIs('app.authors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_author()
    {
        $data = Author::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('authors.store'), $data);

        $this->assertDatabaseHas('authors', $data);

        $author = Author::latest('id')->first();

        $response->assertRedirect(route('authors.edit', $author));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_author()
    {
        $author = Author::factory()->create();

        $response = $this->get(route('authors.show', $author));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.show')
            ->assertViewHas('author');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_author()
    {
        $author = Author::factory()->create();

        $response = $this->get(route('authors.edit', $author));

        $response
            ->assertOk()
            ->assertViewIs('app.authors.edit')
            ->assertViewHas('author');
    }

    /**
     * @test
     */
    public function it_updates_the_author()
    {
        $author = Author::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'age' => $this->faker->randomNumber(0),
            'gender' => array_rand(array_flip(['male', 'female', 'other']), 1),
        ];

        $response = $this->put(route('authors.update', $author), $data);

        $data['id'] = $author->id;

        $this->assertDatabaseHas('authors', $data);

        $response->assertRedirect(route('authors.edit', $author));
    }

    /**
     * @test
     */
    public function it_deletes_the_author()
    {
        $author = Author::factory()->create();

        $response = $this->delete(route('authors.destroy', $author));

        $response->assertRedirect(route('authors.index'));

        $this->assertDeleted($author);
    }
}
