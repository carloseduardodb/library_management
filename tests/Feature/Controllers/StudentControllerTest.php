<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Student;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentControllerTest extends TestCase
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
    public function it_displays_index_view_with_students()
    {
        $students = Student::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('students.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.students.index')
            ->assertViewHas('students');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_student()
    {
        $response = $this->get(route('students.create'));

        $response->assertOk()->assertViewIs('app.students.create');
    }

    /**
     * @test
     */
    public function it_stores_the_student()
    {
        $data = Student::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('students.store'), $data);

        $this->assertDatabaseHas('students', $data);

        $student = Student::latest('id')->first();

        $response->assertRedirect(route('students.edit', $student));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_student()
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.show', $student));

        $response
            ->assertOk()
            ->assertViewIs('app.students.show')
            ->assertViewHas('student');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_student()
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.edit', $student));

        $response
            ->assertOk()
            ->assertViewIs('app.students.edit')
            ->assertViewHas('student');
    }

    /**
     * @test
     */
    public function it_updates_the_student()
    {
        $student = Student::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'birth_date' => $this->faker->date,
            'gender' => array_rand(array_flip(['male', 'female', 'other']), 1),
        ];

        $response = $this->put(route('students.update', $student), $data);

        $data['id'] = $student->id;

        $this->assertDatabaseHas('students', $data);

        $response->assertRedirect(route('students.edit', $student));
    }

    /**
     * @test
     */
    public function it_deletes_the_student()
    {
        $student = Student::factory()->create();

        $response = $this->delete(route('students.destroy', $student));

        $response->assertRedirect(route('students.index'));

        $this->assertDeleted($student);
    }
}
