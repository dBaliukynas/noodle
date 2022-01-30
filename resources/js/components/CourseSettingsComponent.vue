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
              $store.dispatch(
                'courseSegmentsModule/setShow',
                new Array(courseSegments.length).fill(true)
              ),
                scrollToElementParent('editSegment0', 'smooth', 'start')
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
            @click="
              $store.dispatch(
                'courseSegmentsModule/setShow',
                new Array(courseSegments.length).fill(false)
              )
            "
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
          @click="
            $store.dispatch('courseSegmentsModule/setBlurEnabled', !blurEnabled)
          "
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
          @click="
            $store.dispatch('courseSegmentsModule/setBlurEnabled', !blurEnabled)
          "
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
          @click="
            $store.dispatch(
              'courseSegmentsModule/setStudentViewEnabled',
              !studentViewEnabled
            )
          "
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
          @click="
            $store.dispatch(
              'courseSegmentsModule/setStudentViewEnabled',
              !studentViewEnabled
            )
          "
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
          @click="
            $store.dispatch(
              'courseSegmentsModule/setCheckboxesEnabled',
              !checkboxesEnabled
            )
          "
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
          @click="
            $store.dispatch(
              'courseSegmentsModule/setCheckboxesEnabled',
              !checkboxesEnabled
            )
          "
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
            @click="
              $store.dispatch(
                'courseSegmentsModule/setButtonsEnabled',
                !buttonsEnabled
              )
            "
          >
            Enable
          </button>
        </div>
        <div v-else class="course-setting-button-wrapper">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-danger disabled"
            style="margin: unset !important; width: 100px"
            @click="
              $store.dispatch(
                'courseSegmentsModule/setButtonsEnabled',
                !buttonsEnabled
              )
            "
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
            @click="
              $store.dispatch(
                'courseSegmentsModule/setButtonsEnabled',
                !buttonsEnabled
              )
            "
          >
            Enable
          </button>
        </div>
        <div v-else class="course-setting-button-wrapper">
          <h5>Buttons (only when checkboxes are enabled)</h5>
          <button
            class="btn btn-danger"
            style="margin: unset !important; width: 100px"
            @click="
              $store.dispatch(
                'courseSegmentsModule/setButtonsEnabled',
                !buttonsEnabled
              )
            "
          >
            Disable
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapGetters } from "vuex";

export default {
  props: ["auth_user", "scrollToElementParent", "editAllSegmentsEnabled"],
  computed: {
    ...mapGetters({
      courseSegments: "courseSegmentsModule/courseSegments",
      show: "courseSegmentsModule/show",
      blurEnabled: "courseSegmentsModule/blurEnabled",
      studentViewEnabled: "courseSegmentsModule/studentViewEnabled",
      checkboxesEnabled: "courseSegmentsModule/checkboxesEnabled",
      buttonsEnabled: "courseSegmentsModule/buttonsEnabled",
    }),
  },
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
