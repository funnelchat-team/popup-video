<template>
  <div class="float-right pb-4">
    <!-- <button>{{__('Open Modal')}}</button> -->
    <button
      v-if="showButtonIntercom"
      class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold py-2 px-4 border border-blue-500 rounded"
      @click="redireccionar()"
    >
      <!-- <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" ><path fill="var(--sidebar-icon)" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg> -->
      {{__("Start tour")}}
    </button>
    <button
      v-if="showButtonVimeo"
      class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold py-2 px-4 border border-blue-500 rounded"
      @click="openModal"
    >
      <!-- <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" ><path fill="var(--sidebar-icon)" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg> -->
      {{__("See tutorial")}}
    </button>

    <portal to="modals">
      <transition name="fade">
        <general-modal
          v-if="modalOpen"
          @confirm="confirmModal"
          @close="closeModal"
          :video="videoUrl"
        />
      </transition>
    </portal>
  </div>
</template>

<script>
import GeneralModal from "./GeneralModal.vue";

export default {
  props: ["card", "resource", "resourceId", "resourceName"],

  data() {
    return {
      showButtonVimeo: false,
      showButtonIntercom: false,
      modalOpen: false,
      videoUrl: "",
      tourUrl: ""
    };
  },
  components: {
    GeneralModal
  },
  mounted() {
    this.getVimeoUrl();
  },
  methods: {
    async getVimeoUrl() {
      const {
        data: tutorial
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
    }
  }
};
</script>
