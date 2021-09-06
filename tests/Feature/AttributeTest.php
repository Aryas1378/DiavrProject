<?php


namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->postJson('/', [
            'title' => "",
            "desc" => "",
            "attributes" => [
                [
                    "attribute_id" => 1,
                    "value" => 100,
                ],
                [
                    "attribute_id" => 5,
                    "value" => "خانواده"
                ]
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_admin_only_can_destroy_attribute()
    {

        /** @var Attribute $attribute */
        $attribute = Attribute::factory()->create();

        /** @var User $admin */
        $admin = User::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
            'name' => 'admin',
        ]);

        $admin->roles()->attach($role->id);
        $this->actingAs($admin, 'api');

        $response = $this->deleteJson(route('admin.attributes.destroy', $attribute));
        $response->assertStatus(200);
        $response->assertSee("its ok");

    }
}
