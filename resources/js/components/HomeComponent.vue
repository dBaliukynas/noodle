<template>
  <div class="jumbotron">
    <h1 class="display-4">
      Welcome Back, {{ auth_user.name }} {{ auth_user.surname }}
    </h1>
    <p class="lead">We wish you a productive and exciting day!</p>
    <hr class="my-4" />
    <div v-if="auth_user.role_id == 1" style="margin-bottom: 15px">
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
    <hr v-if="auth_user.role_id != 3" class="my-4" />
    <div class="homepage-button-wrapper">
      <div v-if="auth_user.role_id == 1" class="admin-homepage-button-wrapper">
        <courses-component :auth_user="auth_user"></courses-component>
        <professors-create-component
          :auth_user="auth_user"
        ></professors-create-component>
        <students-create-component
          :auth_user="auth_user"
          :courses="courses"
        ></students-create-component>
      </div>
      <div v-else class="professor-homepage-button-wrapper">
        <courses-component :auth_user="auth_user"></courses-component>
        <students-create-component
          :auth_user="auth_user"
          :courses="courses"
        ></students-create-component>
      </div>
    </div>
    <div>
      <hr class="my-4" />
      <h4>Available courses</h4>
      <div style="display: flex; flex-wrap: wrap" class="card-wrapper">
        <div
          class="card course-cards"
          style="width: 275px; margin-right: 20px; margin-bottom: 20px"
          v-for="course in courses"
          :key="course.id"
        >
          <img
            :src="course.image_name"
            class="card-img-top"
            alt="course"
            style="object-fit: cover; width: 273px; height: 182px"
          />
          <div class="card-body">
            <h5 class="card-title">{{ course.name }}</h5>
            <p class="card-text">
              {{ course.description }}
            </p>
            <a :href="`course/${course.id}`" class="btn btn-primary"
              >Go to course</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CoursesComponent from "./CoursesComponent.vue";
import ProfessorsCreateComponent from "./ProfessorsCreateComponent.vue";
export default {
  components: { CoursesComponent, ProfessorsCreateComponent },
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
.admin-homepage-button-wrapper {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  text-align: center;
}
.professor-homepage-button-wrapper {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  text-align: center;
}
@media only screen and (max-width: 800px) {
  .jumbotron {
    text-align: center;
  }
  .card-wrapper {
    justify-content: center;
  }
  .container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
  }

  .card {
    margin-right: unset !important;
  }
}
@media only screen and (max-width: 767px) {
  .card-img-top {
    max-width: 100% !important;
    max-height: 182px;
  }
}
@media only screen and (max-width: 400px) {
  .admin-homepage-button-wrapper {
    flex-direction: column !important;
  }
  .professor-homepage-button-wrapper {
    flex-direction: column !important;
  }
}
</style>