<template>
        <div class="thumbnail projects white-panel">
            <a :href="link">
                <img :src="image" :alt="name">
            </a>
           <div class="caption">
               <p>{{name}}</p>
          </div>
       </div>
</template>

<script>
    export default {

        props:['link','image','name'],
    }
</script>
