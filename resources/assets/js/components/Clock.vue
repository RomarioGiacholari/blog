<template>
  <a href="#" v-text="clock"></a>
</template>

<script>
export default {
  data() {
    return {
      clock: "00:00:00"
    };
  },

  mounted() {
    setInterval(this.start, 1000);
  },

  methods: {
    start() {
      let date = new Date();
      let hour = date.getHours();
      let minutes = date.getMinutes();
      let seconds = date.getSeconds();

      this.clock = `${hour}:${minutes}:${seconds}`;
    }
  }
};
</script>