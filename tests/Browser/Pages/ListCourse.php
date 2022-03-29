<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

class ListCourse extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/courses';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
        $this->testView($browser, [
            "Courses List",
            "ID",
            "Subject",
            "Credit",
            "Lecturer Name",
            "Number",
        ]);
    }

    public function testBtnUpdate(Browser $browser)
    {
        $browser->press('Update');
        $browser->assertPathBeginsWith('/admin/courses');
    }

    public function testBtnView(Browser $browser)
    {
        $browser->press('View Timetable');
        $browser->assertPathBeginsWith('/admin/timetables');
    }

    public function testBtnDelete(Browser $browser)
    {
        $browser->press('Delete');
        $browser->assertDialogOpened('Are you sure delete?');
    }

    public function testShow(Browser $browser)
    {
        $browser->clickLink('OOP 1');
        $browser->assertRouteIs('courses.show', 1);
    }

    public function testBtn(Browser $browser)
    {
        $this->testBtnDelete($browser);
        $browser->dismissDialog();
        $this->testBtnUpdate($browser);
        $browser->back();
        $this->testBtnView($browser);
        $browser->back();
        $this->testShow($browser);
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
