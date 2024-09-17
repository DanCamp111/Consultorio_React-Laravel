<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_home_route(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_hello_route(): void
    {
        $response = $this->get('/hola');

        $response->assertStatus(200);
    }

    public function test_aviso_route(): void
    {
        $response = $this->get('/aviso');

        $response->assertStatus(200);
    }

    public function test_auth_home_route(): void
    {
        $response = $this->get('/home');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Especialidad
    public function test_especialidad_nueva_route(): void
    {
        $response = $this->get('especialidad/nueva');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_especialidad_list_route(): void
    {
        $response = $this->get('especialidad/list');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Doctor
    public function test_doctor_nueva_route(): void
    {
        $response = $this->get('doctor/nueva');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_doctor_list_route(): void
    {
        $response = $this->get('doctor/list');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Consultorio
    public function test_consultorio_nueva_route(): void
    {
        $response = $this->get('consultorio/nueva');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_consultorio_list_route(): void
    {
        $response = $this->get('consultorio/list');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Paciente
    public function test_paciente_nueva_route(): void
    {
        $response = $this->get('paciente/nueva');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_paciente_list_route(): void
    {
        $response = $this->get('paciente/list');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Material
    public function test_material_nuevo_route(): void
    {
        $response = $this->get('material/nuevo');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_material_lista_route(): void
    {
        $response = $this->get('material/lista');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Medicamento
    public function test_medicamento_nuevo_route(): void
    {
        $response = $this->get('medicamento/nuevo');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    public function test_medicamento_lista_route(): void
    {
        $response = $this->get('medicamento/lista');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }

    // Pruebas para rutas de Citas
    public function test_citas_route(): void
    {
        $response = $this->get('citas');

        $response->assertStatus(302); // Redirige a la página de login si no estás autenticado
    }
}
