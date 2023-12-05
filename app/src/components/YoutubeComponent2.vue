<template>
  <div>
    <div class="flex items-center justify-center h-screen">
      <div class="w-3/4 h-3/4">

        <YouTube 
        src="https://www.youtube.com/watch?v=Fn0mUEP4mKc" 
        @ready="onReady"
        ref="youtube" />

      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'YoutubeComponent',
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  methods: {
        onReady() {
            this.$refs.youtube.playVideo()
        },
    },
}
</script>
<style scoped>
iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>