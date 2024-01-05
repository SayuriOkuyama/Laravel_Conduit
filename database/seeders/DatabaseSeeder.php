<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $users = User::factory(30)->create();
    Article::factory(200)->recycle($users)->create();

    Tag::factory(100)->create();

    ArticleTag::factory(50)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
  }
}
