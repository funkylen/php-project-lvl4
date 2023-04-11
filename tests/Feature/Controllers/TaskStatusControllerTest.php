<?php

namespace Tests\Feature\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        TaskStatus::factory()->count(10)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testEdit(): void
    {
        $this->actingAs(User::factory()->create());

        $model = TaskStatus::factory()->create();
        $response = $this->get(route('task_statuses.edit', $model));

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs(User::factory()->create());

        $body = TaskStatus::factory()->make()->toArray();
        $response = $this->post(route('task_statuses.store'), ['task_status' => $body]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', $body);
    }

    public function testUpdate(): void
    {
        $this->actingAs(User::factory()->create());

        $model = TaskStatus::factory()->create();
        $body = TaskStatus::factory()->make()->toArray();
        $response = $this->put(route('task_statuses.update', $model), ['task_status' => $body]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('task_statuses', [
            ...$model->toArray(),
            ...$body,
        ]);
    }

    public function testDestroy(): void
    {
        $this->actingAs(User::factory()->create());

        $model = TaskStatus::factory()->create();
        $response = $this->delete(route('task_statuses.destroy', $model));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('task_statuses', $model->toArray());
    }
}
