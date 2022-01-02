<template>
  <div class="panel panel-primary" v-if="auth_user.role_id != 3">
    <div class="panel-heading">
      <h2 style="margin-bottom: 20px">Upload Students' list</h2>
    </div>
    <div class="mb-3">
      <input
        class="form-control"
        type="file"
        name="file"
        ref="file"
        id="chooseFile"
        @change="onFileChange()"
      />
    </div>
    <button
      disabled
      v-if="file.name == ' No file chosen '"
      class="btn btn-primary btn-block mt-4 disabled w-100"
    >
      Upload File
    </button>
    <button
      v-else
      type="button"
      class="btn btn-primary btn-block mt-4 w-100"
      @click="onFileUpload()"
    >
      Upload File
    </button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["auth_user"],
  data() {
    return {
      file: { name: " No file chosen " },
    };
  },
  methods: {
    onFileChange() {
      this.file = this.$refs.file.files[0];
    },
    onFileUpload() {
      let formData = new FormData();
      formData.append("file", this.file);
      axios
        .post("/file-upload", formData)
        .then(() => location.reload())
        .catch((error) => {
          if (error.response.status == 422) {
            showNotification(
              "Supported formats: csv, xls, ods, json",
              "alert-danger"
            );
          } else if (error.response.status == 413) {
            showNotification("The file is too large", "alert-danger");
          } else if (error.response.status == 409) {
            showNotification(
              "Students cannot have the same email",
              "alert-danger"
            );
          } else if (error.response.status == 500) {
            showNotification("Unexpected error", "alert-danger");
          }
        });
    },
  },
};
</script>

<style>
</style>
