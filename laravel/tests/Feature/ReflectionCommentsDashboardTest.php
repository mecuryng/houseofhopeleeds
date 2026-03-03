<?php

use App\Models\Reflection;
use App\Models\ReflectionComment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('admin dashboard shows recent reflection comments and links to management page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $reflection = Reflection::factory()->create();
    // create a comment directly (no factory exists for this model)
    ReflectionComment::create([
        'reflection_id' => $reflection->id,
        'content' => 'A thoughtful remark',
        'approved' => false,
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Recent Reflection Comments')
        ->assertSee('A thoughtful remark')
        // sidebar link should be present as well
        ->assertSee('<a href="'.route('admin.reflection-comments.index').'"', false);
});

