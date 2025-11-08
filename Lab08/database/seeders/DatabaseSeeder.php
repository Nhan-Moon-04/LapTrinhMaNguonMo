<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Student;
use App\Models\Course;
use Database\Factories\ProfileFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users + Profiles
        User::factory(10)->create()->each(function (User $user) {
            $user->profile()->create(ProfileFactory::new()->make()->toArray());
        });

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $testUser->profile()->create(ProfileFactory::new()->make()->toArray());

        // Categories
        $categories = Category::factory(5)->create();

        // Products and assign categories
        Product::factory(30)->create()->each(function (Product $p) use ($categories) {
            $p->category()->associate($categories->random())->save();
        });

        // Courses and Students with enrollments
        $courses = Course::factory(5)->create();
        Student::factory(15)->create()->each(function (Student $s) use ($courses) {
            $s->courses()->attach(
                $courses->random(rand(1, $courses->count()))->pluck('id')->all()
            );
        });
    }
}
