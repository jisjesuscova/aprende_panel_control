<template>
    <div class="md:container md:mx-auto">
        {{ text_description }}
    </div>
</template>

<script>
export default {
    name: 'TextView',
    props: {
        post: {
            type: Object,
            required: true
        }
    }
}
</script>
