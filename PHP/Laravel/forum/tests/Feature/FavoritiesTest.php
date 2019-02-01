<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritiesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        // If I post a "favorite" endpoint
        // $this->post('replies/' . $reply->id . '/favorites');
        try{
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        }catch (\Exception $e){
            $this->fail('Did not expect to insert the same record set twice.');
        }

        // It Should be recorded in the database
        $this->assertCount(1,$reply->favorites);
    }

    /** @test */
    public function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_unfavorite_a_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        // $this->post('replies/' . $reply->id . '/favorites');

        // $this->assertCount(1, $reply->favorites);

        // $this->delete('replies/' . $reply->id . '/favorites');

        // $this->assertCount(0, $reply->fresh()->favorites);

        $reply->favorite();

        $this->delete('replies/' . $reply->id . '/favorites');
    
        $this->assertCount(0,$reply->favorites);
    }
}