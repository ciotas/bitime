<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
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
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为交易计划创建角色';

    protected $user;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
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

        // 新增一个测试普通用户账户
        $this->user->name = 'manager';
        $this->user->email = 'linzikristy@outlook.com';
        $this->user->email_verified_at = Carbon::now()->toDateTimeString();
        $this->user->password = bcrypt('a761177953z');
        $this->user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png';
        $this->user->save();
        $this->user->assignRole('Maintainer');
    }
}
