<template>
<div v-if="projects && projects.length > 0">
  <div id="pinBoot">
    <project
      v-for="project in projects"
      :key="project.id"
      :name="project.name"
      :link="project.link"
      :image="project.image"
    ></project>
  </div>
</div>
<div v-else>
  <div id="pinBoot">
    <div v-for="i in 6" :key="i" class="thumbnail projects white-panel pinboot-placeholder"></div>
  </div>
</div>
</template>

<script>
import project from "./Project.vue";

export default {
  components: { project },

  data() {
    return {
      projects: [],
    };
  },

  mounted() {
    this.initialize();
  },

  methods: {
    initialize() {
      var endpoint = "api/projects";

      axios
        .get(endpoint)
        .then(({ data }) => (this.projects = data))
        .catch(error => console.log(error));
    }
  }
};
</script>