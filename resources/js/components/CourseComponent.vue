<template>
  <div>
    <div
      style="width: 100vw; position: relative; margin-left: -50vw; left: 50%"
    >
      <div style="margin-bottom: 20px">
        <img
          src="/img/courses/course_stock.jpeg"
          class="course_image_background"
          alt="..."
          style="height: 500px; width: 100%; object-fit: cover"
        />
        <h1 class="course_image_text">Testing</h1>
        <div class="course_image"></div>
      </div>
    </div>
    <div
      class="card card-body"
      style="width: 96vw; position: relative; margin-left: -48vw; left: 50%"
    >
      <a
        class="btn btn-primary"
        data-bs-toggle="collapse"
        href="#collapseExample"
        role="button"
        aria-expanded="false"
        aria-controls="collapseExample"
        style="margin-bottom: 20px; width: 100px"
      >
        Students
      </a>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <table-component
            :students="students"
            context="room"
            :auth_user="auth_user"
          ></table-component>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["students", "auth_user"],
};
</script>

<style>
.course_image {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: url("/img/courses/course_background.gif");
}
.course_image_text {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 1;
  font-size: 60px;
  color: white;
  transform: translate(-50%, -50%);
}
@media only screen and (max-width: 600px) {
  .course_image {
    background: linear-gradient(45deg, black, transparent);
  }
  .course_image_background {
    height: 250px !important;
  }
}
</style>
