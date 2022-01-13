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

    <div v-else>
      <p>Start discussing your ideas in <strong>Forum</strong></p>
      <a class="btn btn-primary btn-lg" href="/forum" role="button">Forum</a>
    </div>
    <courses-component :auth_user="auth_user"></courses-component>
    <div>
      <hr class="my-4" />
      <h4>Available courses</h4>
      <div style="display: flex; flex-wrap: wrap;">
        <div
          class="card"
          style="width: 275px; margin-right: 40px; margin-bottom: 20px;"
          v-for="course in courses"
          :key="course.id"
        >
          <img :src="course.image_name" class="card-img-top" alt="course" />
          <div class="card-body">
            <h5 class="card-title">{{ course.name }}</h5>
            <p class="card-text">
              {{ course.description }}
            </p>
            <a href="#" class="btn btn-primary">Go to course</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CoursesComponent from "./CoursesComponent.vue";
export default {
  components: { CoursesComponent },
  props: ["auth_user", "courses"],
  methods: {},
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