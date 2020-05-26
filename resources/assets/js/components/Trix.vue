<template>
  <div>
    <input id="trix" type="hidden" :name="name" :value="value">
    <trix-editor input="trix"></trix-editor>
  </div>
</template>

<script>
import Trix from "trix";

export default {
    props: ['name', 'value'],
}
</script>