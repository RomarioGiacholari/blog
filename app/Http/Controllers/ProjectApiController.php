<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class ProjectApiController extends Controller
{
    public function index()
    {
        $projects = Cache::rememberForever('projects', function () {
            return [
                ['id' => 1, 'name' => 'Discusslab', 'link' => 'https://github.com/RomarioGiacholari/forum', 'image' => 'https://assets.giacholari.com/images/projects/discusslab.png'],
                ['id' => 2, 'name' => 'Astonroom', 'link' => 'https://github.com/RomarioGiacholari/astoonroom', 'image' => 'https://assets.giacholari.com/images/projects/astonroom.png'],
                ['id' => 3, 'name' => 'Industry Club', 'link' => 'https://cs.aston.ac.uk/industryclub/', 'image' => 'https://assets.giacholari.com/images/projects/cs-industry-portal.png'],
                ['id' => 4, 'name' => 'Picarea', 'link' => 'https://picarea.github.io/Porftolio/', 'image' => 'https://assets.giacholari.com/images/projects/picarea.png'],
                ['id' => 5, 'name' => 'Eye-Contractor', 'link' => 'https://github.com/RomarioGiacholari/eye-contractor', 'image' => 'https://assets.giacholari.com/images/projects/eye-contractor.png'],
                ['id' => 6, 'name' => 'Sparehouse-live', 'link' => 'https://www.sparehouse.live', 'image' => 'https://assets.giacholari.com/images/projects/sparehouse-live.png'],
                ['id' => 7, 'name' => 'Astonbrite', 'link' => 'https://github.com/RomarioGiacholari/eventbrite', 'image' => 'https://assets.giacholari.com/images/projects/astonbrite.png'],
                ['id' => 8, 'name' => 'Personal CRM', 'link' => 'https://github.com/RomarioGiacholari/notebook', 'image' => 'https://assets.giacholari.com/images/projects/notebook.png'],
                ['id' => 9, 'name' => 'Leonardo Hysa', 'link' => 'https://leonardohysa1.github.io/portfolio/', 'image' => 'https://assets.giacholari.com/images/projects/leonardo-hysa.png']
            ];
        });
        
        return response($projects, 200);
    }
}
