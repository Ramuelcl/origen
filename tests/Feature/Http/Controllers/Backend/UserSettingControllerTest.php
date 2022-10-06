<?php

namespace Tests\Feature\Http\Controllers\Backend;

use App\Models\UserSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Backend\UserSettingController
 */
class UserSettingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $userSettings = UserSetting::factory()->count(3)->create();

        $response = $this->get(route('user-setting.index'));

        $response->assertOk();
        $response->assertViewIs('userSetting.index');
        $response->assertViewHas('userSettings');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('user-setting.create'));

        $response->assertOk();
        $response->assertViewIs('userSetting.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Backend\UserSettingController::class,
            'store',
            \App\Http\Requests\Backend\UserSettingStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $theme = $this->faker->word;
        $language = $this->faker->word;
        $autologin = $this->faker->boolean;

        $response = $this->post(route('user-setting.store'), [
            'theme' => $theme,
            'language' => $language,
            'autologin' => $autologin,
        ]);

        $userSettings = UserSetting::query()
            ->where('theme', $theme)
            ->where('language', $language)
            ->where('autologin', $autologin)
            ->get();
        $this->assertCount(1, $userSettings);
        $userSetting = $userSettings->first();

        $response->assertRedirect(route('userSetting.index'));
        $response->assertSessionHas('userSetting.id', $userSetting->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $userSetting = UserSetting::factory()->create();

        $response = $this->get(route('user-setting.show', $userSetting));

        $response->assertOk();
        $response->assertViewIs('userSetting.show');
        $response->assertViewHas('userSetting');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $userSetting = UserSetting::factory()->create();

        $response = $this->get(route('user-setting.edit', $userSetting));

        $response->assertOk();
        $response->assertViewIs('userSetting.edit');
        $response->assertViewHas('userSetting');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Backend\UserSettingController::class,
            'update',
            \App\Http\Requests\Backend\UserSettingUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $userSetting = UserSetting::factory()->create();
        $theme = $this->faker->word;
        $language = $this->faker->word;
        $autologin = $this->faker->boolean;

        $response = $this->put(route('user-setting.update', $userSetting), [
            'theme' => $theme,
            'language' => $language,
            'autologin' => $autologin,
        ]);

        $userSetting->refresh();

        $response->assertRedirect(route('userSetting.index'));
        $response->assertSessionHas('userSetting.id', $userSetting->id);

        $this->assertEquals($theme, $userSetting->theme);
        $this->assertEquals($language, $userSetting->language);
        $this->assertEquals($autologin, $userSetting->autologin);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $userSetting = UserSetting::factory()->create();

        $response = $this->delete(route('user-setting.destroy', $userSetting));

        $response->assertRedirect(route('userSetting.index'));

        $this->assertModelMissing($userSetting);
    }
}
