<?php

namespace Tests\Feature\Middleware;

use App\Http\Controllers\Admin\AdminController;
use App\Models\AdminAuthPermission;
use App\Models\AdminRoute;
use Database\Seeders\AdminRouteSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AdminActing;
use Tests\TestCase;

class AuthPermissionTest extends TestCase
{
    use RefreshDatabase;
    use AdminActing;

    public function testCommonAdminVisitUnauthorizedRoute()
    {
        $this->seedAdmin();

        $this->actingAsAdmin(false)
            ->getJson('api/admin/auth/user', ['username' => ''])
            ->assertOk();
    }

    public function testSuperAdminVisitUnauthorizedRoute()
    {
        $this->seedAdmin();

        $this->actingAsAdmin(true)
            ->getJson('api/admin/auth/user', ['username' => ''])
            ->assertOk();
    }

    public function testCommonAdminVisitAuthorizedRoute()
    {
        $this->seedAdmin();
        $this->seed(AdminRouteSeeder::class);

        $this->actingAsAdmin(false)
            ->getJson('api/admin/admins')
            ->assertStatus(403);
    }

    public function testSuperAdminVisitAuthorizedRoute()
    {
        $this->seedAdmin();
        $this->seed(AdminRouteSeeder::class);

        $this->actingAsAdmin(true)
            ->getJson('api/admin/admins')
            ->assertOk();
    }

    public function testCommonAdminHasPermissionVisitAuthorizedRoute()
    {
        $this->seedAdmin();
        $this->seed(AdminRouteSeeder::class);

        $adminRoute = AdminRoute::findFrom(AdminController::class.'@index');

        $admin = $this->getAdmin(false);

        $admin->givePermissionTo(AdminAuthPermission::findFrom($adminRoute));

        $this->actingAsAdmin($admin)
            ->getJson('api/admin/admins')
            ->assertOk();
    }
}
