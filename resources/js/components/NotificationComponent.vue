<template>
  <div class="notification-wrapper">
    <div
      :class="'notification alert ' + alertClass"
      v-show="show"
      v-text="notification"
      @click="destroyNotification"
    ></div>
  </div>
</template>

<script>
export default {
  props: ["type", "message"],

  data() {
    return {
      show: false,
      notification: this.message,
      alertClass: this.type,
      hideTimeout: false,
    };
  },

  created() {
    if (this.notification) {
      this.showNotification();
    }

    window.events.$on("showNotification", (message, type) => {
      this.notification = message;
      this.alertClass = type;
      this.showNotification();
    });
  },

  methods: {
    showNotification() {
      this.show = true;
      this.hideNotification();
    },

    hideNotification() {
      this.hideTimeout = setTimeout(() => {
        this.show = false;
      }, 5000);
    },

    destroyNotification() {
      this.show = false;
      clearTimeout(this.hideTimeout);
    },
  },
};
</script>

<style>
.notification-wrapper {
  position: fixed;
  left: 50%;
  top: 2rem;
  z-index: 10000;
}

.notification {
  position: relative;
  left: -50%;
}
</style>