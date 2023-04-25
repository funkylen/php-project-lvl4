<?php

namespace Tests\Feature\Controllers;

use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Task::factory()->count(10)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testEdit(): void
    {
        $this->actingAs(User::factory()->create());

        $model = Task::factory()->create();
        $response = $this->get(route('tasks.edit', $model));

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs(User::factory()->create());

        $body = Task::factory()->make()->only('description', 'name', 'assigned_to_id', 'status_id');
        $response = $this->post(route('tasks.store'), $body);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', $body);
    }

    public function testUpdate(): void
    {
        $this->actingAs(User::factory()->create());

        $model = Task::factory()->create();
        $body = Task::factory()->make()->only('description', 'name', 'assigned_to_id', 'status_id');
        $response = $this->put(route('tasks.update', $model), $body);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('tasks', [
            ...$model->toArray(),
            ...$body,
        ]);
    }

    public function testDestroy(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $model = Task::factory()->create(['created_by_id' => $user->id]);
        $response = $this->delete(route('tasks.destroy', $model));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('tasks', $model->toArray());
    }
}
