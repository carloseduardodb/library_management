<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Borrow;

use App\Models\Book;
use App\Models\Student;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BorrowTest extends TestCase
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
    public function it_gets_borrows_list()
    {
        $borrows = Borrow::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.borrows.index'));

        $response->assertOk()->assertSee($borrows[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_borrow()
    {
        $data = Borrow::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.borrows.store'), $data);

        unset($data['taken_date']);
        unset($data['brought_date']);

        $this->assertDatabaseHas('borrows', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.borrows.update', $borrow), $data);

        unset($data['taken_date']);
        unset($data['brought_date']);

        $data['id'] = $borrow->id;

        $this->assertDatabaseHas('borrows', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_borrow()
    {
        $borrow = Borrow::factory()->create();

        $response = $this->deleteJson(route('api.borrows.destroy', $borrow));

        $this->assertDeleted($borrow);

        $response->assertNoContent();
    }
}
