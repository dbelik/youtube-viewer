<template>
    <div class="col-sm-12 col-lg-6 px-2 py-2">
        <iframe
            class="w-100"
            :src="`https://www.youtube.com/embed/${videoId}`"
            allow="fullscreen;"
            style="height: 300px"
        >
        </iframe>
        <h3>{{ title }}</h3>
        <p>{{ description }}</p>
    </div>
</template>
<script>
export default {
    data() {
        return {
            videoId: String,
            title: String,
            description: String
        }
    }
}
</script>