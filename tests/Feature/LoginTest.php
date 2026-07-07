<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders_with_flashed_status(): void
    {
        $response = $this->withSession(['status' => 'Login realizado com sucesso!'])->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login realizado com sucesso!');
        $response->assertSee('$flux.toast', false);
        $response->assertSee('success');
    }

    public function test_login_page_renders_with_flashed_error(): void
    {
        $response = $this->withSession(['error' => 'E-mail ou senha incorretos.'])->get('/login');

        $response->assertStatus(200);
        $response->assertSee('E-mail ou senha incorretos.');
        $response->assertSee('$flux.toast', false);
        $response->assertSee('danger');
    }

    public function test_login_validation_errors(): void
    {
        Livewire::test('pages::login')
            ->set('email', '')
            ->set('password', '')
            ->call('login')
            ->assertHasErrors(['email' => 'required', 'password' => 'required']);
    }

    public function test_login_validation_invalid_email(): void
    {
        Livewire::test('pages::login')
            ->set('email', 'not-an-email')
            ->set('password', '123')
            ->call('login')
            ->assertHasErrors(['email' => 'email', 'password' => 'min']);
    }

    public function test_login_failed_credentials(): void
    {
        Livewire::test('pages::login')
            ->set('email', 'nonexistent@example.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertSessionHas('error', 'E-mail ou senha incorretos. Por favor, verifique suas credenciais.');
    }
}
