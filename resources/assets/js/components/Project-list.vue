<template>
    <div id="pinBoot">
        <project v-for="project in projects" :key="project.id" :name="project.name" :link="project.link" :image="project.image"></project>
    </div>
</template>

<script>
import project from './Project.vue';

export default {
    components:{ project },

    data() {
        return {
            projects: [
                {id:1, name:"Discusslab", link:"https://www.discusslab.com/", image:"photos/discusslab.png"},
                {id:2, name:"Astonroom", link:"https://github.com/RomarioGiacholari/astoonroom", image:"photos/astonroom.png"},
                {id:3, name:"Industry Club", link:"https://cs.aston.ac.uk/industryclub/", image:"photos/cs-industry-portal.png"},
                {id:4, name:"Picarea", link:"https://picarea.github.io/Porftolio/", image:"photos/picarea.png"},
                {id:5, name:"Eye-Contractor", link:"https://www.eye-contractor.co.uk", image:"photos/eye-contractor.png"},
                {id:6, name:"Sparehouse-live", link:"https://www.sparehouse.live", image:"photos/sparehouse-live.png"},
                {id:7, name:"Astonbrite", link:"https://github.com/RomarioGiacholari/eventbrite", image:"photos/astonbrite.png"},
                {id:8, name:"Personal CRM", link:"https://github.com/RomarioGiacholari/notebook", image:"photos/notebook.png"},
            ]
        }
    }
}
</script>