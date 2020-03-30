<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

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

    public function test_it_renders_a_specific_photo()
    {
        $identifier = $this->photos[$this->photoIds[0]];
        $endpoint = route('photos.show', ['identifier' => $identifier]);
        $response = $this->get($endpoint);

        $response->assertSee($identifier);
    }

    private function fetchPhotos() : array
    {
        $files = (array) Storage::disk('public')->files();
        $photos = [];

        if ($files != null && count($files) > 0) {
            $photos = array_filter($files, fn ($file) => strpos($file, 'jpg'));
        }

        return $photos;
    }
}
