<template>
    <div class="md:container md:mx-auto">
        <a
        :href="`tel:${post.phone}`"
        class="btn btn-block h-60 bg-blue-500 hover:bg-blue-600 text-white hover:text-white shadow-xl"
        :style="{ backgroundColor: post.color, boxShadow: '10px 10px 8px rgba(0, 0, 0, 0.3)' }"
        target="_blank"
        >
            <div class="flex flex-col w-full">
                <div
                class="grid h-20 card bg-base-0 rounded-box place-items-center"
                v-if="post.icon_status_id == 1 && post.icon_type_id == 1 && post.icon != null"
                >
                <font-awesome-icon :icon="`${post.icon}`" class="h-24" />
                </div>
                <div
                class="grid h-20 card bg-base-0 rounded-box place-items-center"
                v-if="post.icon_status_id == 1 && post.icon_type_id == 2 && post.icon != null"
                >
                    <img :src="`https://paneldecontrolaprende.cl/public/storage/${post.icon}`" alt="" class="h-24" />
                </div>
                <div
                    class="grid h-20 card bg-base-0 rounded-box place-items-center font-bold button-title"
                >
                    {{ post.title }}
                </div>
            </div>
        </a>
    </div>
</template>

<script>
export default {
    name: 'CallButtonComponent',
    props: {
        post: {
        type: Object,
        required: true
        }
    },
    data() {
        return {}
    },
    methods: {}
}
</script>