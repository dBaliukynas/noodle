<template>
  <div>
    <div v-if="auth_user.role_id != 3">
      <h4 >Create a course</h4>
      <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#courseModal"
        style="
          background: none;
          color: inherit;
          border: none;
          padding: 0;
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
          class="course-button"
        >
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="16"></line>
          <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>
      </button>
    </div>
    <div
      class="modal fade"
      id="courseModal"
      tabindex="-1"
      aria-labelledby="courseModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="courseModalLabel">Create a course</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="image" class="form-label"
                >Select an image to upload</label
              >
              <input
                class="form-control"
                type="file"
                id="image"
                ref="image"
                name="image"
                @change="onFileChange()"
              />
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Course Title</label>
              <input class="form-control" id="name" ref="name" />
            </div>
            <div class="mb-3">
              <label for="description" class="form-label"
                >Course Description</label
              >
              <textarea
                class="form-control"
                id="description"
                ref="description"
                rows="3"
              ></textarea>
            </div>
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
              type="button"
              class="btn btn-primary"
              @click="
                uploadImage().then((imageName) => createCourse(imageName))
              "
            >
              Create
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["auth_user"],
  methods: {
    onFileChange() {
      this.file = this.$refs.image.files[0];
    },
    async uploadImage() {
      if (this.file == undefined) {
        return;
      }
      let formData = new FormData();
      formData.append("image", this.file);
      let response;
      try {
        response = await axios.post("/courses/image-upload", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        });
      } catch (error) {
        if (error.response.status == 422) {
          showNotification(
            "Supported formats: jpeg, bmp, png, gif, svg, pdf",
            "alert-danger"
          );
        } else if (error.response.status == 413) {
          showNotification("The file is too large", "alert-danger");
        } else if (error.response.status == 500) {
          showNotification("Unexpected error", "alert-danger");
        }
      }
      return response.data.image_name;
    },
    createCourse(imageName) {
      if (imageName == undefined) {
        imageName = "/img/courses/course_stock.jpeg";
      }
      const data = {
        name: this.$refs.name.value,
        description: this.$refs.description.value,
        image_name: imageName,
      };
      axios
        .post("/courses/", data)
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
    },
  },
};
</script>

<style>
.course-button {
  transition: 0.15s ease-out;
}
.course-button:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
</style>