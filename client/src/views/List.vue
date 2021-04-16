<template>
    <div>
        <h1>Test</h1>
        <ul>
            <li v-for="(video, id) in videos" v-bind:key="id">
                <iframe width="420" height="315" :src="`https://www.youtube.com/embed/${video}`"></iframe>
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    data() {
        return {
            videos: []
        };
    },
    async created() {
        const data = await axios.get('http://localhost:8081/list.php');
        this.videos = data.data;
    }
}
</script>