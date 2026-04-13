<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\InviteMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminScheduleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_admin_dashboard()
    {
        $response = $this->get(route('admin'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authorized_user_can_access_admin_dashboard()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.index');
    }

    /** @test */
    public function authorized_user_can_store_a_new_schedule()
    {
        $user = User::factory()->create();

        $scheduleData = [
            'sender' => 'Dinas Pendidikan',
            'masuk' => now()->toDateString(),
            'hari' => now()->addDay()->toDateTimeString(),
            'kegiatan' => 'Rapat Koordinasi Tahunan',
            'tempat' => 'Aula Besar Lt. 2',
            'keterangan' => 'Membawa proposal kegiatan'
        ];

        $response = $this->actingAs($user)->post(route('admin.store'), $scheduleData);

        $response->assertRedirect(route('admin'));
        $response->assertSessionHas('success', 'Surat berhasil ditambahkan!');

        $this->assertDatabaseHas('invite_mails', [
            'sender' => 'Dinas Pendidikan',
            'kegiatan' => 'Rapat Koordinasi Tahunan',
            'tempat' => 'Aula Besar Lt. 2'
        ]);
    }
}
