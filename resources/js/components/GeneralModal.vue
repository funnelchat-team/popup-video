<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header flex items-center justify-between">
          <h3 class="font-bold">{{ title }}</h3>
          <a @click="$emit('close')" href="#">
            <font-awesome-icon :icon="faTimes" class="text-gray-700" />
          </a>
        </div>
        <div class="modal-body">
          <div class="relative h-0" style="padding-bottom: 20rem">
            <iframe
              :src="video_url"
              frameborder="0"
              webkitallowfullscreen
              mozallowfullscreen
              allowfullscreen
              class="absolute w-full h-full top-0 left-0"
            ></iframe>
          </div>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <div class="flex items-center justify-between">
              <a
                @click="$emit('close')"
                class="inline-block align-baseline font-bold text-sm text-green-500 hover:text-green-800"
                href="#"
              >
                {{ __("close") }}
              </a>
            </div>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faTimes } from "@fortawesome/free-solid-svg-icons";

export default {
  data() {
    return {
      faTimes,
    };
  },
  components: {
    FontAwesomeIcon,
  },
  props: ["video_url"],

  methods: {},
};
</script>