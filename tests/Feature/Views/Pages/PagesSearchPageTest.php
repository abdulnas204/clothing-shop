<?php

namespace Tests\Feature\Views\Pages;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PagesSearchPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_accessible_by_guest(): void
    {
        $this->get('/search')
            ->assertOk()
            ->assertViewIs('pages.search');
    }
}
