<?php

namespace Tests\Feature\Models;

use App\Models\AdminMenu;
use App\Models\AdminPage;
use App\Models\AdminAuthPermission;
use App\Models\AdminRoute;
use Database\Seeders\AdminMenuSeeder;
use Database\Seeders\AdminPageSeeder;
use Database\Seeders\AdminRouteSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateName()
    {
        $this->seed(AdminRouteSeeder::class);
        $this->seed(AdminPageSeeder::class);
        $this->seed(AdminMenuSeeder::class);

        $adminRoute = AdminRoute::new()->first();
        $adminPage = AdminPage::new()->first();
        $adminMenu = AdminMenu::new()->first();

        self::assertEquals($adminRoute::class . ':'. $adminRoute['id'], AdminAuthPermission::createName($adminRoute));
        self::assertEquals($adminPage::class . ':'. $adminPage['id'], AdminAuthPermission::createName($adminPage));
        self::assertEquals($adminMenu::class . ':'. $adminMenu['id'], AdminAuthPermission::createName($adminMenu));
    }

    public function testCreateFrom()
    {
        $this->seed(AdminRouteSeeder::class);
        $this->seed(AdminMenuSeeder::class);
        $this->seed(AdminPageSeeder::class);

        $adminRoute = AdminRoute::new()->first();
        $adminPage = AdminPage::new()->first();
        $adminMenu = AdminMenu::new()->first();

        AdminAuthPermission::createFrom($adminRoute);
        AdminAuthPermission::createFrom($adminPage);
        AdminAuthPermission::createFrom($adminMenu);

        self::assertNotNull(AdminAuthPermission::findByName(AdminAuthPermission::createName($adminRoute)));
        self::assertNotNull(AdminAuthPermission::findByName(AdminAuthPermission::createName($adminPage)));
        self::assertNotNull(AdminAuthPermission::findByName(AdminAuthPermission::createName($adminMenu)));
    }
}