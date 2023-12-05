<template>
  <div>
    <div class="flex items-center justify-center h-screen">
      <div class="w-3/4 h-3/4">
        <iframe
          :src="`https://player.vimeo.com/video/${post.video_id}?playsinline=0`"
          width="640"
          height="360"
          frameborder="0"
          webkitallowfullscreen
          mozallowfullscreen
          allowfullscreen
        ></iframe>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'VimeoComponent',
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>
