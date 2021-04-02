<?php

namespace Tests\Feature;

use App\Managers\Photos\IPhotoManager;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PhotosTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $json = file_get_contents(__DIR__."/Data/Photos/data.json");
        $data = json_decode($json, true);
        $callback = fn ($mock) => $mock->shouldReceive()->all()->andReturn($data);

        $this->mock(IPhotoManager::class, $callback);
    }

    public function test_it_renders_the_photos_on_the_page()
    {
        $photoManager = resolve(IPhotoManager::class);
        $endpoint = route('photos.partial');
        $response = $this->get($endpoint);
        $photos = $photoManager->all();

        foreach ($photos as $key => $value) {
            $response->assertSee($key);
        }
    }
}
