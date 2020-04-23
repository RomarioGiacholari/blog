<template>
  <div id="pinBoot">
    <project
      v-for="project in projects"
      :key="project.id"
      :name="project.name"
      :link="project.link"
      :image="project.image"
    ></project>
  </div>
</template>

<script>
import project from "./Project.vue";

export default {
  components: { project },

  data() {
    return {
      projects: []
    };
  },

  mounted() {
    this.fetchProjects();
  },

  methods: {
    fetchProjects() {
      var endpoint = "api/projects";

      axios
        .get(endpoint)
        .then(({ data }) => (this.projects = data))
        .catch(error => console.log(error));
    }
  }
};
</script>