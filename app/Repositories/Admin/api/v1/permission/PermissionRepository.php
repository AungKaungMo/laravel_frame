<?php

namespace App\Repositories\Admin\api\v1\permission;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }

    public function userHavePermissions() 
    {
        $permissions = Auth::user()->getAllPermissions();
        return $permissions->pluck('name');
    }
}
