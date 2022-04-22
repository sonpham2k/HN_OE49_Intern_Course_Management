<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Course;
use App\Models\Post;
use App\Models\Role;
use App\Models\Report;
use Tests\ModelTestCase;

class UserTest extends ModelTestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }

    public function testUserContainsValidMethodProperties()
    {
        $fillable = ['username', 'email', 'password', 'address', 'dob', 'fullname'];
        $hidden = ['remember_token', 'updated_at', 'created_at'];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
            'email_verified_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->user, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testUserRelation()
    {
        $this->assertBelongsToRelation($this->user->role(), $this->user, new Role(), 'role_id');
        $this->assertBelongsToManyRelation(
            $this->user->courses(),
            $this->user,
            new Course(),
            'course_user.user_id',
            'course_user.course_id'
        );
        $this->assertHasManyRelation($this->user->reports(), $this->user, new Report());
        $this->assertHasManyRelation($this->user->posts(), $this->user, new Post());
        $this->assertBelongsToManyRelation(
            $this->user->followers(),
            $this->user,
            new User(),
            'followers.follows_id',
            'followers.user_id'
        );
        $this->assertBelongsToManyRelation(
            $this->user->follows(),
            $this->user,
            new User(),
            'followers.user_id',
            'followers.follows_id'
        );
    }
}
