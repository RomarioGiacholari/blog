<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhotosTest extends TestCase
{
    private $photos = [];
    private $photoIds = [];

    public function setUp()
    {
        parent::setUp();
        $this->photos = $this->fetchPhotos();
        $this->photoIds = array_keys($this->photos);
    }

    public function test_it_renders_the_photos_on_the_page()
    {
        $endpoint = route('photos.partial');
        $response = $this->get($endpoint);

        $response->assertSee($this->photos[$this->photoIds[0]]);
        $response->assertSee($this->photos[$this->photoIds[1]]);
    }

    private function fetchPhotos() : array
    {
        $files = $this->get(route('api.photos.index'))->json();
        $photos = [];

        if ($files != null && count($files) > 0) {
            $photos = array_filter($files, fn ($file) => strpos($file, 'jpg'));
        }

        return $photos;
    }
}
