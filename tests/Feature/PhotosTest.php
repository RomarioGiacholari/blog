<?php

namespace Tests\Feature;

use App\Services\Photos\IPhotoService;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PhotosTest extends TestCase
{
    private IPhotoService $photoService;

    public function setUp(): void
    {
        parent::setUp();

        $this->photoService = resolve(IPhotoService::class);
    }

    public function test_it_renders_the_photos_on_the_page()
    {
        $endpoint = route('photos.partial');
        $response = $this->get($endpoint);
        $photos   = $photos   = $this->photoService->all() ?? [];

        foreach ($photos as $key => $value) {
            $response->assertSee($key);
        }
    }
}
