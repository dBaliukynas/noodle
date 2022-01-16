<template>
  <div v-if="auth_user.role_id != 3">
    <h4>Upload student list</h4>

    <button
      type="button"
      data-bs-toggle="modal"
      data-bs-target="#courseModal"
      style="
        background: none;
        color: inherit;
        border: none;
        padding: 0px;
        font: inherit;
        cursor: pointer;
        outline: inherit;
      "
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="45"
        height="45"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#0d6efd"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="students-create-button"
      >
        <path
          d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"
        />
        <path d="M14 3v5h5M12 18v-6M9 15h6" />
      </svg>
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
.students-create-button {
  transition: 0.15s ease-out;
}
.students-create-button:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
</style>
