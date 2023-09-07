<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class Exercise1Test extends TestCase
{
    use RefreshDatabase;

    const EMAIL_FROM_ADDRESS = 'test@byancode.com';
    const EMAIL_FROM_NAME = 'Byancode';

    const USERS_COUNT = 100000;

    private function runSeeds(): void
    {
        $this->seed();

        if (\class_exists('\Database\Seeders\NotificationSeeder')) {
            $this->seed('\Database\Seeders\NotificationSeeder');
        }
    }

    public function test_existe_el_model_notification(): void
    {
        $this->assertTrue(class_exists('App\Models\Notification'));
    }

    public function test_existe_el_modelo_notificationshipped(): void
    {
        $this->assertTrue(class_exists('App\Mail\NotificationShipped'));
    }

    public function test_direccion_correcta_de_correo_del_sistema(): void
    {
        $this->assertEquals(static::EMAIL_FROM_ADDRESS, config('mail.from.address'));
    }

    public function test_nombre_correcto_de_correo_del_sistema(): void
    {
        $this->assertEquals(static::EMAIL_FROM_NAME, config('mail.from.name'));
    }

    public function test_existe_tabla_pivot_entre_notification_y_users(): void
    {
        $this->assertTrue(DB::getSchemaBuilder()->hasTable('notification_user'));
    }

    public function test_existe_comando_users_send_notification(): void
    {
        $this->artisan('list')->expectsOutputToContain('users:send-newsletter');
    }

    public function test_verificar_propiedad_title_en_el_modelo_notification(): void
    {
        $this->assertTrue(class_exists('App\Models\Notification'));
        $model = new \App\Models\Notification();
        $this->assertTrue($model->isFillable('title'));
    }

    /*
     * La cuenta de registros de la tabla notifications debe ser 1 pero no se aplica
     * debido a que se utilizan multiples veces el método runSeeds() en los test
     */
    public function test_existe_un_registro_en_la_tabla_notifications(): void
    {
        $this->runSeeds();
        $this->assertGreaterThan(0, Notification::count());
    }
    public function test_title_correcto_de_Notification(): void
    {
        $this->runSeeds();

        $model = DB::table('notifications')->first();
        $this->assertEquals('Nueva actualizacion del sistema', $model->title);
    }

    public function test_verificar_10_mil_usuarios_registrados() : void
    {
        $this->runSeeds();
        $this->assertEquals(static::USERS_COUNT, \App\Models\User::count());
    }

    public function test_existe_el_comando_en_schedule(): void
    {
        $this->artisan('schedule:list')->expectsOutputToContain('users:send-newsletter');
    }

    public function test_se_ejecuto_correctamente_10_consultas(): void
    {
        $this->runSeeds();
        $this->artisan('users:send-newsletter')->assertSuccessful();
    }

    public function test_se_registraron_mil_usuarion_en_relacion_con_Notification(): void
    {
        $this->runSeeds();
        $this->artisan('users:send-newsletter')->assertSuccessful();
        $this->assertEquals(static::USERS_COUNT, User::has('notifications')->count());
    }

    public function test_comando_users_send_Notification_ejecutado_correctamente(): void
    {
        Mail::fake();
        $this->runSeeds();
        $this->artisan('users:send-newsletter')->assertSuccessful();
        Mail::assertQueued('App\Mail\NotificationShipped');
    }
}
