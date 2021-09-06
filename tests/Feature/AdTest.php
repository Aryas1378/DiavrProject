<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\City;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdTest extends TestCase
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

    public function test_only_admin_see_all_ads()
    {
        /** @var User $admin */
        $admin = User::factory()->create();

        /** @var Ad $ad */
        $ad = Ad::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
           'name' => 'admin',
        ]);

        $admin->roles()->attach($role);
        $this->actingAs($admin, 'api');

        $response = $this->getJson(route('admin.ads.index'));
        $response->assertSee($ad->title);
    }

    public function test_manager_can_not_see_all_ads()
    {
        /** @var User $admin */
        $admin = User::factory()->create();

        /** @var Ad $ad */
        $ad = Ad::factory()->create();

        /** @var Role $role */
        $role = Role::factory()->create([
            'name' => 'manager',
        ]);

        $admin->roles()->attach($role);
        $this->actingAs($admin, 'api');

        $response = $this->getJson(route('admin.ads.index'));
        $response->assertDontSee($ad->title);
    }

//    public function test_user_can_not_see_all_ads()
//    {
//        /** @var User $admin */
//        $admin = User::factory()->create();
//
//        /** @var Ad $ad */
//        $ad = Ad::factory()->create();
//
//        /** @var Role $role */
//        $role = Role::factory()->create([
//            'name' => 'user',
//        ]);
//
//        $admin->roles()->attach($role);
//        $this->actingAs($admin, 'api');
//
//        $response = $this->getJson(route('admin.ads.index'));
//        $response->assertDontSee($ad->title);
//    }
//
//    public function test_admin_only_can_see_one_specific_ad()
//    {
//        /** @var User $admin */
//        $admin = User::factory()->create();
//
//        /** @var City $city */
//        $city = City::factory()->create();
//
//        /** @var Ad $ad */
//        $ad = Ad::factory()->create([
//            'city_id' => $city->id,
//        ]);
//
//        /** @var Role $role */
//        $role = Role::factory()->create([
//            'name' => 'admin',
//        ]);
//
//
//
//        $admin->roles()->attach($role->id);
//        $this->actingAs($admin, 'api');
//
//        $response = $this->getJson(route('admin.ads.show',$ad));
//
//    }
//
//    public function test_admin_only_can_update_one_specific_ad()
//    {
//
//        /** @var User $admin */
//        $admin = User::factory()->create();
//
//        /** @var City $city */
//        $city = City::factory()->create();
//
//        /** @var Status $status */
//        $status = Status::factory()->create();
//
//        /** @var Ad $ad */
//        $ad = Ad::factory()->create([
//            'city_id' => $city->id,
//            'status_id' => $status->id,
//        ]);
//
//        /** @var Role $role */
//        $role = Role::factory()->create([
//            'name' => 'admin',
//        ]);
//
//        $admin->roles()->attach($role->id);
//        $response = $this->getJson(route('admin.ads.update',$ad),['status_id' => 2]);
//
//    }
//
//    public function test_admin_only_can_delete_one_specific_ad()
//    {
//        /** @var User $admin */
//        $admin = User::factory()->create();
//
//        /** @var City $city */
//        $city = City::factory()->create();
//
//        /** @var Status $status */
//        $status = Status::factory()->create();
//
//        /** @var Ad $ad */
//        $ad = Ad::factory()->create([
//            'city_id' => $city->id,
//            'status_id' => $status->id,
//        ]);
//
//        /** @var Role $role */
//        $role = Role::factory()->create([
//            'name' => 'admin',
//        ]);
//
//        $admin->roles()->attach($role->id);
//        $response = $this->deleteJson(route('admin.ads.destroy',$ad));
//        $response->assertSee('Category is deleted');
//    }
}
