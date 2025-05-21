<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index page displays user's categories.
     */
    public function test_index_displays_categories()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Category');
    }

    /**
     * Test user can create a category.
     */
    public function test_store_creates_category()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('categories.store'), [
            'name' => 'New Category',
            'description' => 'New Description',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'New Category',
            'description' => 'New Description',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test user can update a category.
     */
    public function test_update_modifies_category()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->put(route('categories.update', $category), [
            'name' => 'Updated Category',
            'description' => 'Updated Description',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
            'description' => 'Updated Description',
        ]);
    }

    /**
     * Test user can delete a category.
     */
    public function test_destroy_removes_category()
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test user cannot access another user's category.
     */
    public function test_user_cannot_access_other_users_category()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $category = Category::create([
            'name' => 'Test Category',
            'description' => 'Test Description',
            'user_id' => $user1->id,
        ]);

        $response = $this->actingAs($user2)->get(route('categories.show', $category));

        $response->assertStatus(403); // Forbidden
    }
}
