<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testGoToLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/login')
                    ->assertSee('Sign In')
                    ->assertPresent('input[name="email"]')
                    ->assertPresent('input[name="password"]')
                    ->assertPresent('#btnLogin')
                    ->assertPresent('#btnForgot');
        });
    }

    public function testForgotFeature()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/login')
                    ->click('#btnForgot');
            $browser->assertPathIs('/users/forgot');
        });
    }

    public function testRequireEmailAndPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/login')
                    ->click('#btnLogin');
            $browser->assertPathIs('/users/login')
                    ->assertSee('Email required')
                    ->assertSee('Password required');
        });
    }
    
    public function testLoginFeatureSuccess()
    {
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/users/login')
                    ->type('email', 'student@gmail.com')
                    ->type('password', '123456')
                    ->click('#btnLogin')
                    ->assertPathIs('/users/home');
        });
    }

    public function testLoginFeatureFail()
    {
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/users/login')
                    ->type('email', 'student@gmail.com')
                    ->type('password', '12345678')
                    ->click('#btnLogin')
                    ->assertSee('Login fail')
                    ->assertPathIs('/users/login');
        });
    }
}
