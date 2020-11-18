<template>
  <modal @modal-close="handleClose">
    <form
      @submit.prevent="handleConfirm"
      slot-scope="props"
      class="bg-white rounded-lg shadow-lg overflow-hidden"
      style="width: 655px"
    >
      <slot :uppercaseMode="uppercaseMode" :mode="mode">
        <div class="p-2 object-left">
          <div class="flex">
            <div class="ml-auto">
              <button
                type="button"
                data-testid="cancel-button"
                dusk="cancel-general-button"
                @click.prevent="handleClose"
                class="btn text-80 font-normal h-9 btn-link float-right"
              >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path
                    class="heroicon-ui"
                    d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div class="mx-auto">
            <iframe
              :src="video"
              width="640"
              height="360"
              frameborder="0"
              allow="autoplay; fullscreen"
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </slot>
    </form>
  </modal>
</template>

<script>
import { vueVimeoPlayer } from "vue-vimeo-player";
export default {
  components: { vueVimeoPlayer },
  name: "GeneralModal",
  props: ["video"],
  methods: {
    handleClose() {
      this.$emit("close");
    },
    handleConfirm() {
      this.$emit("confirm");
    }
  },

  mounted() {
    this.$refs.confirmButton.focus();
  }
};
</script>

<style scoped>
</style>