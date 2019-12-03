<?php

namespace Tests\Feature;

use App\User;
use App\Advancer;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdvancerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /** @test */
    public function not_see_data(){
        $response = $this->get('/regis1');
        $response->assertRedirect("/login");
    }
    /** @test */
    public function can_see_data(){
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/regis1')->assertOk();
    }
    /** @test */
    public function can_register_data()
    {
        Event::fake();
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/regis',$this->data());
        $this->assertCount(1,Advancer::all());
    }
    /** @test */
    public function a_name_is_empty()
    {
        Event::fake();
      //  $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/regis',array_merge($this->data(),['a_name'=>'']));
        $response->assertSessionHasErrors('a_name');
        $this->assertCount(0,Advancer::all());
    }

    private function data(){
        return [
            'a_name' => 'mama rakib',
            'a_phone' => "021151515151",
            'dept' => 1,
        ];
    }

}
