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
        $this->withExceptionHandling();
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/regis',[
            'name'=> 'mama rakib',
            'phone'=> "019231449666",
            'dept'=> 1,
        ]);
        $this->assertCount(0,Advancer::all());
    }

}
