<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Pages\ListCourse;
use App\Models\User;

class ListCourseTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testViewListCourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(4))
                ->visit(new ListCourse)
                ->testBtn($browser);
        });
    }
}
