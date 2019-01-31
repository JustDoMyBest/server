<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Activity;
use Carbon\Carbon;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create('App\Thread');

        $this->assertDatabaseHas('activities',[
           'type' => 'created_thread',
           'user_id' => auth()->id(),
           'subject_id' => $thread->id,
           'subject_type' => 'App\Thread'
        ]);
        
        $activity = \App\Activity::first(); // 当前测试中，表里只存在一条记录

        $this->assertEquals($activity->subject->id,$thread->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->assertEquals(2, \App\Activity::count());
    }

    /** @test */
    public function it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        // Given we have a thread
        // And another thread from a week ago
        create('App\Thread',['user_id' => auth()->id()],2);

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        // When we fetch their feed
        $feed = Activity::feed(auth()->user());

        // Then,it should be returned in the proper format.
        $this->assertTrue($feed->keys()->contains(
           Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
           Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}