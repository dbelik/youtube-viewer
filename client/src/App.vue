<template>
  <SearchNavbar />
  <main class="pt-5 mh-100vh h-100vh">
    <router-view />
  </main>
</template>
<script>
import SearchNavbar from "./components/common/SearchNavbar.vue";
export default {
  components: {
    SearchNavbar,
  },
};
</script>
