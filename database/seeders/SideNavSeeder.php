<?php

namespace Database\Seeders;

use App\Constants\Guard;
use App\Constants\SideNav;
use Illuminate\Support\Arr;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use App\Models\SideNav as ModelsSideNav;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SideNavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_groups = PermissionGroup::query()
            ->orderBy('guard_name')
            ->orderBy('name')
            ->get()
            ->groupBy('guard_name')
            ->map(fn ($collection) => $collection->pluck('id', 'name'))
            ->toArray();

        foreach ($this->sidenavs() as $guard_name => $side_nav_items) {
            foreach ($side_nav_items as $item) {
                $side_nav = ModelsSideNav::firstOrCreate(
                    Arr::only($item, ['name']) + compact('guard_name'),
                    Arr::except($item, ['name', 'permission_group'])
                );

                $side_nav->permissionGroups()
                    ->sync(data_get($permission_groups, "{$guard_name}.{$item['permission_group']}"));
            }
        }

        $side_nav = ModelsSideNav::query()
            ->with('permissionGroups', fn ($query) => $query->select('name'))
            ->orderBySort()
            ->get()
            ->groupBy('guard_name')
            ->toArray();

        foreach ($side_nav as $guard_name => $side_nav_items) {
            Cache::put('side_nav_' . $guard_name, $side_nav_items);
        }
    }

    protected function sidenavs()
    {
        return [
            Guard::ADMIN => [
                [
                    'name' => 'dashboard',
                    'icon' => 'fa-solid fa-house',
                    'permission_group' => 'dashboard',
                    'route_type' => SideNav::ROUTE_TYPE_ROUTE_NAME,
                    'route' => 'admin.dashboard',
                    'active_type' => SideNav::ACTIVE_TYPE_ROUTE,
                    'sort' => 1
                ]
            ]
        ];
    }
}
