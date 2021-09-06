<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_view_all_categories()
    {
        $this->withoutExceptionHandling();
//        $categories = Category::factory(10)->create();
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
           'name' => "SuperAdmin",
        ]);

        /** @var Permission $updatePermission */
        $updatePermission = Permission::factory()->create([
            'name' => 'update',
        ]);

        $deletePermission = Permission::factory()->create([
            'name' => 'delete',
        ]);

        $role->permissions()->attach($updatePermission->id);

        $user->roles()->attach($role->id);

        $this->actingAs($user, 'api');

        $response = $this->getJson(route('admin.categories.index'));

        $response->assertStatus(200);
//        $response->assertSee($categories[0]->name);
//        $response->assertSee($categories[1]->name);
//        $response->assertSee($categories[2]->name);
//        $response->assertSee($categories[3]->name);
//        $response->assertSee($categories[9]->name);

        $response->assertSee("salam");

    }
}
