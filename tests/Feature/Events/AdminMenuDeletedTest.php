<?php

namespace Tests\Feature\Events;

use App\Models\AdminPermission;
use App\Models\AdminMenu;
use Database\Seeders\AdminMenuSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMenuDeletedTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleted()
    {
        $this->seed(AdminMenuSeeder::class);

        $adminMenu = AdminMenu::new()->inRandomOrder()->first();

        $this->assertDatabaseHas(AdminPermission::class, ['name' => AdminPermission::createName($adminMenu)]);

        $adminMenu->delete();

        $this->assertDatabaseMissing(AdminPermission::class, ['name' => AdminPermission::createName($adminMenu)]);
    }
}
