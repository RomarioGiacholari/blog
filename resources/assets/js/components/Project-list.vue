<template>
        <div id="pinBoot">
            <project v-for="project in projects" :key="project.id" :name="project.name" :link="project.link" :image="project.image"></project>
       </div>
</template>

<script>

    import project from './Project.vue';

    export default {

        components:{project},

        data() {
            return {
                projects: [
                    {id:1, name:"Discusslab", link:"http://www.discusslab.com/", image:"photos/discusslab.png"},
                    {id:2, name:"AstonRommm", link:"http://astonroom.herokuapp.com/", image:"photos/astonroom.png"},
                    {id:3, name:"Industry Club", link:"https://cs.aston.ac.uk/industryclub/", image:"photos/cs-industry-portal.png"},
                    {id:3, name:"C&M Builders", link:"http://www.cmbuildersinfo.co.uk", image:"photos/cmbuilders.png"},
                ]
            }
        }
    }
</script>
