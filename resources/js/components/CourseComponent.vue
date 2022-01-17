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
        <h1 class="course_image_text">IT</h1>
        <div class="course_image"></div>
      </div>
    </div>
    <div
      class="card card-body"
      style="width: 96vw; position: relative; margin-left: -48vw; left: 50%"
    >
      <div
        style="display: flex;
    flex-direction: row;
}"
      >
        <div style="margin-right: 50px">
          <h5 style="margin-bottom: 10px">
            Click to see members of <strong>IT </strong>course:
          </h5>
          <a
            class="btn btn-primary"
            data-bs-toggle="collapse"
            role="button"
            href="#collapseStudents"
            aria-expanded="false"
            aria-controls="collapseStudents"
            id="collapseStudentsButton"
            style="margin-bottom: 20px; width: 100px"
            @click="scrollToElement('studentsComponentWrapper')"
          >
            Students
          </a>
          <a
            class="btn btn-primary"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="collapseProfessors"
            id="collapseProfessorsButton"
            href="#collapseProfessors"
            style="margin-bottom: 20px; width: 100px"
            @click="scrollToElement('professorsComponentWrapper')"
          >
            Professors
          </a>
        </div>
        <div>
          <h5 style="margin-bottom: 10px">
            Visit <strong>groups</strong> &#38; <strong>teams</strong>:
          </h5>
          <a
            v-if="students.length == 0"
            type="submit"
            name="submit"
            class="btn btn-dark mt-4 disabled"
            style="margin: unset !important; width: 100px"
          >
            Groups
          </a>
          <a
            v-else
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/groups"
            style="margin: unset !important; width: 100px"
          >
            Groups
          </a>

          <a
            v-if="students.length == 0"
            type="submit"
            name="submit"
            class="btn btn-dark mt-4 disabled"
            style="margin: unset !important; width: 100px"
          >
            Teams
          </a>
          <a
            v-else
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/teams"
            style="margin: unset !important; width: 100px"
          >
            Teams
          </a>
        </div>
      </div>
      <div class="collapseGroup" id="collapseGroup">
        <div
          class="collapse"
          id="collapseStudents"
          data-bs-parent="#collapseGroup"
        >
          <div class="card card-body" id="studentsComponentWrapper">
            <table-component
              id="table-component"
              :students="students"
              context="room"
              :auth_user="auth_user"
            ></table-component>
          </div>
        </div>
        <div
          class="collapse"
          id="collapseProfessors"
          data-bs-parent="#collapseGroup"
        >
          <div class="card card-body" id="professorsComponentWrapper">
            <professors-component
              :professors="professors"
              :auth_user="auth_user"
            >
            </professors-component>
          </div>
        </div>
      </div>
      <hr class="my-4" />
      <project-component
        :auth_user="auth_user"
        :forum_threads="forum_threads"
        :project_members="project_members"
        :project_member_count="project_member_count"
        :scrollToElementParent="scrollToElement"
      ></project-component>
    </div>
  </div>
</template>


<script>
export default {
  props: [
    "students",
    "auth_user",
    "professors",
    "forum_threads",
    "project_members",
    "project_member_count",
  ],
  methods: {
    scrollToElement(idName) {
      setTimeout(() => {
        document.getElementById(idName).scrollIntoView({
          behavior: "smooth",
        });
      }, 500);
    },
  },
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
  .course_image_text {
    font-size: 30px;
  }
}
</style>
