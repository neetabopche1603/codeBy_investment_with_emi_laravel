<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Regular',
                'details' => 'first payment in 40 days, rest are paid every month onwards till next 9 months. Full refunded after 10 months 10 days.',
                'payment_percent' => 10, // percentage
                'first_payment_duration' => 40, //days
                'other_payment_duration' => 30, //days
                'total_emi' => 10,
                'manager' => 1,
            ],
            [
                'name' => 'Silver',
                'details' => 'first payment in 60 days, rest are paid every month onwards till next 11 months. Full refunded after 13 months.',
                'payment_percent' => 16, // percentage
                'first_payment_duration' => 60, //days
                'other_payment_duration' => 30, //days
                'total_emi' => 12,
                'manager' => 1,
            ],
            [
                'name' => 'Gold',
                'details' => 'first payment in 45 days, rest are paid every month onwards till next 15 months. Full refunded after 16 months 15 days.',
                'payment_percent' => 12, // percentage
                'first_payment_duration' => 45, //days
                'other_payment_duration' => 30, //days
                'total_emi' => 16,
                'manager' => 1,
            ],    
        ];   

        foreach($plans as $plan) {
            Plan::create(
                $plan
            );
        }
    }
}
