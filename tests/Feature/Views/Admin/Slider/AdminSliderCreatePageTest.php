<?php

namespace Tests\Feature\Views\Admin\Slider;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminSliderCreatePageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/admin/slider/create")
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get("/admin/slider/create")
            ->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get("/admin/slider/create")
            ->assertOk()
            ->assertViewIs('admin.slider.create');
    }

    /** @test */
    public function admin_can_add_new_slider(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->post(action('Admin\SliderController@store'), ['order' => 10]);

        $this->assertDatabaseHas('slider', ['order' => 10]);
    }
}
