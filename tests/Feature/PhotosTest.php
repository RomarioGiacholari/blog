<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversNothing
 */
class PhotosTest extends TestCase
{
    private array $photos = [];

    public function setUp()
    {
        parent::setUp();

        $this->photos = $this->fetchPhotos();
    }

    public function test_it_renders_the_photos_on_the_page()
    {
        $endpoint = route('photos.partial');
        $response = $this->get($endpoint);

        foreach ($this->photos as $key => $value) {
            $response->assertSee($key);
        }
    }

    private function fetchPhotos(): array
    {
        $files  = $this->get(route('api.photos.index'))->json();
        $photos = [];

        if (null != $files && \count($files) > 0) {
            $photos = array_filter($files, fn ($file) => strpos($file, 'jpg'));
        }

        return $photos;
    }
}
