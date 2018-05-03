<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Models\SuperHero as Model;

class SuperHeroTest extends TestCase
{

    protected $correctValue = [
        'nickname' => 'Crazy',
        'real_name' => 'Lúdio Oliveira',
        'origin_description' => 'Lorem impsum dolor sit amet',
        'superpowers' => 'Fire, energy and ice',
        'catch_phrase' => '"Aqui tem cerveja!"',
    ];

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testReturnNullWhenNotExists()
    {
        $this->assertNull(Model::find(34));
    }

    public function testCreateSuperHero()
    {
        $superHero = new Model();
        $superHero->fill($this->correctValue);
        $this->assertInstanceOf(Model::class, $superHero);

        // validate data.
        $this->assertEquals($this->correctValue['nickname'], $superHero->nickname);
        $this->assertEquals($this->correctValue['real_name'], $superHero->real_name);
        $this->assertEquals($this->correctValue['origin_description'], $superHero->origin_description);
        $this->assertEquals($this->correctValue['superpowers'], $superHero->superpowers);
        $this->assertEquals($this->correctValue['catch_phrase'], $superHero->catch_phrase);
    }

    public function testApi()
    {
        $response = $this->call('GET','/api/superheroes');
        $response->assertStatus(200);
    }

    public function testApiStore()
    {
        $response = $this->json('POST', '/api/superheroes', $this->correctValue);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                                  'created' => true,
                              ]);
    }


}
