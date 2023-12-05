<template>
  <div class="md:container md:mx-auto">
    <div v-if="loading">
      <div class="flex h-screen items-center justify-center">
        <div class="w-1/12">
          <div class="flex flex-col w-full">
            <img src="../assets/images/spinner.gif" alt="" />
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <Vimeo :post="post" v-if="post.video_type_id == 1" />
      <Youtube :post="post" v-if="post.video_type_id == 2" />
    </div>
  </div>
</template>

<script>
import Youtube from '@/components/YoutubeComponent.vue'
import Vimeo from '@/components/VimeoComponent.vue'

export default {
  name: 'VideoDataComponent',
  components: {
    Youtube,
    Vimeo
  },
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>
