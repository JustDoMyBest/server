<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Trending;

class TrendingThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        // Redis::del('trending_threads');

        $this->trending = new Trending();

        $this->trending->reset();
    }

    /** @test */
    public function it_increments_a_thread_score_each_time_it_is_read()
    {
        //  $this->assertEmpty(Redis::zrevrange('trending_threads',0,-1));
         $this->assertEmpty($this->trending->get());

        $thread = create('App\Thread');

        $this->call('GET',$thread->path());

        // $trending = Redis::zrevrange('trending_threads',0,-1);

        // $this->assertCount(1,$trending);

        $this->assertCount(1,$trending = $this->trending->get());

        // $this->assertEquals($thread->title,json_decode($trending[0])->title);
        $this->assertEquals($thread->title,$trending[0]->title);
    }
}