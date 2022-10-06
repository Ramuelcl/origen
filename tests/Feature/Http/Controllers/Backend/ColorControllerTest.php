<?php

namespace Tests\Feature\Http\Controllers\Backend;

use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Backend\ColorController
 */
class ColorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $colors = Color::factory()->count(3)->create();

        $response = $this->get(route('color.index'));

        $response->assertOk();
        $response->assertViewIs('color.index');
        $response->assertViewHas('colors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('color.create'));

        $response->assertOk();
        $response->assertViewIs('color.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Backend\ColorController::class,
            'store',
            \App\Http\Requests\Backend\ColorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('color.store'));

        $response->assertRedirect(route('color.index'));
        $response->assertSessionHas('color.id', $color->id);

        $this->assertDatabaseHas(colors, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $color = Color::factory()->create();

        $response = $this->get(route('color.show', $color));

        $response->assertOk();
        $response->assertViewIs('color.show');
        $response->assertViewHas('color');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $color = Color::factory()->create();

        $response = $this->get(route('color.edit', $color));

        $response->assertOk();
        $response->assertViewIs('color.edit');
        $response->assertViewHas('color');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Backend\ColorController::class,
            'update',
            \App\Http\Requests\Backend\ColorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $color = Color::factory()->create();

        $response = $this->put(route('color.update', $color));

        $color->refresh();

        $response->assertRedirect(route('color.index'));
        $response->assertSessionHas('color.id', $color->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $color = Color::factory()->create();

        $response = $this->delete(route('color.destroy', $color));

        $response->assertRedirect(route('color.index'));

        $this->assertModelMissing($color);
    }
}
