<template>
  <div v-if="auth_user.role_id != 3">
    <h4>Upload student list</h4>

    <button
      type="button"
      data-bs-toggle="modal"
      data-bs-target="#studentsCreateModal"
      class="no-style-button"
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
    <div
      class="modal fade"
      id="studentsCreateModal"
      tabindex="-1"
      aria-labelledby="studentsCreateModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="studentsCreateModalLabel">
              Upload student list
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <input
              class="form-control"
              type="file"
              name="file"
              ref="file"
              id="chooseFile"
              style="margin-bottom: 1rem !important"
              @change="onFileChange()"
            />
            <label style="margin-bottom: 0.5rem">Select a course</label>
            <select class="form-control" ref="rate">
              <option
                v-for="course in courses"
                :key="course.id"
                :value="course.id"
                style="margin-bottom: 1rem !important"
              >
                {{ course.name }}
              </option>
            </select>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button
              disabled
              v-if="file.name == ' No file chosen '"
              type="button"
              class="btn btn-primary"
            >
              Upload
            </button>
            <button
              v-else
              type="button"
              class="btn btn-primary"
              @click="onFileUpload()"
            >
              Upload
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["auth_user", "courses"],
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
