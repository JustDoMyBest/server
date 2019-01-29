<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_may_no_add_replies()
    {
        // $this->expectException('Illuminate\Auth\AuthenticationException');
        // $this->expectException('Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException');
        $this->withExceptionHandling()
        ->post('threads/some-channel/1/replies',[])
        ->assertRedirect('/login');

        // $this->post('threads/1/replies',[]);
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        // Given we have a authenticated user
        // $this->be($user = factory('App\User')->create());
        $this->signIn();  // 已登录用户
        // And an existing thread
        // $thread = factory('App\Thread')->create();
        $thread = create('App\Thread');
        $this->post('/threads',$thread->toArray());

        // dd($thread->path()); // 打印出路径

        $this->get($thread->path())
        ->assertSee($thread->title)
        ->assertSee($thread->body);

        // When the user adds a reply to the thread
        $reply = factory('App\Reply')->make();
        $this->post($thread->path() .'/replies',$reply->toArray());

        // Then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}