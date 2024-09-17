<?php

namespace Tests\Feature;

use App\Models\Consultorio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsultorioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(); // Si tienes un seeder para llenar tu base de datos con datos de prueba
    }

    public function test_save_creates_new_consultorio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/consultorio/guardar', [
            'numero' => 101,
        ]);

        $response->assertRedirect(route('list.consultorio'));
        $this->assertDatabaseHas('consultorios', [
            'numero' => 101,
        ]);
    }

    public function test_save_updates_existing_consultorio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $consultorio = Consultorio::factory()->create([
            'numero' => 102,
        ]);

        $response = $this->post('/consultorio/guardar', [
            'id' => $consultorio->id,
            'numero' => 103,
        ]);

        $response->assertRedirect(route('list.consultorio'));
        $this->assertDatabaseHas('consultorios', [
            'id' => $consultorio->id,
            'numero' => 103,
        ]);
    }


    public function test_delete_removes_consultorio()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $consultorio = Consultorio::factory()->create();

        $response = $this->post('/consultorio/borrar', [
            'id' => $consultorio->id,
        ]);

        $response->assertRedirect(route('list.consultorio'));
        $this->assertDatabaseMissing('consultorios', ['id' => $consultorio->id]);
    }
}
