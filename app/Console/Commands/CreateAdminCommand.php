<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--u|username= : Username of the newly created user.} {--e|email= : E-Mail of the newly created user.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаёт пользователя с ролью администратора';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->option('username');
        if (!$username) {
            $username = $this->ask('Введите имя пользователя');
        }

        $email = $this->option('email');
        if (!$email) {
            $email = $this->ask('Введите почту');
        }

        $password = $this->secret('Введите пароль');

        $role = Role::where('slug', RoleEnum::ADMIN->value)->first();
        $user = \App\Models\User::create([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role_id' => $role->id,
        ]);

        //$user->assignRole('admin');'

        $this->info('Пользователь успешно создан');
    }
}
