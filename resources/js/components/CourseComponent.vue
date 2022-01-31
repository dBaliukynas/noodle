<template>
  <div id="container">
    <div
      style="width: 100vw; position: relative; margin-left: -50vw; left: 50%"
      id="courseImageWrapper"
      class="course-image-wrapper"
    >
      <div style="margin-bottom: 20px">
        <img
          :src="course.image_name"
          class="course_image_background"
          alt="..."
          style="height: 500px; width: 100%; object-fit: cover"
        />
        <h1 class="course_image_text">{{ course.name }}</h1>
        <div class="course_image"></div>
      </div>
    </div>
    <div
      class="card card-body"
      id="courseCard"
      style="width: 96vw; position: relative; margin-left: -48vw; left: 50%"
    >
      <div id="nonSegmentsWrapper" class="non-segments-wrapper">
        <div
          class="course-button-wrapper"
          style="display: flex;
    flex-direction: row;
}"
        >
          <div
            style="margin-right: 50px; margin-top: 7px"
            class="course-students-professors-button-wrapper"
          >
            <h5>
              Click to see <strong>members</strong> of
              <strong>{{ course.name }}</strong> course:
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
              @click="
                scrollToElement('studentsComponentWrapper', 'smooth', 'start')
              "
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
              @click="
                scrollToElement('professorsComponentWrapper', 'smooth', 'start')
              "
            >
              Professors
            </a>
          </div>
          <div
            style="margin-right: 50px; margin-top: 7px"
            class="course-groups-teams-button-wrapper"
          >
            <h5>Visit <strong>groups</strong> &#38; <strong>teams</strong>:</h5>
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
          <div
            class="course-forum-button-wrapper"
            style="margin-right: 50px; margin-top: 7px"
          >
            <h5>Discuss in <strong>forum</strong>:</h5>
            <a
              class="btn btn-primary"
              href="/forum"
              style="margin: unset !important; width: 100px"
            >
              Forum
            </a>
          </div>
          <div
            class="course-grades-button-wrapper"
            style="margin-right: 50px; margin-top: 7px"
          >
            <h5>View your <strong>grades</strong>:</h5>
            <a
              class="btn btn-primary"
              href="#"
              style="margin: unset !important; width: 100px"
            >
              Grades
            </a>
          </div>
          <div
            class="course-reflections-button-wrapper"
            style="margin-top: 7px"
          >
            <h5>
              Leave <strong>reflections</strong> about
              <strong>{{ course.name }}</strong> course:
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
        <hr class="my-3" />
        <project-component
          :auth_user="auth_user"
          :forum_threads="forum_threads"
          :project_members="project_members"
          :project_member_count="project_member_count"
          :scrollToElementParent="scrollToElement"
        ></project-component>
        <course-settings-component
          :auth_user="auth_user"
          :scrollToElementParent="scrollToElement"
          :editAllSegmentsEnabled="editAllSegmentsEnabled"
          :buttonsEnabled="buttonsEnabled"
        ></course-settings-component>
      </div>
      <hr class="my-3" />
      <course-segment-component
        :auth_user="auth_user"
        :scrollToElementParent="scrollToElement"
        :course="course"
        :buttonsEnabled="buttonsEnabled"
      ></course-segment-component>
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
    "course",
    "course_segments",
  ],
  data() {
    return {
      studentViewEnabled: false,
      editAllSegmentsEnabled: false,
      checkboxesEnabled: false,
      buttonsEnabled: true,
      blurEnabled: false,
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.$store.dispatch(
        "courseSegmentsModule/setCourseSegments",
        this.course_segments
      );
      this.$store.dispatch(
        "courseSegmentsModule/initShow",
        this.course_segments.length
      );
      this.$store.dispatch(
        "courseSegmentsModule/setBlurEnabled",
        this.blurEnabled
      );
      this.$store.dispatch(
        "courseSegmentsModule/setStudentViewEnabled",
        this.studentViewEnabled
      );
      this.$store.dispatch(
        "courseSegmentsModule/setCheckboxesEnabled",
        this.checkboxesEnabled
      );
      this.$store.dispatch(
        "courseSegmentsModule/initPinnedSegmentsBooleans",
        this.course_segments.length
      );
      this.$store.dispatch(
        "courseSegmentsModule/initHiddenSegmentsBooleans",
        this.course_segments.length
      );
    });
  },

  methods: {
    scrollToElement(idName, scrollBehavior, scrollBlock) {
      setTimeout(() => {
        document.getElementById(idName)?.scrollIntoView({
          behavior: scrollBehavior,
          block: scrollBlock,
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
  text-align: center;
  width: -webkit-fill-available;
  width: -moz-available;
  word-wrap: break-word;
  max-width: 600px;
}
.course-button-wrapper {
  margin-bottom: 20px;
  flex-wrap: wrap;
  text-align: center;
  justify-content: space-around;
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

  .course-settings-button-wrapper {
    justify-content: center;
    flex-direction: column !important;
  }
  .course-setting-button-wrapper {
    margin-right: unset !important;
    margin-bottom: 10px !important;
  }
}
</style>
