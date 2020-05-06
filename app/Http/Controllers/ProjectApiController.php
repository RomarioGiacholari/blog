<?php

namespace App\Http\Controllers;

class ProjectApiController extends Controller
{
    public function index()
    {
        $projects = [
            ['id' => 1, 'name' => 'Discusslab', 'link' => 'https://github.com/RomarioGiacholari/forum', 'image' => 'https://romariogiacholari.github.io/static/images/projects/discusslab.png'],
            ['id' => 2, 'name' => 'Astonroom', 'link' => 'https://github.com/RomarioGiacholari/astoonroom', 'image' => 'https://romariogiacholari.github.io/static/images/projects/astonroom.png'],
            ['id' => 3, 'name' => 'Industry Club', 'link' => 'https://cs.aston.ac.uk/industryclub/', 'image' => 'https://romariogiacholari.github.io/static/images/projects/cs-industry-portal.png'],
            ['id' => 4, 'name' => 'Picarea', 'link' => 'https://picarea.github.io/Porftolio/', 'image' => 'https://romariogiacholari.github.io/static/images/projects/picarea.png'],
            ['id' => 5, 'name' => 'Eye-Contractor', 'link' => 'https://github.com/RomarioGiacholari/eye-contractor', 'image' => 'https://romariogiacholari.github.io/static/images/projects/eye-contractor.png'],
            ['id' => 6, 'name' => 'Sparehouse-live', 'link' => 'https://www.sparehouse.live', 'image' => 'https://romariogiacholari.github.io/static/images/projects/sparehouse-live.png'],
            ['id' => 7, 'name' => 'Astonbrite', 'link' => 'https://github.com/RomarioGiacholari/eventbrite', 'image' => 'https://romariogiacholari.github.io/static/images/projects/astonbrite.png'],
            ['id' => 8, 'name' => 'Personal CRM', 'link' => 'https://github.com/RomarioGiacholari/notebook', 'image' => 'https://romariogiacholari.github.io/static/images/projects/notebook.png']
        ];
        
        return response($projects, 200);
    }
}
