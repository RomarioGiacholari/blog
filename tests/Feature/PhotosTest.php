<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhotosTest extends TestCase
{

    public function test_it_renders_the_photos_on_the_page()
    {
        $endpoint = route('photos');
        $response = $this->get($endpoint);

        $response->assertSee('alps.jpg');
        $response->assertSee('amsterdam.jpg');
    }

    public function test_it_renders_a_specific_photo()
    {
        $identifier = 'alps.jpg';
        $endpoint = route('photos.show', ['identifier' => $identifier]);
        $response = $this->get($endpoint);

        $response->assertSee('alps.jpg');
    }
}
