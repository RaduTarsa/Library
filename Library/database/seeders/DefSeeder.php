<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create groups user and admin
        DB::table('groups')->insert(
            [
                [
                    'role' => 'client',
                ],
                [
                    'role' => 'admin',
                ]
            ]
        );

        //create rights create, read, update, delete
        DB::table('rights')->insert(
            [
                [
                    'permission' => 'read',
                    'group_id' => '1'
                ],
                [
                    'permission' => 'create',
                    'group_id' => '2'
                ],
                [
                    'permission' => 'read',
                    'group_id' => '2'
                ],
                [
                    'permission' => 'update',
                    'group_id' => '2'
                ],
                [
                    'permission' => 'delete',
                    'group_id' => '2'
                ],
            ]
        );

        //create users
        DB::table('users')->insert(
            [
                [
                    'name' => 'testuser',
                    'email' => 'testuser'.'@gmail.com',
                    'password' => Hash::make('password'),
                    'group_id' => 1,
                ],
                [
                    'name' => 'testadmin',
                    'email' => 'testadmin'.'@gmail.com',
                    'password' => Hash::make('password'),
                    'group_id' => 2,
                ],
            ]
        );

        //create categories
        DB::table('categories')->insert(
            [
                [
                    'name' => 'adventure',
                ],
                [
                    'name' => 'autobiography',
                ],
            ]
        );

        //create books
        DB::table('books')->insert(
            [
                [
                    'title' => '80 days around the globe',
                    'author' => 'Jules Verne',
                    'publisher' => 'Books for Kids',
                    'path' => 'public_html/uploads/1.pdf',
                    'category_id' => 1,
                ],
                [
                    'title' => 'Mein kampf',
                    'author' => 'Adolf Hitler',
                    'publisher' => 'Franz Eher Nachfolger',
                    'path' => 'public_html/uploads/2.pdf',
                    'category_id' => 2,
                ],
            ]
        );
    }
}
