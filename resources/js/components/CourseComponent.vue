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
            <h5 style="margin-bottom: 10px">
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
          <div
            class="course-forum-button-wrapper"
            style="margin-right: 50px; margin-top: 7px"
          >
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
          <div
            class="course-grades-button-wrapper"
            style="margin-right: 50px; margin-top: 7px"
          >
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
            <h5 style="margin-bottom: 10px; margin-top: 7px">
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
        <hr class="my-4" />
        <project-component
          :auth_user="auth_user"
          :forum_threads="forum_threads"
          :project_members="project_members"
          :project_member_count="project_member_count"
          :scrollToElementParent="scrollToElement"
        ></project-component>
        <hr class="my-4" />
      </div>
      <div
        class="segment-wrapper"
        id="segmentWrapper"
        style="display: flex; flex-direction: column"
        v-for="(course_segment, index) in course_segments"
        :key="course_segment.id"
      >
        <div style="display: flex; flex-direction: row" v-if="show[index]">
          <div
            class="segment-name-content-wrapper"
            id="segmentNameContentWrapper"
          >
            <h3 :id="`segmentName${index}`" :class="`segment-name${index}`">
              {{ course_segment.name }}
            </h3>
            <p class="segment-content" :id="`segmentContent${index}`">
              {{ course_segment.content }}
            </p>
          </div>
          <div style="margin-left: auto" v-if="auth_user.role_id != 3">
            <button
              title="Edit"
              class="no-style-button no-blur"
              @click="
                $set(show, index, !show[index]),
                  scrollToElement('editSegment' + index, 'smooth', 'start')
              "
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
                class="course-edit-segment-button"
                id="courseEditSegmentButton"
              >
                <path
                  d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"
                ></path>
                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
              </svg>
            </button>
          </div>
        </div>
        <div v-else :id="`editSegment${index}`" class="edit-segment">
          <div class="mb-3">
            <div style="display: flex">
              <button
                class="no-style-button course-close"
                id="buttonCourseCloseEdit"
                style="margin-left: auto"
                @click="$set(show, index, !show[index])"
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
              <label :for="`segmentName${index}`" class="form-label"
                >Segment's name</label
              >
            </div>
            <input
              :class="`form-control form-control-lg segment-name${index}`"
              :id="`segmentName${index}`"
              :ref="`segmentName${index}`"
              type="text"
              :value="`${course_segment.name}`"
            />
          </div>
          <div class="mb-3">
            <label :for="`segmentContent${index}`" class="form-label"
              >Segment's content</label
            >
            <resizable-text-area-component>
              <textarea
                class="form-control edit-segment-content textarea"
                :id="`segmentContent${index}`"
                :ref="`segmentContent${index}`"
                rows="3"
                :value="`${course_segment.content}`"
              ></textarea>
            </resizable-text-area-component>
            <button
              type="button"
              class="btn btn-primary"
              style="width: 125px; margin-top: 10px"
              @click="editSegment()"
            >
              Save changes
            </button>
          </div>
        </div>
        <hr class="my-4" />
      </div>
      <div
        style="display: flex"
        v-if="showCreateSegment"
        class="create-segment-wrapper"
        id="createSegmentWrapper"
      >
        <button
          class="no-style-button"
          title="Create new segment"
          style="margin-left: auto"
          @click="
            (showCreateSegment = !showCreateSegment),
              blur('create'),
              scrollToElement('createSegment', 'smooth', 'start')
          "
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
      <div v-else id="createSegment" class="create-segment">
        <div class="mb-3">
          <div style="display: flex">
            <button
              class="no-style-button course-close"
              id="buttonCourseCloseCreate"
              style="margin-left: auto"
              @click="showCreateSegment = !showCreateSegment"
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
            <label for="newSegmentName" class="form-label"
              >Segment's name</label
            >
          </div>
          <input
            class="form-control form-control-lg segment-name"
            id="newSegmentName"
            ref="newSegmentName"
            type="text"
          />
        </div>
        <div class="mb-3">
          <label for="newSegmentContent" class="form-label"
            >Segment's content</label
          >
          <resizable-text-area-component>
            <textarea
              rows="1"
              class="form-control new-segment-content textarea"
              id="newSegmentContent"
              ref="newSegmentContent"
            ></textarea>
          </resizable-text-area-component>
          <button
            type="button"
            class="btn btn-primary"
            style="width: 125px; margin-top: 10px"
            @click="createSegment()"
          >
            Create segment
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import ResizableTextAreaComponent from "./ResizableTextAreaComponent.vue";
export default {
  components: { ResizableTextAreaComponent },
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
      visibleEditSegment: false,
      visibleCreateSegment: false,
      show: Array(this.course_segments.length).fill(true),
      showCreateSegment: true,
    };
  },
  methods: {
    scrollToElement(idName, scrollBehavior, scrollBlock) {
      setTimeout(() => {
        document.getElementById(idName).scrollIntoView({
          behavior: scrollBehavior,
          block: scrollBlock,
        });
      }, 500);
    },
    changeEditSegmentBoolean(value) {
      this.visibleEditSegment = value;
    },
    changeCreateSegmentBoolean(value) {
      this.visibleCreateSegment = value;
    },
    async blur(recentValue) {
      if (!(this.visibleEditSegment || this.visibleCreateSegment)) {
        setTimeout(() => {
          document
            .querySelectorAll(
              "div.non-segments-wrapper, div.course-image-wrapper"
            )
            .forEach((element) =>
              element.classList.remove("no-user-interaction")
            );
          document
            .querySelectorAll(".my-4")
            .forEach((hrElement) => hrElement.classList.remove("blur-hr"));
          document
            .getElementById("segmentNameContentWrapper")
            .classList.remove("blur");
          document

            .getElementById("nonSegmentsWrapper")
            .classList.remove("blur");
          document
            .getElementById("courseImageWrapper")
            .classList.remove("blur");
        }, 1);
      } else {
        await setTimeout(() => {
          document.getElementById("nonSegmentsWrapper").classList.add("blur");
          document.getElementById("courseImageWrapper").classList.add("blur");
          document
            .querySelectorAll(".my-4")
            .forEach((hrElement) => hrElement.classList.add("blur-hr"));

          document
            .querySelectorAll(
              "div.non-segments-wrapper, div.course-image-wrapper, div.segment-name-content-wrapper"
            )
            .forEach((element) => element.classList.add("no-user-interaction"));
        }, 1);
        if (this.visibleEditSegment && this.visibleCreateSegment) {
          if (recentValue == "create") {
            document.getElementById("createSegment").className = "no-blur";
            document.getElementById("editSegment").className = "blur";
          } else {
            document.getElementById("createSegment").className = "blur";
            document.getElementById("editSegment").className = "no-blur";
          }
        } else {
          if (recentValue == "create") {
            document.getElementById("createSegment").className = "no-blur";
            document
              .getElementById("segmentNameContentWrapper")
              .classList.add("blur");
          } else {
            document.getElementById("editSegment").className = "no-blur";
          }
        }
      }
    },
    createSegment() {
      const data = {
        newSegmentName: this.$refs.newSegmentName.value,
        newSegmentContent: this.$refs.newSegmentContent.value,
      };
      axios
        .post(`/course/${this.course.id}/segments`, data)
        .then(() => location.reload());
    },
    editSegment() {},
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
.course-edit-segment-button {
  transition: 0.15s ease-out;
}
.course-edit-segment-button:hover {
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
.blur > * {
  opacity: 0.35;
}
.blur-hr {
  opacity: 0.1;
}
.no-blur {
  opacity: 1;
}
.no-user-interaction {
  pointer-events: none;
  user-select: none;
}

.edit-segment-content {
  min-height: 100px !important;
}
.new-segment-content {
  min-height: 100px !important;
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
  .segment-name {
    text-align: center;
  }
  .segment-wrapper {
    justify-content: center;
  }
  .segment-name-content-wrapper {
    margin-left: auto;
  }
  .segment-content {
    text-align: center;
  }
  .edit-segment-content {
    text-align: center;
  }
  .new-segment-content {
    text-align: center;
  }
}

@media only screen and (max-width: 1200px) {
  .segment-name {
    font-size: calc(1.3rem + 0.6vw) !important;
  }
}
</style>
