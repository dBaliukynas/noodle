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
        class="course-button-wrapper"
        style="display: flex;
    flex-direction: row;
}"
      >
        <div
          style="margin-right: 50px"
          class="course-students-professors-button-wrapper"
        >
          <h5 style="margin-bottom: 10px">
            Click to see <strong>members</strong> of <strong>IT </strong>course:
          </h5>
          <a
            class="btn btn-primary"
            data-bs-toggle="collapse"
            role="button"
            href="#collapseStudents"
            aria-expanded="false"
            aria-controls="collapseStudents"
            id="collapseStudentsButton"
            style="width: 100px"
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
            style="width: 100px"
            @click="scrollToElement('professorsComponentWrapper')"
          >
            Professors
          </a>
        </div>
        <div
          style="margin-right: 50px"
          class="course-groups-teams-button-wrapper"
        >
          <h5 style="margin-bottom: 10px">
            Visit <strong>groups</strong> &#38; <strong>teams</strong>:
          </h5>
          <a
            v-if="students.length == 0"
            class="btn btn-dark mt-4 disabled"
            style="margin: unset !important; width: 100px"
          >
            Groups
          </a>
          <a
            v-else
            class="btn btn-dark mt-4"
            href="/groups"
            style="margin: unset !important; width: 100px"
          >
            Groups
          </a>

          <a
            v-if="students.length == 0"
            class="btn btn-dark mt-4 disabled"
            style="margin: unset !important; width: 100px"
          >
            Teams
          </a>
          <a
            v-else
            class="btn btn-dark mt-4"
            href="/teams"
            style="margin: unset !important; width: 100px"
          >
            Teams
          </a>
        </div>
        <div class="course-forum-button-wrapper" style="margin-right: 50px">
          <h5 style="margin-bottom: 10px">
            Discuss in <strong>forum</strong>:
          </h5>
          <a
            class="btn btn-primary"
            href="/forum"
            style="margin: unset !important; width: 100px"
          >
            Forum
          </a>
        </div>
        <div class="course-grades-button-wrapper" style="margin-right: 50px">
          <h5 style="margin-bottom: 10px">
            View your <strong>grades</strong>:
          </h5>
          <a
            class="btn btn-primary"
            href="#"
            style="margin: unset !important; width: 100px"
          >
            Grades
          </a>
        </div>
        <div class="course-reflections-button-wrapper">
          <h5 style="margin-bottom: 10px">
            Leave <strong>reflections</strong> about <strong>IT</strong> course:
          </h5>
          <a
            class="btn btn-primary"
            href="#"
            style="margin: unset !important; width: 100px"
          >
            Reflections
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
              :forum_threads="forum_threads"
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
      <hr class="my-4" />
      <div
        class="general-wrapper"
        id="general-wrapper"
        style="display: flex"
        v-if="visibleEditSegment == false"
      >
        <div>
          <h3>General</h3>
        </div>
        <div style="margin-left: auto" v-if="auth_user.role_id != 3">
          <button
            title="Edit"
            class="no-style-button"
            @click="editSegment(true), scrollToElement('editSegment')"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#0d6efd"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="course-edit-general-button"
              id="courseEditGeneralButton"
            >
              <path
                d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"
              ></path>
              <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
            </svg>
          </button>
        </div>
      </div>
      <div v-else id="editSegment">
        <div class="mb-3">
          <div style="display: flex">
            <button
              class="no-style-button course-close"
              style="margin-left: auto"
              @click="editSegment(false), scrollToElement('general-wrapper')"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#0d6efd"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
          <div>
            <label for="segmentName" class="form-label">Segment's name</label>
          </div>
          <input
            class="form-control form-control-lg segment-name"
            id="segmentName"
            type="text"
            value="General"
          />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label"
            >Segment's content</label
          >
          <textarea
            class="form-control"
            id="exampleFormControlTextarea1"
            rows="3"
          ></textarea>
        </div>
      </div>
      <hr class="my-4" />
      <div style="display: flex">
        <button
          class="no-style-button"
          title="Create new segment"
          style="margin-left: auto"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="22"
            height="22"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#0d6efd"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="course-add-segment-button"
          >
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
        </button>
      </div>
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
  data() {
    return { visibleEditSegment: false };
  },
  methods: {
    scrollToElement(idName) {
      setTimeout(() => {
        document.getElementById(idName).scrollIntoView({
          behavior: "smooth",
        });
      }, 500);
    },
    editSegment(value) {
      this.visibleEditSegment = value;
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
.course-button-wrapper {
  margin-bottom: 20px;
  flex-wrap: wrap;
  text-align: center;
  justify-content: space-around;
}
.course-edit-general-button {
  transition: 0.15s ease-out;
}
.course-edit-general-button:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
.course-add-segment-button {
  transition: 0.15s ease-out;
}
.course-add-segment-button:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
.course-close {
  transition: 0.15s ease-out;
}
.course-close:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
.segment-name {
  font-size: 1.75rem;
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
@media only screen and (max-width: 800px) {
  .course-button-wrapper {
    justify-content: center;
    flex-direction: column !important;
  }
  .course-students-professors-button-wrapper {
    margin-right: unset !important;
    margin-bottom: 10px !important;
  }
  .course-groups-teams-button-wrapper {
    margin-right: unset !important;
    margin-bottom: 10px !important;
  }
  .course-forum-button-wrapper {
    margin-right: unset !important;
    margin-bottom: 10px !important;
    margin-top: unset !important;
  }
  .course-grades-button-wrapper {
    margin-right: unset !important;
    margin-bottom: 10px !important;
    margin-top: unset !important;
  }
  .course-reflections-button-wrapper {
    margin-top: unset !important;
  }
}
@media only screen and (max-width: 1269px) {
  .course-reflections-button-wrapper {
    margin-top: 15px;
  }
}
@media only screen and (max-width: 1200px) {
  .segment-name {
    font-size: calc(1.3rem + 0.6vw) !important;
  }
}
@media only screen and (max-width: 1002px) {
  .course-grades-button-wrapper {
    margin-top: 15px;
  }
}
@media only screen and (max-width: 807px) {
  .course-forum-button-wrapper {
    margin-top: 15px;
  }
}
</style>
