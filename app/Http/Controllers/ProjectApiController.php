<?php

namespace App\Http\Controllers;

class ProjectApiController extends Controller
{
    public function index()
    {
        $projects = [
            ['id' => 1, 'name' => 'Discusslab', 'link' => 'https://github.com/RomarioGiacholari/forum', 'image' => 'photos/discusslab.png'],
            ['id' => 2, 'name' => 'Astonroom', 'link' => 'https://github.com/RomarioGiacholari/astoonroom', 'image' => 'photos/astonroom.png'],
            ['id' => 3, 'name' => 'Industry Club', 'link' => 'https://cs.aston.ac.uk/industryclub/', 'image' => 'photos/cs-industry-portal.png'],
            ['id' => 4, 'name' => 'Picarea', 'link' => 'https://picarea.github.io/Porftolio/', 'image' => 'photos/picarea.png'],
            ['id' => 5, 'name' => 'Eye-Contractor', 'link' => 'https://github.com/RomarioGiacholari/eye-contractor', 'image' => 'photos/eye-contractor.png'],
            ['id' => 6, 'name' => 'Sparehouse-live', 'link' => 'https://www.sparehouse.live', 'image' => 'photos/sparehouse-live.png'],
            ['id' => 7, 'name' => 'Astonbrite', 'link' => 'https://github.com/RomarioGiacholari/eventbrite', 'image' => 'photos/astonbrite.png'],
            ['id' => 8, 'name' => 'Personal CRM', 'link ' => 'https://github.com/RomarioGiacholari/notebook', 'image' => 'photos/notebook.png']
        ];
        
        return response($projects, 200);
    }
}
