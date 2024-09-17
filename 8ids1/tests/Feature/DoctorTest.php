<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Especialidad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DoctorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $especialidad = Especialidad::factory()->create();
        $doctor = Doctor::factory()->create(['id_especialidades' => $especialidad->id]);

        $response = $this->get(route('nueva.doctor', ['id' => $doctor->id]));

        $response->assertStatus(200);
        $response->assertViewIs('doctor');
        $response->assertViewHas('doctor', $doctor);
        $response->assertViewHas('especialidades');
    }

    public function test_save()
    {
        $especialidad = Especialidad::factory()->create();
        $user = User::factory()->create();

        $data = [
            'nombre' => 'John',
            'ap_paterno' => 'Doe',
            'ap_materno' => 'Smith',
            'cedula' => '123456',
            'telefono' => '555-5555',
            'especialidad' => $especialidad->id,
            'email' => 'john.doe@example.com',
            'password' => 'password',
        ];

        $response = $this->post(route('guardar.doctor'), $data);

        $response->assertRedirect(route('list.doctor'));

        $this->assertDatabaseHas('doctores', [
            'nombre' => 'John',
            'ap_paterno' => 'Doe',
            'ap_materno' => 'Smith',
            'cedula' => '123456',
            'telefono' => '555-5555',
            'id_especialidades' => $especialidad->id,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
            'rol' => 'doctor',
        ]);
    }

    public function test_list()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->get(route('list.doctor'));

        $response->assertStatus(200);
        $response->assertViewIs('doctores');
        $response->assertViewHas('doctores');
    }

    public function test_delete()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->post(route('borrar.doctor'), ['id' => $doctor->id]);

        $response->assertRedirect(route('list.doctor'));

        $this->assertDatabaseMissing('doctores', [
            'id' => $doctor->id,
        ]);
    }

    // API tests
    public function test_saveAPI()
    {
        $especialidad = Especialidad::factory()->create();

        $data = [
            'nombre' => 'John',
            'ap_paterno' => 'Doe',
            'ap_materno' => 'Smith',
            'cedula' => '123456',
            'telefono' => '555-5555',
            'especialidad' => $especialidad->id,
        ];

        $response = $this->postJson(route('guardar.doctor.api'), $data);

        $response->assertStatus(200);
        $response->assertExactJson(["OK"]);

        $this->assertDatabaseHas('doctores', [
            'nombre' => 'John',
            'ap_paterno' => 'Doe',
            'ap_materno' => 'Smith',
            'cedula' => '123456',
            'telefono' => '555-5555',
            'id_especialidades' => $especialidad->id,
        ]);
    }

    public function test_listAPI()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->getJson(route('list.doctor.api'));

        $response->assertStatus(200);
        $response->assertJsonStructure([['id', 'nombre', 'ap_paterno', 'ap_materno', 'cedula', 'telefono', 'id_especialidades', 'id_user']]);
    }

    public function test_deleteAPI()
    {
        $doctor = Doctor::factory()->create();

        $response = $this->deleteJson(route('borrar.doctor.api'), ['id' => $doctor->id]);

        $response->assertStatus(200);
        $response->assertExactJson(["OK"]);

        $this->assertDatabaseMissing('doctores', [
            'id' => $doctor->id,
        ]);
    }
}
