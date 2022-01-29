<template>
  <div
    v-if="auth_user.role_id != 3"
    style="display: flex; flex-direction: column"
  >
    <hr class="my-3" />
    <h3>Settings</h3>
    <div
      style="
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        text-align: center;
      "
      class="course-settings-button-wrapper"
    >
      <div>
        <div
          v-if="show.find((isEnabled) => isEnabled) == undefined"
          style="margin-right: 50px"
          class="course-setting-button-wrapper"
        >
          <h5>Edit <strong>all</strong> segments</h5>
          <button
            class="btn btn-primary"
            style="margin: unset !important; width: 100px"
            @click="
              (show = new Array(course_segments.length).fill(true)),
                scrollToElement('editSegment0', 'smooth', 'start')
            "
          >
            Edit
          </button>
        </div>
        <div
          v-else
          style="margin-right: 50px"
          class="course-setting-button-wrapper"
        >
          <h5>Close <strong>all</strong> segments</h5>
          <button
            class="btn btn-danger"
            style="margin: unset !important; width: 100px"
            @click="show = new Array(course_segments.length).fill(false)"
          >
            Close
          </button>
        </div>
      </div>
      <div
        v-if="!blurEnabled"
        class="course-setting-button-wrapper"
        style="margin-right: 50px"
      >
        <h5><strong>Blur</strong> effect</h5>
        <button
          class="btn btn-success"
          style="margin: unset !important; width: 100px"
          @click="blurEnabled = !blurEnabled"
        >
          Enable
        </button>
      </div>
      <div
        v-else
        class="course-setting-button-wrapper"
        style="margin-right: 50px"
      >
        <h5><strong>Blur</strong> effect</h5>
        <button
          class="btn btn-danger"
          style="margin: unset !important; width: 100px"
          @click="blurEnabled = !blurEnabled"
        >
          Disable
        </button>
      </div>
      <div
        class="course-setting-button-wrapper"
        v-if="!studentViewEnabled"
        style="margin-right: 50px"
      >
        <h5><strong>Student</strong> view</h5>
        <button
          class="btn btn-success"
          style="margin: unset !important; width: 100px"
          @click="studentViewEnabled = !studentViewEnabled"
        >
          Enable
        </button>
      </div>
      <div
        v-else
        class="course-setting-button-wrapper"
        style="margin-right: 50px"
      >
        <h5><strong>Student</strong> view</h5>
        <button
          class="btn btn-danger"
          style="margin: unset !important; width: 100px"
          @click="studentViewEnabled = !studentViewEnabled"
        >
          Disable
        </button>
      </div>
      <div
        class="course-setting-button-wrapper"
        v-if="!checkboxesEnabled"
        style="margin-right: 50px"
      >
        <h5>Checkboxes</h5>
        <button
          class="btn btn-success"
          style="margin: unset !important; width: 100px"
          @click="checkboxesEnabled = !checkboxesEnabled"
        >
          Enable
        </button>
      </div>
      <div
        v-else
        class="course-setting-button-wrapper"
        style="margin-right: 50px"
      >
        <h5>Checkboxes</h5>
        <button
          class="btn btn-danger"
          style="margin: unset !important; width: 100px"
          @click="checkboxesEnabled = !checkboxesEnabled"
        >
          Disable
        </button>
      </div>
      <div v-if="!checkboxesEnabled">
        <div class="course-setting-button-wrapper" v-if="!buttonsEnabled">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-success disabled"
            style="margin: unset !important; width: 100px"
            @click="buttonsEnabled = !buttonsEnabled"
          >
            Enable
          </button>
        </div>
        <div v-else class="course-setting-button-wrapper">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-danger disabled"
            style="margin: unset !important; width: 100px"
            @click="buttonsEnabled = !buttonsEnabled"
          >
            Disable
          </button>
        </div>
      </div>
      <div v-else>
        <div class="course-setting-button-wrapper" v-if="!buttonsEnabled">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-success"
            style="margin: unset !important; width: 100px"
            @click="buttonsEnabled = !buttonsEnabled"
          >
            Enable
          </button>
        </div>
        <div v-else class="course-setting-button-wrapper">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-danger"
            style="margin: unset !important; width: 100px"
            @click="buttonsEnabled = !buttonsEnabled"
          >
            Disable
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: [
    "show",
    "auth_user",
    "blurEnabled",
    "studentViewEnabled",
    "editAllSegmentsEnabled",
    "checkboxesEnabled",
    "buttonsEnabled",
  ],
};
</script>

<style>
@media only screen and (max-width: 800px) {
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
