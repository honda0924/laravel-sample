<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Task::factory()->count(10)->create();
    }
    /**
     * @test
     */
    public function getList()
    {
        $tasks = Task::all();
        $response = $this->getJson('api/tasks');

        $response->assertOk()
            ->assertJsonCount($tasks->count());
    }

    /**
     * @test
     */
    public function getDetail()
    {
        $task = Task::all()->first();
        $response = $this->getJson('api/tasks/' . $task->id);

        $response->assertOk();
    }
}
