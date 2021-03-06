<?php

namespace Tests\Feature\Views\Cart;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CartIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_accessible_by_guest(): void
    {
        $this->get('/cart')
            ->assertOk()
            ->assertViewIs('cart.index');
    }

    /** @test */
    public function page_is_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/cart')
            ->assertOk();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/cart')
            ->assertOk();
    }
}
