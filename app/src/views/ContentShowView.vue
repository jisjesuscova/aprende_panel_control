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
      <VideoData :post="post" v-if="post.content_type_id == 1" />
      <AudioData :post="post" v-if="post.content_type_id == 2" />
      <TextData :post="post" v-if="post.content_type_id == 3" />
      <PdfData :post="post" v-if="post.content_type_id == 4" />
      <IframeData :post="post" v-if="post.content_type_id == 5" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import VideoData from '@/components/VideoDataComponent.vue'
import AudioData from '@/components/AudioDataComponent.vue'
import TextData from '@/components/TextDataComponent.vue'
import PdfData from '@/components/PdfDataComponent.vue'
import IframeData from '@/components/IframeDataComponent.vue'

export default {
  name: 'ContentShowView',
  components: {
    VideoData,
    AudioData,
    TextData,
    PdfData,
    IframeData
  },
  data() {
    return {
      post: '',
      loading: true
    }
  },
  methods: {
    async getData() {
      this.loading = true

      try {
        const response = await axios.get('https://paneldecontrolaprende.cl/api/front_content/show/data/' + this.$route.params.id, {
          headers: {
            accept: 'application/json'
          }
        })

        this.post = response.data.data
        this.loading = false
      } catch (error) {
        console.error('Error al obtener la sección:', error)
      }
    }
  },
  async mounted() {
    await this.getData()
  }
}
</script>
