<?php

namespace Tests\Unit\Mail;

use App\Mail\ForgotPassMail;
use App\Job\SendEmail;
use Illuminate\Support\Facades\Mail;
use Tests\ControllerTestCase;
use Tests\TestCase;

class ForgotPassMailTest extends ControllerTestCase
{
    protected $datas;
    protected $mail;

    public function setUp(): void
    {
        parent::setUp();

        $this->datas = [
            'type' => 'Reset password',
            'name' => 'student',
            'password' => '123123123',
        ];
        $this->mail = new ForgotPassMail($this->datas);
    }

    public function tearDown(): void
    {
        unset($this->datas);
        unset($this->mail);

        parent::tearDown();
    }

    public function testBuildSendMailMarkdown()
    {
        Mail::fake();
        Mail::send($this->mail);
        
        Mail::assertSent(ForgotPassMail::class, function ($mail) {
            $mail->build();
            return true;
        });
    }
}
