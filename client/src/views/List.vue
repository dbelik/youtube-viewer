<template>
  <div class="d-flex flex-column mh-100vh h-100vh">
    <div class="bg-header height-auto">
      <div
        class="content-container d-flex justify-content-between align-items-center row py-3"
      >
        <div class="d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-sm-0 col-12 col-sm-6">
          <img
            class="rounded-circle"
            height="80"
            :src="profilePicture"
            alt="Profile picture"
          />
          <div class="ml-4">
            <h3 class="channel-title">{{ channelName }}</h3>
            <p class="font-size-additional">
              {{ subscribersCount }} subscribers
            </p>
          </div>
        </div>
        <div class="col-12 col-sm-6 text-center text-sm-right">
          <a
            :href="`https://www.youtube.com/channel/${channelId}`"
            class="primary-button"
            >Go to Channel</a
          >
        </div>
      </div>
    </div>
    <div class="bg-content h-100">
      <div
        class="content-container py-3 d-flex align-items-center justify-content-start row"
      >
        <div
          v-for="video in videos"
          :key="video"
          class="col-12 col-sm-6 col-md-4 col-lg-3 px-2"
        >
          <iframe
            class="w-100"
            :src="`https://www.youtube.com/embed/${video}`"
          >
          </iframe>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// import axios from "axios";
export default {
  data() {
    return {
      videos: [],
      channelName: "",
      channelId: "",
      profilePicture: "",
      subscribersCount: 0,
    };
  },
  async created() {
    // const data = await axios.get("http://localhost:8080/list.php");
    // this.videos = data.data.ids;
    this.videos.push("eipEPh6SpU8");
    this.videos.push("YPgkSH2050k");
    this.videos.push("YPgkSH2050k");
    this.profilePicture =
      "https://yt3.ggpht.com/ytc/AAUvwnhdHjn1tScGwjN4HOM8MnsSc7uzo54at0qKweQX=s88-c-k-c0x00ffffff-no-rj";
    this.channelName = "lol Valley";
    this.subscribersCount = "9880";
    this.channelId = "UCfRKvxo-2oSKNptUqbciuIw";
  },
};
</script>
