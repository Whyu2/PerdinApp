<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'admin',
            'nama' => 'admin',
            'password' => bcrypt('1234'),
            'role' => 'admin'],
            ['username' => 'pegawai',
            'nama' => 'Eko',
            'password' => bcrypt('1234'),
            'role' => 'pegawai'],
            ['username' => 'pegawai2',
            'nama' => 'Agus',
            'password' => bcrypt('1234'),
            'role' => 'pegawai'],
            ['username' => 'sdm',
            'nama' => 'Ali',
            'password' => bcrypt('1234'),
            'role' => 'sdm'],
           ]);
           DB::table('pulaus')->insert([
            ['nama_pulau' => 'Luar Negeri'],
            ['nama_pulau' => 'Jawa'],
            ['nama_pulau' => 'Kalimantan'],
            ['nama_pulau' => 'Sumatra']
           ]);
           DB::table('provinsis')->insert([
            ['nama_provinsi' => 'Luar Negeri'],
            ['nama_provinsi' => 'Jawa Timur'],
            ['nama_provinsi' => 'Jawa Tengah'],
            ['nama_provinsi' => 'Jawa Barat'],
            ['nama_provinsi' => 'Sumatra Utara']
           ]);

           DB::table('kotas')->insert([
            ['nama_kota' => 'Surabaya',
            'pulau_id' => 2,
            'provinsi_id' => 2,
            'luar_negeri' => 0,
            'lat' => '-7.250445',
            'long' => '112.768845',
           ],  
           ['nama_kota' => 'Semarang',
           'pulau_id' => 2,
           'provinsi_id' => 3,
           'luar_negeri' => 0,
           'lat' => '-6.966667',
           'long' => '110.416664',
          ]
           ]);

      
    }
}
