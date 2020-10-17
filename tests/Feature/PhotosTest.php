<?php

namespace Tests\Feature;

use App\Services\Photos\IPhotoService;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PhotosTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $data     = ['alps.jpg' => 'https://assets.giacholari.com/images/gallery/alps.jpg'];
        $callback = fn ($mock) => $mock->shouldReceive()->all()->twice()->andReturn($data);

        $this->mock(IPhotoService::class, $callback);
    }

    public function test_it_renders_the_photos_on_the_page()
    {
        $photoService = resolve(IPhotoService::class);
        $endpoint     = route('photos.partial');
        $response     = $this->get($endpoint);
        $photos       = $photoService->all();

        foreach ($photos as $key => $value) {
            $response->assertSee($key);
        }
    }
}
