<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Borrow;

use App\Models\Book;
use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BorrowControllerTest extends TestCase
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
    public function it_displays_index_view_with_borrows()
    {
        $borrows = Borrow::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('borrows.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.borrows.index')
            ->assertViewHas('borrows');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_borrow()
    {
        $response = $this->get(route('borrows.create'));

        $response->assertOk()->assertViewIs('app.borrows.create');
    }

    /**
     * @test
     */
    public function it_stores_the_borrow()
    {
        $data = Borrow::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('borrows.store'), $data);

        unset($data['taken_date']);
        unset($data['brought_date']);

        $this->assertDatabaseHas('borrows', $data);

        $borrow = Borrow::latest('id')->first();

        $response->assertRedirect(route('borrows.edit', $borrow));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_borrow()
    {
        $borrow = Borrow::factory()->create();

        $response = $this->get(route('borrows.show', $borrow));

        $response
            ->assertOk()
            ->assertViewIs('app.borrows.show')
            ->assertViewHas('borrow');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_borrow()
    {
        $borrow = Borrow::factory()->create();

        $response = $this->get(route('borrows.edit', $borrow));

        $response
            ->assertOk()
            ->assertViewIs('app.borrows.edit')
            ->assertViewHas('borrow');
    }

    /**
     * @test
     */
    public function it_updates_the_borrow()
    {
        $borrow = Borrow::factory()->create();

        $book = Book::factory()->create();
        $student = Student::factory()->create();

        $data = [
            'taken_date' => $this->faker->dateTime,
            'brought_date' => $this->faker->dateTime,
            'book_id' => $book->id,
            'student_id' => $student->id,
        ];

        $response = $this->put(route('borrows.update', $borrow), $data);

        unset($data['taken_date']);
        unset($data['brought_date']);

        $data['id'] = $borrow->id;

        $this->assertDatabaseHas('borrows', $data);

        $response->assertRedirect(route('borrows.edit', $borrow));
    }

    /**
     * @test
     */
    public function it_deletes_the_borrow()
    {
        $borrow = Borrow::factory()->create();

        $response = $this->delete(route('borrows.destroy', $borrow));

        $response->assertRedirect(route('borrows.index'));

        $this->assertDeleted($borrow);
    }
}
