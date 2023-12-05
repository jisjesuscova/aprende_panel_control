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
      <img src="../assets/images/logo.jpg" alt="" class="mx-auto w-80 pt-10" />
      <h1 class="text-center pb-5 pt-10 text-3xl font-bold">
        Haz click en los botones para ver cada contenido
      </h1>
      <!-- Sección para mostrar las secciones -->
      <div class="flex pt-5">
        <!-- Columna de posts -->
        <div
          ref="postsColumn"
          class="w-3/4 overflow-hidden transition-all duration-300"
          :style="{ maxHeight: postsMaxHeight }"
        >
          <div v-for="(post, index) in posts" :key="post.id" class="mb-8">
            
            <NormalCategoryButton :post="post" v-if="post.content_type_id == 0" />
            <CategoryShowButton :post="post" v-if="post.content_type_id == 1" />
            <CategoryShowButton :post="post" v-if="post.content_type_id == 2" />
            <CategoryShowButton :post="post" v-if="post.content_type_id == 3" />
            <CategoryShowButton :post="post" v-if="post.content_type_id == 4" />
            <CategoryShowButton :post="post" v-if="post.content_type_id == 5" />
            <CallButton :post="post" v-if="post.content_type_id == 6" />
            <ExternalPageButton :post="post" v-if="post.content_type_id == 7" />
            <AppButton :post="post" v-if="post.content_type_id == 8" />

            <div v-if="index % 2 === 1" class="w-full"></div>
          </div>
        </div>

        <div class="w-1/4 flex flex-col items-center">
          <button @click="scrollPosts('up')" class="rounded-full bg-blue-500 text-white p-5 mb-2 w-16 h-16 flex items-center justify-center">
            <font-awesome-icon icon="fa-solid fa-arrow-up" class="h-10 w-10" />
          </button>
          <button @click="scrollPosts('down')" class="rounded-full bg-blue-500 text-white p-5 w-16 h-16 flex items-center justify-center">
            <font-awesome-icon icon="fa-solid fa-arrow-down" class="h-10 w-10" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import NormalCategoryButton from '@/components/NormalCategoryButtonComponent.vue'
import ExternalPageButton from '@/components/ExternalPageButtonComponent.vue'
import CallButton from '@/components/CallButtonComponent.vue'
import AppButton from '@/components/AppButtonComponent.vue'
import CategoryShowButton from '@/components/CategoryShowButtonComponent.vue'

export default {
  name: 'CategoryView',
  components: {
    NormalCategoryButton,
    ExternalPageButton,
    CallButton,
    AppButton,
    CategoryShowButton
  },
  data() {
    return {
      posts: [],
      loading: true,
      postsMaxHeight: '400px', // Altura máxima de la columna de posts
    }
  },
  methods: {
    scrollPosts(direction) {
      const step = 50; // Puedes ajustar el valor de paso según tus necesidades
      const postsColumn = this.$refs.postsColumn;
      if (direction === 'up') {
        postsColumn.scrollTop -= step;
      } else if (direction === 'down') {
        postsColumn.scrollTop += step;
      }
    },
    async getData() {
      this.loading = true

      try {
        const response = await axios.get('https://paneldecontrolem.cl/api/front_category/' + this.$route.params.id, {
          headers: {
            accept: 'application/json'
          }
        })

        this.posts = response.data.data
        this.loading = false
      } catch (error) {
        console.error('Error al obtener la lista de categorias:', error)
      }
    }
  },
  async mounted() {
    await this.getData()
  }
}
</script>

<style scoped>
.transition-all {
  transition: all 0.3s ease;
}

body {
  overflow: hidden; /* Hide scrollbars */
}
</style>