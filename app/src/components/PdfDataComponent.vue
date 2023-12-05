<template>
    <div class="md:container md:mx-auto">
        <iframe :src="`https://docs.google.com/viewer?url=${'https://paneldecontrolem.cl/public/storage/' + post.pdf}&embedded=true`" width="100%" class="pdf" style="border: none;"></iframe>
        <hr class="mt-5 mb-5">
        <h2 class="pdf_description mb-10">
            {{ post.pdf_description }}
        </h2>
    </div>
</template>

<script>
export default {
    name: 'PdfView',
    props: {
        post: {
            type: Object,
            required: true
        }
    }
}
</script>
