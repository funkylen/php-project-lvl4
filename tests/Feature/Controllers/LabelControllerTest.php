<?php

namespace Tests\Feature\Controllers;

use App\Models\Label;
use App\Models\User;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Label::factory()->count(10)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function testEdit(): void
    {
        $this->actingAs(User::factory()->create());

        $model = Label::factory()->create();
        $response = $this->get(route('labels.edit', $model));

        $response->assertOk();
    }

    public function testCreate(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('labels.create'));

        $response->assertOk();
    }

    public function testStore(): void
    {
        $this->actingAs(User::factory()->create());

        $body = Label::factory()->make()->toArray();
        $response = $this->post(route('labels.store'), ['label' => $body]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', $body);
    }

    public function testUpdate(): void
    {
        $this->actingAs(User::factory()->create());

        $model = Label::factory()->create();
        $body = Label::factory()->make()->toArray();
        $response = $this->put(route('labels.update', $model), ['label' => $body]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('labels', [
            ...$model->toArray(),
            ...$body,
        ]);
    }

    public function testDestroy(): void
    {
        $this->actingAs(User::factory()->create());

        $model = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $model));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseMissing('labels', $model->toArray());
    }
}
