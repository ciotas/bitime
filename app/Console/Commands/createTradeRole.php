<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class createTradeRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为交易计划创建角色';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
//        Permission::create(['name' => 'manage_trades']);

        $role = Role::findByName('Founder');
        $role->givePermissionTo('manage_trades');

        $role = Role::findByName('Maintainer');
        $role->givePermissionTo('manage_trades');

    }
}
