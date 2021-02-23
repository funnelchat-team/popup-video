<template>
  <div class="float-right pb-4">
    <button
      v-if="showButtonVimeo"
      @click="redireccionar()"
      class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded"
    >
      <font-awesome-icon :icon="faBus" />
      {{ __("Start tour") }}
    </button>

    <button
      v-if="showButtonVimeo"
      @click="openModal"
      class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded"
    >
      <font-awesome-icon :icon="faFilm" />
      {{ __("See tutorial") }}
    </button>

    <portal to="modals">
      <transition name="fade">
        <general-modal
          v-if="modalOpen"
          @confirm="confirmModal"
          @close="closeModal"
          :video_url="videoUrl"
        />
      </transition>
    </portal>
  </div>
</template>

<script>
import GeneralModal from "./GeneralModal.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faFilm, faBus } from "@fortawesome/free-solid-svg-icons";

export default {
  props: ["card", "resource", "resourceId", "resourceName"],

  data() {
    return {
      faBus,
      faFilm,
      showButtonVimeo: false,
      showButtonIntercom: false,
      modalOpen: false,
      videoUrl: "",
      tourUrl: "",
    };
  },
  components: {
    GeneralModal,
    FontAwesomeIcon,
  },
  mounted() {
    this.getVimeoUrl();
  },
  methods: {
    async getVimeoUrl() {
      const {
        data: tutorial,
      } = await Nova.request().post(
        "/nova-vendor/popup-video/module_tutorial",
        { module: this.resourceName }
      );

      if (tutorial != "-1") {
        this.videoUrl = tutorial.url_video;
        this.tourUrl = tutorial.url_intercom;
        this.showButtonVimeo = this.videoUrl != null ? true : false;
        this.showButtonIntercom = this.tourUrl != null ? true : false;
      }
    },

    redireccionar(url) {
      this.$toasted.show(this.__("Starting tour!"), { type: "info" });
      setTimeout(() => {
        location.href = this.tourUrl;
      }, 500);
    },

    openModal() {
      this.modalOpen = true;
    },
    confirmModal() {
      this.modalOpen = false;
    },
    closeModal() {
      this.modalOpen = false;
    },
  },
};
</script>
