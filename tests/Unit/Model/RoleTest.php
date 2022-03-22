<?php

namespace Tests\Unit;

use App\Models\Role;
use PHPUnit\Framework\TestCase;
use Tests\ModelTestCase;
use App\Models\User;

class RoleTest extends ModelTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->role = new Role();
    }

    public function tearDown(): void
    {
        unset($this->role);
        parent::tearDown();
    }

    public function testRoleContainsValidMethodProperties()
    {
        $fillable = ['name'];
        $hidden = [];
        $guarded = ['*'];
        $visible = [];
        $casts = [
            'id' => 'int',
            'deleted_at' => 'datetime',
        ];

        $this->runConfigurationAssertions($this->role, $fillable, $hidden, $guarded, $visible, $casts);
    }

    public function testRoleRelation()
    {
        $this->assertHasManyRelation($this->role->users(), $this->role, new User());
    }
}
