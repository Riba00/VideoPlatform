<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\SanctumTokenController
 */


//email_is_required_for_issuing_tokens
//email_is_valid_for_issuing_tokens
//password_is_required_for_issuing_tokens
//device_name_is_required_for_issuing_tokens
//
//invalid_password_gives_incorrect_credentials_error

class SanctumTokenControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function email_is_required_for_issuing_tokens()
    {
        $response = $this->postJson('/api/sanctum/token', [
            'password' => '12345678',
            'device_name' => "Prova's device",
        ]);

        $response->assertStatus(422);
        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The email field is required.",$jsonResponse->message);
        $this->assertEquals("The email field is required.",$jsonResponse->errors->email[0]);
    }

    /** @test */
    public function invalid_email_gives_incorrect_credentials_error()
    {
        $user = User::create([
            'name' => 'Prova',
            'email' => 'prova@prova.com',
            'password' => '12345678',
        ]);

        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'another_email',
            'password' => $user->password,
            'device_name' => $user->name . "'s device"
        ]);

        $jsonResponse = json_decode($response->getContent());
        $this->assertEquals("The provided credentials are incorrect.",$jsonResponse->message);
        $this->assertEquals("The provided credentials are incorrect.",$jsonResponse->errors->email[0]);

        $response->assertStatus(422);
    }

    /** @test */
    public function user_with_valid_credentials_can_issue_a_token()
    {
        $user = User::create([
            'name' => 'Prova',
            'email' => 'prova@prova.com',
            'password' => '12345678',
        ]);

        $this->assertCount(0, $user->tokens);


        $response = $this->postJson('/api/sanctum/token', [
            'email' => $user->email,
            'password' => $user->password,
            'device_name' => $user->name . "'s device",
        ]);

        $response->assertStatus(200);
        $this->assertNotNull($response->getContent());
        $this->assertCount(1, $user->fresh()->tokens);
    }
}
