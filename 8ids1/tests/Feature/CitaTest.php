<?php

namespace Tests\Feature;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Material;
use App\Models\Medicamento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CitaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(); // Si tienes un seeder para llenar tu base de datos con datos de prueba
    }

    public function test_list_citas()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/citas');

        $response->assertStatus(200);
        $response->assertViewHas('citas');
        $response->assertViewHas('doctores');
        $response->assertViewHas('consultorios');
    }

    public function test_save_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $doctor = Doctor::factory()->create();

        $response = $this->post('/cita/guardar', [
            'id_paciente' => 1,
            'id_doctor' => $doctor->id,
            'fecha' => '2024-07-23',
            'hora' => '12:00',
            'motivo' => 'Consulta general',
        ]);

        $response->assertRedirect(route('list.citas'));
        $this->assertDatabaseHas('citas', [
            'id_paciente' => 1,
            'id_doctor' => $doctor->id,
            'fecha' => '2024-07-23',
            'hora' => '12:00',
            'motivo' => 'Consulta general',
        ]);
    }

    public function test_delete_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cita = Cita::factory()->create();

        $response = $this->post('/cita/borrar', [
            'id' => $cita->id,
        ]);

        $response->assertRedirect(route('list.citas'));
        $this->assertDatabaseMissing('citas', ['id' => $cita->id]);
    }

    public function test_show_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cita = Cita::factory()->create();

        $response = $this->get("/doctor/citas/{$cita->id}");

        $response->assertStatus(200);
        $response->assertViewHas('cita');
        $response->assertViewHas('medicamentos');
        $response->assertViewHas('materiales');
    }

    public function test_assign_medicamento_to_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cita = Cita::factory()->create();
        $medicamento = Medicamento::factory()->create();

        $response = $this->post("/doctor/citas/{$cita->id}/medicamento", [
            'id_medicamento' => $medicamento->id,
            'cantidad' => 1,
            'unidad' => 'mg',
            'cada_cuanto' => '8 horas',
            'dias' => 7,
        ]);

        $response->assertRedirect(route('doctor.citas.show', $cita->id));
        $response->assertSessionHas('success', 'Medicamento asignado correctamente.');
        $this->assertDatabaseHas('medicamento_recetados', [
            'id_cita' => $cita->id,
            'id_medicamento' => $medicamento->id,
            'cantidad' => 1,
            'unidad' => 'mg',
            'cada_cuanto' => '8 horas',
            'dias' => 7,
        ]);
    }

    public function test_assign_material_to_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cita = Cita::factory()->create();
        $material = Material::factory()->create();

        $response = $this->post("/doctor/citas/{$cita->id}/material", [
            'id_material' => $material->id,
            'cantidad' => 2,
            'unidad' => 'piezas',
        ]);

        $response->assertRedirect(route('doctor.citas.show', $cita->id));
        $response->assertSessionHas('success', 'Material asignado correctamente.');
        $this->assertDatabaseHas('materiales_usados', [
            'id_cita' => $cita->id,
            'id_material' => $material->id,
            'cantidad' => 2,
            'unidad' => 'piezas',
        ]);
    }

    public function test_update_observaciones_cita()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $cita = Cita::factory()->create();

        $response = $this->post("/citas/{$cita->id}/updateObservaciones", [
            'observaciones' => 'Nueva observación',
        ]);

        $response->assertRedirect(route('doctor.citas.show', $cita->id));
        $response->assertSessionHas('success', 'Observaciones actualizadas correctamente.');
        $this->assertDatabaseHas('citas', [
            'id' => $cita->id,
            'observaciones' => 'Nueva observación',
        ]);
    }
}
