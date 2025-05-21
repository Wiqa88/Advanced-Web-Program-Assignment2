<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Instrument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InstrumentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test instrument belongs to a user.
     */
    public function test_instrument_belongs_to_user()
    {
        $user = User::factory()->create();

        $instrument = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $instrument->user);
        $this->assertEquals($user->id, $instrument->user->id);
    }

    /**
     * Test instrument can belong to many categories.
     */
    public function test_instrument_can_belong_to_many_categories()
    {
        $user = User::factory()->create();

        $instrument = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
        ]);

        $category1 = Category::create([
            'name' => 'String Instruments',
            'description' => 'Instruments with strings',
            'user_id' => $user->id,
        ]);

        $category2 = Category::create([
            'name' => 'Electric Instruments',
            'description' => 'Instruments that use electricity',
            'user_id' => $user->id,
        ]);

        $instrument->categories()->attach([$category1->id, $category2->id]);

        $this->assertCount(2, $instrument->categories);
        $this->assertTrue($instrument->categories->contains($category1));
        $this->assertTrue($instrument->categories->contains($category2));
    }

    /**
     * Test deleting an instrument removes it from categories but doesn't delete the categories.
     */
    public function test_deleting_instrument_detaches_from_categories()
    {
        $user = User::factory()->create();

        $instrument = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
        ]);

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $instrument->categories()->attach($category->id);

        // Verify the relationship exists
        $this->assertCount(1, $instrument->categories);

        // Delete the instrument
        $instrument->delete();

        // Verify the category still exists
        $this->assertDatabaseHas('categories', ['id' => $category->id]);

        // Verify the pivot record is gone
        $this->assertDatabaseMissing('category_instrument', [
            'category_id' => $category->id,
            'instrument_id' => $instrument->id,
        ]);
    }

    /**
     * Test marking an instrument as a favorite.
     */
    public function test_instrument_can_be_marked_as_favorite()
    {
        $user = User::factory()->create();

        $instrument = Instrument::create([
            'name' => 'Test Guitar',
            'type' => 'Electric Guitar',
            'brand' => 'Test Brand',
            'year_acquired' => 2022,
            'condition' => 'Excellent',
            'user_id' => $user->id,
            'is_favorite' => true,
        ]);

        $this->assertTrue($instrument->is_favorite);

        $instrument->update(['is_favorite' => false]);
        $instrument->refresh();

        $this->assertFalse($instrument->is_favorite);
    }
}
