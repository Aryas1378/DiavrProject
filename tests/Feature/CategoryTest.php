<?php


namespace Tests\Feature;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_only_create_category()
    {
        /** @var Category $categories */
        $categories = Category::factory(10)->create();

        /** @var User $admin */
        $admin = User::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
            'name' => "admin",
        ]);

        $admin->roles()->attach($role->id);
        $this->actingAs($admin, 'api');

        $response = $this->postJson(route('admin.categories.store'),
            [
                'name' => $categories[0]->name,
                'parent_id' => 1
                ]);

        $response->assertStatus(200);
        $response->assertSee($categories[0]->name);

    }

    public function test_admin_can_only_update_categories()
    {

        /** @var User $admin */
        $admin = User::factory()->create();

        /** @var Category $category */
        $category = Category::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
           'name' => "admin",
        ]);
        $admin->roles()->attach($role->id);
        $this->actingAs($admin, 'api');

        $response = $this->patchJson(route('admin.categories.update', $category),
            [
                'name' => $category->name,
            ]);
        $response->assertStatus(200);
        $response->assertSee($category->name);

    }
}
