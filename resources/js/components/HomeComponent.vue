<template>
  <div class="jumbotron">
    <h1 class="display-4">
      Welcome Back, {{ auth_user.name }} {{ auth_user.surname }}
    </h1>
    <p class="lead">We wish you a productive and exciting day!</p>
    <hr class="my-4" />
    <div v-if="auth_user.role_id == 1">
      <p>Start managing professors in <strong>Professors' page</strong>.</p>
      <a class="btn btn-primary btn-lg" href="/professors" role="button"
        >Professors</a
      >
    </div>
    <div v-else-if="auth_user.role_id == 2">
      <p>Start managing students in a <strong>room</strong>.</p>
      <a class="btn btn-primary btn-lg" href="/room" role="button">Room</a>
    </div>
    <div v-if="auth_user.role_id != 3">
      <hr class="my-4" />
      <h4 style="margin-bottom: 15px">Create a course</h4>
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
    <div v-else>
      <p>Start discussing your ideas in <strong>Forum</strong></p>
      <a class="btn btn-primary btn-lg" href="/forum" role="button">Forum</a>
    </div>
    <div>
      <hr class="my-4" />
      <h4>Available courses</h4>
      <div class="card" style="width: 18rem">
        <img src="/img/course.jpeg" class="card-img-top" alt="course" />
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the
            bulk of the card's content.
          </p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
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
              <label for="formFile" class="form-label"
                >Select an image to upload</label
              >
              <input class="form-control" type="file" id="formFile" />
            </div>
            <div class="mb-3">
              <label for="courseTitle" class="form-label">Course Title</label>
              <input class="form-control" id="courseTitle" ref="courseTitle" />
            </div>
            <div class="mb-3">
              <label for="courseDescription" class="form-label"
                >Course Description</label
              >
              <textarea
                class="form-control"
                id="courseDescription"
                ref="courseDescription"
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
              @click="createCourse()"
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
    createCourse() {},
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