<?php

namespace Tests\Feature;

use Tests\TestCase; 
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
class CreatePostTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $this->assertTrue(true);
    }*/


    public function testReadAllThePosts()
    {
        //Given we have task in the database
        $post = factory('App\Post')->create();

        //When user visit the posts page
        $response = $this->get('/posts');
        
        //He should be able to read the post
        $response->assertSee($post->name);
    }

    public function testReadSinglePost()
    {
        //Given we have task in the database
        $post = factory('App\Post')->create();
        //When user visit the task's URI
        $response = $this->get('/posts/'.$post->id);
        //He can see the task details
         $response->assertSee($post->name)
        ->assertSee($post->detail);
    }

    public function testeditSinglePost()
    {
        //Given we have task in the database
         $post = factory('App\Post')->create();
        //When user visit the task's URI
        $response = $this->get('/posts/'.$post->id.'/edit');
        //He can see the task details
        $response->assertStatus(200);
    }
  
    public function testCreatePost()
    {
   
        $response = $this->get('/posts/create');
        $response->assertStatus(200);

    }
    public function testStorePost()
    {
        $this->withoutMiddleware();
        $post = factory('App\Post')->make();
        //When user submits post request to create task endpoint
        $response =$this->call('POST', 'posts/', $post->toArray());
       // $this->post('/posts/create',$post->toArray());
        $response = $this->get('/posts/'.$post->id);
        $response->assertStatus(200);

    }

    public function testUpdatePost(){

        $this->withoutMiddleware();
        $data = factory('App\Post')->make([
            'name' => 'Test Name',
            'detail' => 'Testing'
        ]);

       $response =$this->call('PATCH', 'posts/80', $data->toArray());

       $this->assertEquals(302, $response->getStatusCode());
    
    }

    public function testDeletePost()
    {
        $post = factory('App\Post')->create();
        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/posts/'.$post->id);
        $this->assertEquals(302, $response->getStatusCode());
    }

}
    