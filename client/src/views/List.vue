<template>
  <div class="d-flex flex-column h-100">
    <div class="bg-header h-navbar">
      <div
        v-if="!correntRequest"
        class="content-container d-flex justify-content-center align-items-center row py-3 h-100"
      >
        <p class="m-0">
          {{ errorMessage }}
        </p>
      </div>
      <div
        v-else-if="loading"
        class="content-container d-flex justify-content-center align-items-center row py-3 h-100"
      >
        <p class="m-0">Please wait, it's loading.</p>
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
            <p v-if="subscribersCount" class="font-size-additional">
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
      <div v-if="correntRequest" class="content-container py-3">
        <div
          class="row w-100 h-100 align-items-center justify-content-start d-flex m-0"
        >
          <div
            v-for="video in videos"
            :key="video"
            class="col-12 col-sm-6 col-md-4 col-lg-3 px-2"
          >
            <iframe
              class="w-100"
              :src="`https://www.youtube.com/embed/${video}`"
              allow="fullscreen;"
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
import axios from "axios";

export default {
  data() {
    return {
      videos: [],
      channelName: "",
      channelId: "",
      profilePicture: "",
      subscribersCount: 0,
      moreVideos: false,
      errorMessage: "",
      loading: false,
    };
  },
  computed: {
    correntRequest() {
      return this.errorMessage === "";
    },
  },
  methods: {
    async loadMoreVideos() {
      const data = await axios.get(
        `http://localhost:8080/list.php?channelId=${this.channelId}`
      );

      if (data.data.error) {
        this.errorMessage = data.data.error;
      } else {
        data.data.ids.forEach((id) => {
          if (id) this.videos.push(id);
        });
      }
    },
    async loadChannel() {
      const data = await axios.get(
        `http://localhost:8080/channelInfo.php?channelId=${this.channelId}`
      );

      if (data.data.error) {
        this.errorMessage = data.data.error;
      } else {
        const channel = data.data.channel.items[0];
        this.profilePicture = channel.snippet.thumbnails.default.url;
        this.channelName = channel.snippet.title;
        this.subscribersCount = channel.statistics.subscriberCount;
      }

      this.videos = [];
    },
    prepareForRequest() {
      this.errorMessage = "";
      this.channelId = this.$route.query.channelId || "";
      this.videos = [];
    },
    async loadData() {
      this.prepareForRequest();

      if (this.channelId) {
        this.loading = true;
        await this.loadChannel();
        await this.loadMoreVideos();
        this.loading = false;
      } else {
        this.errorMessage = "You should specify channel id in search bar";
      }
    },
  },
  watch: {
    async $route() {
        await this.loadData();
    },
  },
  async created() {
    await this.loadData();
  },
};
</script>
