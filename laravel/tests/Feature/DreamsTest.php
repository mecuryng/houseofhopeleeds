<?php

namespace Tests\Feature;

use App\Models\Dream;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DreamsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_list_and_single(): void
    {
        // create a user and some dreams associated with them
        $user = User::factory()->create();
        Dream::factory()->count(3)->create(['user_id' => $user->id]);

        $this->get('/dreams')->assertStatus(200);
        $this->get('/dreams')->assertSeeText('Revelations & Visions');

        $dream = Dream::first();
        $this->get(route('dreams.show', $dream))->assertStatus(200);
        $this->get(route('dreams.show', $dream))->assertSeeText($dream->title);
    }

    public function test_admin_must_be_authenticated_to_access_admin_pages(): void
    {
        $this->get(route('admin.dreams.index'))->assertRedirect('/login');
    }

    public function test_admin_user_can_access_and_create_dream(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.dreams.index'))
            ->assertStatus(200);

        // also test uploading an attachment
        \Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->image('vision.png');

        $response = $this->actingAs($admin)->post(route('admin.dreams.store'), [
            'title' => 'A dream',
            'content' => 'Something significant',
            'attachment' => $file,
        ]);

        $response->assertRedirect(route('admin.dreams.index'));
        $this->assertDatabaseHas('dreams', ['title' => 'A dream']);
        $dream = Dream::where('title', 'A dream')->first();
        $this->assertNotNull($dream->attachment_path);
        \Storage::disk('public')->assertExists($dream->attachment_path);

        $response->assertRedirect(route('admin.dreams.index'));
        $this->assertDatabaseHas('dreams', ['title' => 'A dream']);
    }
}
