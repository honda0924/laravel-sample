<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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

    /**
     * @test
     */
    public function successStore()
    {
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->postJson('api/tasks/store', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function failNoTitleStore()
    {
        $data = [
            'title' => '',
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failNoContentStore()
    {
        $data = [
            'title' => 'テストタイトル',
            'content' => '',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'content' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failNoPersonInChargeStore()
    {
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => ''
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'person_in_charge' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverTitleStore()
    {
        $data = [
            'title' => str_repeat('あ', 101),
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverContentStore()
    {
        $data = [
            'title' => 'テストタイトル',
            'content' => str_repeat('あ', 101),
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'content' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverPersonInChargeStore()
    {
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => str_repeat('あ', 101)
        ];
        $response = $this->postJson('api/tasks/store', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'person_in_charge' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function successUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);

        $response->assertStatus(200)
            ->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function failNoTitleUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => '',
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failNoContentUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => 'テストタイトル',
            'content' => '',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'content' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failNoPersonInChargeUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => ''
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'person_in_charge' => '必須項目です。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverTitleUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => str_repeat('あ', 101),
            'content' => 'これはテストです',
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'title' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverContentUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => 'テストタイトル',
            'content' => str_repeat('あ', 101),
            'person_in_charge' => 'テスト担当者'
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'content' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function failMaxCharOverPersonInChargeUpdate()
    {
        $task = Task::factory()->create();
        $data = [
            'title' => 'テストタイトル',
            'content' => 'これはテストです',
            'person_in_charge' => str_repeat('あ', 101)
        ];
        $response = $this->putJson('api/tasks/' . $task->id . '/update', $data);
        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'person_in_charge' => '最大文字数を超えています。'
            ]);
    }

    /**
     * @test
     */
    public function successDelete()
    {
        $tasks = Task::factory()->count(10)->create();
        $row = Task::all()->count();

        $response = $this->deleteJson("api/tasks/{$tasks[0]->id}/delete");
        $response->assertOk();

        $response = $this->getJson('api/tasks');
        $response->assertJsonCount($row - 1);
    }
}
