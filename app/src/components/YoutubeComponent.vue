<template>
  <div>
    <div class="flex items-center justify-center h-screen">
      <div class="w-3/4 h-3/4">
        <iframe
          :src="`https://youtube.com/embed/${post.video_id}?autoplay=1&mute=0&enablejsapi=1`"
          frameborder="0"
          allow="autoplay; encrypted-media"
          class="iframe"
          id="Overlayvideo"
          allowfullscreen
        ></iframe>
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
  }
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
