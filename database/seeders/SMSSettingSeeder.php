<?php

namespace Database\Seeders;

use DB;
use App\Models\SMSSetting;
use Illuminate\Database\Seeder;

class SMSSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('s_m_s_settings')->delete();
        
        $s_m_s_settings = SMSSetting::create([

            'nexmo_key'=>'your_nexmo_key',
            'nexmo_secret'=>'your_nexmo_secret',
            'nexmo_sender_name'=>'ABC',
            'twilio_sid'=>'your_twilio_sid',
            'twilio_auth_token'=>'your_twilio_auth_token',
            'twilio_number'=>'your_twilio_number',
            'status'=>'1',
            
        ]);
    }
}
