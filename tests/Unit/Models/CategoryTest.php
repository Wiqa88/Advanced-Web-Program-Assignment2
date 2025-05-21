<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test category belongs to a user.
     */
    public function test_category_belongs_to_user()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $category->user);
        $this->assertEquals($user->id, $category->user->id);
    }

    /**
     * Test category can have many instruments.
     */
    public function test_category_can_have_many_instruments()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'String Instruments',
            'description' => 'Instruments with strings',
            'user_id' => $user->id,
        ]);

        $instrument1 = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
        ]);

        $instrument2 = Instrument::create([
            'name' => 'Test Bass',
            'type' => 'Bass Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2023,
            'condition' => 'Good',
            'user_id' => $user->id,
        ]);

        $category->instruments()->attach([$instrument1->id, $instrument2->id]);

        $this->assertCount(2, $category->instruments);
        $this->assertTrue($category->instruments->contains($instrument1));
        $this->assertTrue($category->instruments->contains($instrument2));
    }

    /**
     * Test user can have many categories.
     */
    public function test_user_can_have_many_categories()
    {
        $user = User::factory()->create();

        Category::create([
            'name' => 'String Instruments',
            'description' => 'Instruments with strings',
            'user_id' => $user->id,
        ]);

        Category::create([
            'name' => 'Wind Instruments',
            'description' => 'Instruments you blow into',
            'user_id' => $user->id,
        ]);

        $this->assertCount(2, $user->categories);
    }

    /**
     * Test deleting a category detaches it from instruments but doesn't delete the instruments.
     */
    public function test_deleting_category_detaches_from_instruments()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $instrument = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
        ]);

        $category->instruments()->attach($instrument->id);

        // Verify the relationship exists
        $this->assertCount(1, $category->instruments);

        // Delete the category
        $category->delete();

        // Verify the instrument still exists
        $this->assertDatabaseHas('instruments', ['id' => $instrument->id]);

        // Verify the pivot record is gone
        $this->assertDatabaseMissing('category_instrument', [
            'category_id' => $category->id,
            'instrument_id' => $instrument->id,
        ]);
    }
}
