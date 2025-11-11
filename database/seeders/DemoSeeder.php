<?php

namespace Database\Seeders;

use App\Models\{User,Account,Category,Transaction,Budget};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            ['name' => 'Demo', 'password' => Hash::make('password')]
        );

        $acc1 = Account::create([
            'user_id'=>$user->id,'name'=>'Cuenta Corriente','type'=>'checking',
            'initial_balance'=>1000,'current_balance'=>1000,'currency'=>'USD'
        ]);
        $acc2 = Account::create([
            'user_id'=>$user->id,'name'=>'Tarjeta Crédito','type'=>'credit',
            'initial_balance'=>0,'current_balance'=>0,'currency'=>'USD'
        ]);

        $food = Category::create(['user_id'=>$user->id,'name'=>'Comida','kind'=>'expense','icon'=>'🍔']);
        $salary = Category::create(['user_id'=>$user->id,'name'=>'Salario','kind'=>'income','icon'=>'💼']);

        Budget::create([
            'user_id'=>$user->id,'category_id'=>$food->id,'year'=>date('Y'),
            'month'=>date('n'),'limit_amount'=>300,'spent_amount'=>0
        ]);

        // Transacciones básicas
        Transaction::create([
            'user_id'=>$user->id,'account_id'=>$acc1->id,'category_id'=>$salary->id,
            'type'=>'income','amount'=>1500,'date'=>Carbon::now()->subDays(5),'description'=>'Pago mensual',
        ]);
        $acc1->increment('current_balance', 1500);

        Transaction::create([
            'user_id'=>$user->id,'account_id'=>$acc1->id,'category_id'=>$food->id,
            'type'=>'expense','amount'=>25.50,'date'=>Carbon::now()->subDays(2),'description'=>'Almuerzo',
        ]);
        $acc1->decrement('current_balance', 25.50);
    }
}
