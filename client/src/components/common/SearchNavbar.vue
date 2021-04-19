<template>
  <div class="bg-navbar fixed-top py-2">
    <div class="content-container d-flex justify-content-center row">
      <input class="col-8 col-md-6 border border-color-1" v-model="channelId" placeholder="Your id" />
      <SearchLink :channelId="channelId" />
    </div>
  </div>
</template>
<script>
import SearchLink from "../links/Search.vue";
export default {
  components: {
    SearchLink,
  },
  data() {
    return {
      channelId: "",
    };
  },
};
</script>
