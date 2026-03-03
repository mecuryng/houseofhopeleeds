<?php

namespace Tests\Feature;

use App\Models\Reflection;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReflectionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_list_and_single(): void
    {
        $user = User::factory()->create();
        Reflection::factory()->count(3)->create(['user_id' => $user->id]);

        $this->get('/reflections')->assertStatus(200);
        $this->get('/reflections')->assertSeeText('Reflections');

        $reflection = Reflection::first();
        $this->get(route('reflections.show', $reflection))->assertStatus(200);
        $this->get(route('reflections.show', $reflection))->assertSeeText($reflection->title);
    }

    public function test_admin_must_be_authenticated_to_access_admin_pages(): void
    {
        $this->get(route('admin.reflections.index'))->assertRedirect('/login');
    }

    public function test_admin_user_can_access_and_create_reflection(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.reflections.index'))
            ->assertStatus(200);

        Storage::fake('public');
        $file = UploadedFile::fake()->image('thought.jpg');

        $response = $this->actingAs($admin)->post(route('admin.reflections.store'), [
            'title' => 'A reflection',
            'content' => 'Pensive content',
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.reflections.index'));
        $this->assertDatabaseHas('reflections', ['title' => 'A reflection']);
        $reflection = Reflection::where('title', 'A reflection')->first();
        $this->assertNotNull($reflection->image_path);
        Storage::disk('public')->assertExists($reflection->image_path);
    }
}
