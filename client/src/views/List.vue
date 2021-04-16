<template>
    <div>
        <h1>Test</h1>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    created() {
        axios.get('localhost:8080');
    }
}
</script>