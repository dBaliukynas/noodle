<template>
  <div>
    <div
      v-if="
        auth_user.role_id != 3 &&
        checkboxesEnabled &&
        show.find((isEnabled) => !isEnabled) != undefined
      "
    >
      <div style="flex-direction: column">
        <h3>Actions with selected segments</h3>
        <div
          v-if="selectedSegmentsLength == null || selectedSegmentsLength == 0"
          style="display: flex"
        >
          <button
            type="button"
            class="btn btn-primary disabled"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <circle cx="12" cy="12" r="10" />
              <path d="M16 12l-4-4-4 4M12 16V9" />
            </svg>
            <span>Pin</span>
          </button>
          <button
            type="button"
            class="btn btn-primary disabled"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 5px"
            >
              <svg height="23.5" width="23.5">
                <line x1="0" y1="0" x2="200" y2="200" />
              </svg>
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <span>Hide</span>
          </button>
          <button
            type="button"
            class="btn btn-primary disabled"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <polyline points="3 6 5 6 21 6"></polyline>
              <path
                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
              ></path>
              <line x1="10" y1="11" x2="10" y2="17"></line>
              <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
            <span>Delete</span>
          </button>
          <button
            type="button"
            class="btn btn-primary disabled"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <path
                d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"
              ></path>
              <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
            </svg>
            <span>Edit</span>
          </button>
        </div>
        <div v-else style="display: flex">
          <button
            type="button"
            class="btn btn-primary"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <circle cx="12" cy="12" r="10" />
              <path d="M16 12l-4-4-4 4M12 16V9" />
            </svg>
            <span>Pin</span>
          </button>
          <button
            type="button"
            class="btn btn-primary"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 5px"
            >
              <svg height="23.5" width="23.5">
                <line x1="0" y1="0" x2="200" y2="200" />
              </svg>
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <span>Hide</span>
          </button>
          <button
            type="button"
            class="btn btn-primary"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <polyline points="3 6 5 6 21 6"></polyline>
              <path
                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
              ></path>
              <line x1="10" y1="11" x2="10" y2="17"></line>
              <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
            <span>Delete</span>
          </button>
          <button
            type="button"
            class="btn btn-primary"
            style="
              width: 100px;
              margin-right: 4px;
              display: flex;
              justify-content: center;
            "
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="22"
              height="22"
              viewBox="0 0 24 24"
              fill="none"
              stroke="#ffffff"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              style="margin-right: 3px"
            >
              <path
                d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"
              ></path>
              <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
            </svg>
            <span>Edit</span>
          </button>
        </div>
      </div>
      <hr class="my-3" />
    </div>

    <div
      v-if="
        auth_user.role_id != 3 &&
        checkboxesEnabled &&
        show.find((isEnabled) => !isEnabled) != undefined
      "
      style="display: flex; align-items: center"
    >
      <input
        v-if="
          selectedSegmentsLength == null ||
          selectedSegmentsLength == 0 ||
          (allSelected && selectedSegmentsLength == closedSegmentsIds.length)
        "
        type="checkbox"
        v-model="allSelected"
        @change="selectAll"
        style="margin-right: 10px"
      />

      <input
        v-else-if="
          selectedSegmentsLength == closedSegmentsIds.length && !allSelected
        "
        type="checkbox"
        :checked="true"
        @change="selectAll"
        style="margin-right: 10px"
      />
      <input
        v-else
        type="checkbox"
        :indeterminate.prop="true"
        @change="selectAll"
        style="margin-right: 10px"
      /><span>Select all segments</span>
    </div>
    <hr
      class="my-3"
      v-if="
        checkboxesEnabled && show.find((isEnabled) => !isEnabled) != undefined
      "
    />
    <div id="segmentsWrapper" class="segments-wrapper" ref="segmentsWrapper">
      <div
        class="segment-wrapper"
        :id="`segmentWrapper${courseSegment.id}`"
        :ref="`segmentWrapper${courseSegment.id}`"
        style="display: flex; flex-direction: column"
        v-for="(courseSegment, index) in courseSegments"
        :key="courseSegment.id"
      >
        <div
          style="
            display: flex;
            flex-direction: row;
            min-height: 65px;
            position: relative;
          "
          v-bind:style="[
            checkboxesEnabled &&
            selected.find(
              (selectedCourseSegmentId) =>
                selectedCourseSegmentId == courseSegment.id
            )
              ? { 'background-color': 'whitesmoke' }
              : { 'background-color': 'white' },
          ]"
          v-if="!show[index]"
          class="course-segment"
          :ref="`courseSegment${courseSegment.id}`"
          :id="`courseSegment${courseSegment.id}`"
        >
          <div v-if="auth_user.role_id != 3" style="margin-right: 10px">
            <div v-if="checkboxesEnabled">
              <input
                type="checkbox"
                v-model="selected"
                :id="courseSegment.id"
                :value="courseSegment.id"
              />
            </div>
          </div>
          <div
            style="display: flex; flex-direction: column"
            class="segment-name-content-wrapper"
          >
            <div
              class="segment-name-wrapper"
              id="segmentNameWrapper"
              style="margin-bottom: 10px"
            >
              <h3 :id="`segmentName${index}`" class="segment-name">
                {{ courseSegment.name }}
              </h3>
            </div>
            <div class="segment-content-wrapper" id="segmentContentWrapper">
              <p class="segment-content" :id="`segmentContent${index}`">
                {{ courseSegment.content }}
              </p>
            </div>
          </div>

          <div
            style="
              margin-left: auto;
              display: flex;
              flex-direction: row;
              align-items: flex-start;
            "
          >
            <div
              v-if="hiddenSegmentsBooleans[index]"
              title="Hidden"
              v-bind:style="[
                !pinnedSegmentsBooleans[index] &&
                (buttonsEnabled || !checkboxesEnabled)
                  ? { 'margin-right': '20px' }
                  : { 'margin-right': '10px' },
              ]"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="none"
                stroke="#708090"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                id="courseHideSegmentIcon"
                style="display: block"
              >
                <svg height="23.5" width="23.5">
                  <line x1="0" y1="0" x2="200" y2="200" />
                </svg>
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
            </div>
            <div
              v-if="pinnedSegmentsBooleans[index]"
              title="Pinned"
              v-bind:style="[
                (buttonsEnabled || !checkboxesEnabled) && auth_user.role_id != 3
                  ? { 'margin-right': '20px' }
                  : {},
              ]"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="22"
                height="22"
                viewBox="0 0 24 24"
                fill="#ffb800"
                stroke="#ffb800"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                style="display: block"
              >
                <polygon
                  points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"
                ></polygon>
              </svg>
            </div>
            <div
              class="segment-button-wrapper"
              style="display: flex"
              v-if="
                (buttonsEnabled || !checkboxesEnabled) && auth_user.role_id != 3
              "
            >
              <button
                v-if="!pinnedSegmentsBooleans[index]"
                type="button"
                title="Pin"
                class="no-style-button no-blur"
                style="margin-right: 10px"
                @click.once="
                  pinSegment(courseSegment.id),
                    $store.dispatch(
                      'courseSegmentsModule/setPinnedSegmentsBooleans',
                      { index, value: !pinnedSegmentsBooleans[index] }
                    )
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
                  class="course-pin-segment-icon"
                  id="coursePinSegmentIcon"
                  style="display: block"
                >
                  <circle cx="12" cy="12" r="10" />
                  <path d="M16 12l-4-4-4 4M12 16V9" />
                </svg>
              </button>
              <button
                v-else
                type="button"
                title="Unpin"
                class="no-style-button no-blur"
                style="margin-right: 10px"
                @click="
                  $store.dispatch(
                    'courseSegmentsModule/setPinnedSegmentsBooleans',
                    { index, value: !pinnedSegmentsBooleans[index] }
                  )
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
                  class="course-pin-segment-icon"
                  id="coursePinSegmentIcon"
                  style="display: block"
                >
                  <circle cx="12" cy="12" r="10" />
                  <path d="M16 12l-4 4-4-4M12 8v7" />
                </svg>
              </button>

              <button
                v-if="!hiddenSegmentsBooleans[index]"
                type="button"
                title="Hide"
                class="no-style-button no-blur"
                style="margin-right: 10px"
                :id="`${courseSegments[index].id}`"
                @click="
                  hideSegment(courseSegment.id),
                    $store.dispatch(
                      'courseSegmentsModule/setHiddenSegmentsBooleans',
                      { index, value: !hiddenSegmentsBooleans[index] }
                    )
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
                  class="course-hide-segment-icon"
                  id="courseHideSegmentIcon"
                  style="display: block"
                >
                  <svg height="23.5" width="23.5">
                    <line x1="0" y1="0" x2="200" y2="200" />
                  </svg>
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
              <button
                v-else
                type="button"
                title="Reveal"
                class="no-style-button no-blur"
                style="margin-right: 10px"
                :id="`${courseSegments[index].id}`"
                @click="
                  hideSegment(courseSegment.id),
                    $store.dispatch(
                      'courseSegmentsModule/setHiddenSegmentsBooleans',
                      { index, value: !hiddenSegmentsBooleans[index] }
                    )
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
                  class="course-hide-segment-icon"
                  id="courseHideSegmentIcon"
                  style="display: block"
                >
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>
              </button>
              <button
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#deleteSegmentModal"
                title="Delete"
                class="no-style-button no-blur"
                style="margin-right: 10px"
                :id="`${courseSegments[index].id}`"
                @click="deleteCourseSegmentId = courseSegment.id"
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
                  class="course-delete-segment-icon"
                  id="courseDeleteSegmentIcon"
                  style="display: block"
                >
                  <polyline points="3 6 5 6 21 6"></polyline>
                  <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                  ></path>
                  <line x1="10" y1="11" x2="10" y2="17"></line>
                  <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
              </button>
              <button
                title="Edit"
                class="no-style-button no-blur"
                @click="
                  $store.dispatch('courseSegmentsModule/updateShow', {
                    index,
                    value: !show[index],
                  }),
                    scrollToElementParent(
                      'editSegment' + index,
                      'smooth',
                      'start'
                    ),
                    deleteFromclosedSegmentsIds(courseSegment.id)
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
                  class="course-edit-segment-icon"
                  id="courseEditSegmentIcon"
                  style="display: block"
                >
                  <path
                    d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"
                  ></path>
                  <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div v-else :id="`editSegment${index}`" class="edit-segment">
          <div v-if="auth_user.role_id != 3">
            <div class="mb-3">
              <div style="display: flex">
                <button
                  class="no-style-button course-close"
                  id="buttonCourseCloseEdit"
                  style="margin-left: auto"
                  @click="
                    $store.dispatch('courseSegmentsModule/updateShow', {
                      index,
                      value: !show[index],
                    }),
                      pushToclosedSegmentsIds(courseSegment.id)
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
                    style="display: block"
                    class="course-close-segment-icon"
                    :id="`courseCloseSegmentEditIcon${index}`"
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
                class="form-control form-control-lg segment-name"
                :id="`segmentName${index}`"
                :ref="`segmentName${index}`"
                type="text"
                :value="`${courseSegment.name}`"
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
                  :value="`${courseSegment.content}`"
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
        </div>
        <hr class="my-3" />
      </div>
    </div>
    <div
      style="display: flex"
      v-if="!showCreateSegment"
      class="create-segment-wrapper"
      id="createSegmentWrapper"
    >
      <div
        v-if="auth_user.role_id != 3"
        style="display: flex; margin-left: auto"
      >
        <button
          class="no-style-button"
          title="Create new segment"
          @click="
            (showCreateSegment = !showCreateSegment),
              scrollToElementParent('createSegment', 'smooth', 'start')
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
            class="course-add-segment-icon"
            style="display: block"
          >
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
        </button>
      </div>
    </div>
    <div v-else id="createSegment" class="create-segment">
      <div v-if="auth_user.role_id != 3">
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
                style="display: block"
                class="course-close-segment-icon"
                id="courseCloseSegmentIcon"
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
            class="form-control form-control-lg new-segment-name"
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
    <div
      class="modal fade"
      id="deleteSegmentModal"
      tabindex="-1"
      aria-labelledby="deleteSegmentModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteSegmentModalLabel">
              Delete a segment
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete a segment?
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
              class="btn btn-danger"
              @click="deleteSegment()"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapGetters } from "vuex";

export default {
  props: ["auth_user", "scrollToElementParent", "course"],
  data() {
    return {
      showCreateSegment: false,
      deleteCourseSegmentId: null,
      selected: [],
      allSelected: false,
      selectedSegmentsLength: null,
    };
  },
  computed: {
    ...mapGetters({
      courseSegments: "courseSegmentsModule/courseSegments",
      show: "courseSegmentsModule/show",
      checkboxesEnabled: "courseSegmentsModule/checkboxesEnabled",
      buttonsEnabled: "courseSegmentsModule/buttonsEnabled",
      closedSegmentsIds: "courseSegmentsModule/closedSegmentsIds",
      pinnedSegmentsBooleans: "courseSegmentsModule/pinnedSegmentsBooleans",
      hiddenSegmentsBooleans: "courseSegmentsModule/hiddenSegmentsBooleans",
    }),
  },
  watch: {
    selected(val) {
      this.selectedSegmentsLength = val.length;

      if (this.selectedSegmentsLength != this.closedSegmentsIds.length) {
        this.allSelected = false;
      }
    },
    allSelected(val) {},
  },
  methods: {
    selectAll() {
      if (this.allSelected) {
        this.selected = [...this.closedSegmentsIds];
      } else {
        this.selected = [];
      }
    },

    // changeEditSegmentBoolean(value) {
    //   this.visibleEditSegment = value;
    // },
    // changeCreateSegmentBoolean(value) {
    //   this.visibleCreateSegment = value;
    // },
    // async blur(recentValue) {
    //   if (!(this.visibleEditSegment || this.visibleCreateSegment)) {
    //     setTimeout(() => {
    //       document
    //         .querySelectorAll(
    //           "div.non-segments-wrapper, div.course-image-wrapper"
    //         )
    //         .forEach((element) =>
    //           element.classList.remove("no-user-interaction")
    //         );
    //       document
    //         .querySelectorAll(".my-3")
    //         .forEach((hrElement) => hrElement.classList.remove("blur-hr"));
    //       document
    //         .getElementById("segmentNameContentWrapper")
    //         .classList.remove("blur");
    //       document

    //         .getElementById("nonSegmentsWrapper")
    //         .classList.remove("blur");
    //       document
    //         .getElementById("courseImageWrapper")
    //         .classList.remove("blur");
    //     }, 1);
    //   } else {
    //     await setTimeout(() => {
    //       document.getElementById("nonSegmentsWrapper").classList.add("blur");
    //       document.getElementById("courseImageWrapper").classList.add("blur");
    //       document
    //         .querySelectorAll(".my-3")
    //         .forEach((hrElement) => hrElement.classList.add("blur-hr"));

    //       document
    //         .querySelectorAll(
    //           "div.non-segments-wrapper, div.course-image-wrapper, div.segment-name-content-wrapper"
    //         )
    //         .forEach((element) => element.classList.add("no-user-interaction"));
    //     }, 1);
    //     if (this.visibleEditSegment && this.visibleCreateSegment) {
    //       if (recentValue == "create") {
    //         document.getElementById("createSegment").className = "no-blur";
    //         document.getElementById("editSegment").className = "blur";
    //       } else {
    //         document.getElementById("createSegment").className = "blur";
    //         document.getElementById("editSegment").className = "no-blur";
    //       }
    //     } else {
    //       if (recentValue == "create") {
    //         document.getElementById("createSegment").className = "no-blur";
    //         document
    //           .getElementById("segmentNameContentWrapper")
    //           .classList.add("blur");
    //       } else {
    //         document.getElementById("editSegment").className = "no-blur";
    //       }
    //     }
    //   }
    // },
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
    hideSegment(courseSegmentId) {},
    pinSegment(courseSegmentId) {
      let childElement = document.getElementById(
        `segmentWrapper${courseSegmentId}`
      );

      let parentElement = document.getElementById("segmentsWrapper");

      parentElement.prepend(childElement);
      childElement.classList.add("pinned");
    },

    deleteSegment() {
      axios
        .delete(
          `/course/${this.course.id}/segment/${this.deleteCourseSegmentId}`
        )
        .then(() => location.reload());
    },
    deleteFromclosedSegmentsIds(courseSegmentId) {
      this.allSelected = false;
      const indexOfClosedSegmentId =
        this.closedSegmentsIds.indexOf(courseSegmentId);
      const indexOfSelectedSegmentId = this.selected.indexOf(courseSegmentId);

      this.closedSegmentsIds.splice(indexOfClosedSegmentId, 1);
      if (indexOfSelectedSegmentId != -1) {
        this.selected.splice(indexOfSelectedSegmentId, 1);
      }
    },
    pushToclosedSegmentsIds(courseSegmentId) {
      this.allSelected = false;
      this.closedSegmentsIds.push(courseSegmentId);
    },
  },
};
</script>

<style>
.course-edit-segment-icon {
  transition: 0.1s ease-out;
}
.course-edit-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-add-segment-icon {
  transition: 0.1s ease-out;
}
.course-add-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-delete-segment-icon {
  transition: 0.1s ease-out;
}
.course-delete-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-hide-segment-icon {
  transition: 0.1s ease-out;
}
.course-hide-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-pin-segment-icon {
  transition: 0.1s ease-out;
}
.course-pin-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-close-segment-icon {
  transition: 0.1s ease-out;
}
.course-close-segment-icon:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.course-close {
  transition: 0.1s ease-out;
}
.course-close:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
.segment-name {
  font-size: 1.75rem;
}
.new-segment-name {
  font-size: 1.75rem !important;
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
  .segment-button-wrapper {
    flex-direction: column;
  }
  .course-hide-segment-icon {
    margin-top: 2px;
  }
  .course-delete-segment-icon {
    margin-top: 2px;
  }
  .course-edit-segment-icon {
    margin-top: 2px;
  }
}
@media only screen and (max-width: 800px) {
  .segment-name {
    text-align: center;
  }
  .new-segment-name {
    text-align: center;
  }
  .segment-wrapper {
    justify-content: center;
  }
  .segment-name-content-wrapper {
    margin-left: auto;
    position: relative;
    left: 54px;
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
</style>
