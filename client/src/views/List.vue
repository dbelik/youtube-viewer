<template>
  <div class="d-flex flex-column h-100">
    <div class="bg-header h-navbar">
      <div
        v-if="!correntChannelId"
        class="content-container d-flex justify-content-center align-items-center row py-3 h-100"
      >
        <p class="m-0">
          You can view last videos from any channel. In the searchbar type
          channel id.
        </p>
      </div>
      <div
        v-else
        class="content-container d-flex justify-content-between align-items-center row py-3"
      >
        <div
          class="d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-sm-0 col-12 col-sm-6"
        >
          <img
            class="rounded-circle"
            height="80"
            :src="profilePicture"
            alt="Profile picture"
          />
          <div class="ml-4 w-100">
            <h3 class="channel-title text-truncate">{{ channelName }}</h3>
            <p class="font-size-additional">
              {{ subscribersCount }} subscribers
            </p>
          </div>
        </div>
        <div class="col-12 col-sm-6 text-center text-sm-right">
          <a
            :href="`https://www.youtube.com/channel/${channelId}`"
            target="_blank"
            class="primary-button"
            >Go to Channel</a
          >
        </div>
      </div>
    </div>
    <div class="h-100">
      <div v-if="correntChannelId" class="content-container py-3">
        <div
          class="row w-100 h-100 align-items-center justify-content-start d-flex"
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
        <div class="d-flex justify-content-center mt-2">
          <button
            v-if="moreVideos"
            v-on:click="loadMoreVideos"
            class="arrow-button arrow-button-down"
          >
            <svg viewBox="0 0 24 24" style="width: 100%; height: 100%">
              <path
                fill="red"
                d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"
              ></path>
            </svg>
          </button>
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
      moreVideos: true,
      loadedCount: 0,
      correntId: true
    };
  },
  computed: {
    correntChannelId() {
      return this.correntId;
    },
  },
  methods: {
    loadMoreVideos() {
      this.videos.push("eipEPh6SpU8");
      this.videos.push("YPgkSH2050k");
      this.videos.push("YPgkSH2050k");
      this.loadedCount += 3;
    },
    loadChannel(id) {
      // const data = await axios.get("http://localhost:8080/list.php");
      // this.videos = data.data.ids;
      this.videos = [];
      this.profilePicture =
        "https://yt3.ggpht.com/ytc/AAUvwnhdHjn1tScGwjN4HOM8MnsSc7uzo54at0qKweQX=s88-c-k-c0x00ffffff-no-rj";
      this.channelName = "lol Valley";
      this.subscribersCount = "9880";
      this.channelId = id || "";
      this.loadMoreVideos();
    },
  },
  watch: {
    $route() {
      this.correntId = false;
      this.loadChannel(this.$route.query.channelId);
    },
  },
  async created() {
    this.loadChannel(this.$route.query.channelId);
    this.correntId = true;
  },
};
</script>
