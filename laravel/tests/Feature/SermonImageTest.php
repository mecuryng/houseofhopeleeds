<?php

namespace Tests\Feature;

use App\Models\Sermon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SermonImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_add_image_to_sermon(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon.jpg');

        $response = $this->actingAs($admin)->post(route('admin.sermons.store'), [
            'title' => 'Sermon with Image',
            'content' => 'A great sermon',
            'date_preached' => now()->format('Y-m-d'),
            'video_url' => null,
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.sermons.index'));
        $this->assertDatabaseHas('sermons', ['title' => 'Sermon with Image']);
        
        $sermon = Sermon::where('title', 'Sermon with Image')->first();
        $this->assertNotNull($sermon->image_path);
        \Storage::disk('public')->assertExists($sermon->image_path);
    }

    public function test_pastor_can_add_image_to_sermon(): void
    {
        $pastor = User::factory()->create(['role' => 'pastor']);
        
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon.jpg');

        $response = $this->actingAs($pastor)->post(route('pastor.sermons.store'), [
            'title' => 'Sermon with Image',
            'content' => 'A great sermon',
            'date_preached' => now()->format('Y-m-d'),
            'video_url' => null,
            'image' => $file,
        ]);

        $response->assertRedirect(route('pastor.sermons.index'));
        $this->assertDatabaseHas('sermons', ['title' => 'Sermon with Image']);
        
        $sermon = Sermon::where('title', 'Sermon with Image')->first();
        $this->assertNotNull($sermon->image_path);
        \Storage::disk('public')->assertExists($sermon->image_path);
    }

    public function test_admin_can_update_sermon_image(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $sermon = Sermon::factory()->create();
        
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon-updated.jpg');

        $response = $this->actingAs($admin)->put(route('admin.sermons.update', $sermon), [
            'title' => $sermon->title,
            'content' => $sermon->description,
            'date_preached' => $sermon->date->format('Y-m-d'),
            'video_url' => $sermon->video_url,
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.sermons.index'));
        
        $sermon->refresh();
        $this->assertNotNull($sermon->image_path);
        \Storage::disk('public')->assertExists($sermon->image_path);
    }

    public function test_admin_can_remove_sermon_image(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon.jpg');
        
        // first create with image
        $sermon = Sermon::factory()->create([
            'image_path' => $file->storeAs('sermons', 'test.jpg', 'public')
        ]);
        
        // verify image exists
        $this->assertNotNull($sermon->image_path);

        // now remove it
        $response = $this->actingAs($admin)->put(route('admin.sermons.update', $sermon), [
            'title' => $sermon->title,
            'content' => $sermon->description,
            'date_preached' => $sermon->date->format('Y-m-d'),
            'video_url' => $sermon->video_url,
            'remove_image' => true,
        ]);

        $response->assertRedirect(route('admin.sermons.index'));
        
        $sermon->refresh();
        $this->assertNull($sermon->image_path);
    }

    public function test_public_can_view_sermon_image(): void
    {
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon.jpg');
        $imagePath = $file->storeAs('sermons', 'test.jpg', 'public');
        
        $sermon = Sermon::factory()->create([
            'image_path' => $imagePath
        ]);

        $response = $this->get(route('sermons.show', $sermon));
        
        $response->assertStatus(200);
        $response->assertSee('storage/' . $imagePath);
    }

    public function test_admin_cleans_up_image_on_delete(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('sermon.jpg');
        
        $sermon = Sermon::factory()->create([
            'image_path' => $file->storeAs('sermons', 'test.jpg', 'public')
        ]);
        
        $imagePath = $sermon->image_path;
        \Storage::disk('public')->assertExists($imagePath);

        $this->actingAs($admin)->delete(route('admin.sermons.destroy', $sermon));

        \Storage::disk('public')->assertMissing($imagePath);
    }
}
