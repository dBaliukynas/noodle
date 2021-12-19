<template>
  <div>
    <div
      style="display: flex; align-items: center; flex-direction: column"
      v-if="context == 'room'"
    >
      <div
        v-if="auth_user.role_id != 3"
        style="
          display: flex;
          flex-grow: 1;
          justify-content: space-around;
          width: 65%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a
          v-if="students.length == 0"
          type="submit"
          name="submit"
          class="btn btn-success mt-4 disabled"
        >
          Export List
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-success mt-4"
          href="/room/students/download"
        >
          Export List
        </a>
        <a
          v-if="students.length == 0"
          type="submit"
          name="submit"
          class="btn btn-dark mt-4 disabled"
        >
          Go to Groups
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          href="/groups"
        >
          Go to Groups
        </a>

        <a
          v-if="students.length == 0"
          type="submit"
          name="submit"
          class="btn btn-dark mt-4 disabled"
        >
          Go to Teams
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          href="/teams"
        >
          Go to Teams
        </a>
        <button
          disabled
          v-if="selectedStudents.length == 0"
          type="submit"
          name="submit"
          class="btn btn-danger mt-4 disabled"
        >
          Delete Selected Students
        </button>
        <button
          v-else
          type="submit"
          name="submit"
          class="btn btn-danger mt-4"
          data-toggle="modal"
          data-target="#Modal"
        >
          Delete Selected Students
        </button>
        <button
          disabled
          v-if="selectedStudents.length == 0"
          type="submit"
          name="submit"
          class="btn btn-primary mt-4 disabled"
        >
          Assign Project
        </button>
        <button
          v-else
          type="submit"
          name="submit"
          class="btn btn-primary mt-4"
          data-toggle="modal"
          data-target="#ModalAssign"
        >
          Assign Project
        </button>
        <button
          disabled
          v-if="selectedStudents.length == 0"
          type="submit"
          name="submit"
          class="btn btn-danger mt-4 disabled"
        >
          Remove Assigned Project
        </button>
        <button
          v-else
          type="submit"
          name="submit"
          class="btn btn-danger mt-4"
          data-toggle="modal"
          data-target="#ModalRemoveAssign"
        >
          Remove Assigned Project
        </button>
        <div
          class="modal fade"
          id="ModalRemoveAssign"
          tabindex="-1"
          role="dialog"
          aria-labelledby="ModalRemoveAssignLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalRemoveAssignLabel">
                  Remove Selected Students from an Assigned Project
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to Remove Selected Students from an
                Assigned Project?
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="removeAssignedProject()"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="modal fade"
          id="ModalAssign"
          tabindex="-1"
          role="dialog"
          aria-labelledby="ModalAssignLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalAssignLabel">
                  Assign Selected Students to a Project
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to Assign Selected Students to a Project?

                <select class="form-control" ref="rate">
                  <option
                    v-for="forum_thread in forum_threads"
                    :key="forum_thread.id"
                    :value="forum_thread.id"
                  >
                    {{ forum_thread.title }}
                  </option>
                </select>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                  @click="assignProject()"
                >
                  Assign
                </button>
              </div>
            </div>
          </div>
        </div>
        <div
          class="modal fade"
          id="Modal"
          tabindex="-1"
          role="dialog"
          aria-labelledby="ModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                  Delete Selected Students
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to Delete Selected Students?
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="onDeleteSelected()"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        v-else
        style="
          display: flex;
          flex-grow: 1;
          justify-content: space-around;
          width: 45%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a
          v-if="students.length == 0"
          type="submit"
          name="submit"
          class="btn btn-dark mt-4 disabled"
          style="min-width: 250px"
        >
          Go to Groups
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          style="min-width: 250px"
          href="/groups"
        >
          Go to Groups
        </a>
        <a
          v-if="students.length == 0"
          type="submit"
          name="submit"
          class="btn btn-dark mt-4 disabled"
          style="min-width: 250px"
        >
          Go to Teams
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          style="min-width: 250px"
          href="/teams"
        >
          Go to Teams
        </a>
      </div>
      <p v-if="students.length != 0">
        Total Students: <strong>{{ students.length }}</strong>
      </p>
    </div>
    <div v-if="context == 'project'"></div>

    <div class="table-responsive">
      <vuetable
        ref="vuetable"
        :api-mode="false"
        :fields="fields"
        :data-manager="dataManager"
        :row-class="onRowClass"
      >
        <div slot="group.name" slot-scope="props">
          <a
            v-if="props.rowData.group != undefined"
            :href="`/group/${props.rowData.group_id}`"
            >{{ props.rowData.group.name }}</a
          >
          <div v-else></div>
        </div>
        <div slot="team.name" slot-scope="props">
          <a
            v-if="props.rowData.team != undefined"
            :href="`/team/${props.rowData.team_id}`"
            >{{ props.rowData.team.name }}</a
          >
          <div v-else></div>
        </div>
        <div slot="project.title" slot-scope="props">
          <a
            v-if="props.rowData.project != undefined"
            :href="`/forum/t/${props.rowData.project_id}-${props.rowData.project.title}`"
            >{{ props.rowData.project.title }}</a
          >
          <div v-else></div>
        </div>
      </vuetable>
    </div>
  </div>
</template>

<script>
import Vuetable from "vuetable-2";
import axios from "axios";
import _ from "lodash";
import { getFields } from "./TableComponent.fields";

export default {
  props: ["students", "context", "auth_user", "forum_threads"],

  components: {
    Vuetable,
  },

  mounted() {
    this.$watch(
      () => {
        return this.$refs.vuetable.selectedTo;
      },
      (val) => {
        this.selectedStudents = val;
      }
    );
  },

  data() {
    return {
      fields: getFields(
        false,
        this.auth_user.role_id != 3 && this.context != "project"
      ),
      selectedStudents: [],
    };
  },

  methods: {
    onRowClass(user, index) {
      if (user.id == this.auth_user.id) {
        return "color-aliceblue";
      }
      if (user.role_id == 1) {
        return "color-palevioletred";
      } else if (user.role_id == 2) {
        return "color-blanchedalmond";
      }
    },

    dataManager(sortOrder) {
      if (this.students.length < 1) return;

      let local = this.students;

      // sortOrder can be empty, so we have to check for that as well
      if (sortOrder.length > 0) {
        local = _.orderBy(
          local,
          sortOrder[0].sortField,
          sortOrder[0].direction
        );
      }

      return {
        data: local,
      };
    },
    onDeleteSelected() {
      const tasks = this.$refs.vuetable.selectedTo.map((studentId) =>
        axios.delete(`/room/student/${studentId}`)
      );
      Promise.all(tasks).then(() => location.reload());
    },
    assignProject() {
      const tasks = this.$refs.vuetable.selectedTo.map((studentId) =>
        axios.post(
          `/room/student/${studentId}/project/${this.$refs.rate.value}`
        )
      );
      Promise.all(tasks).then(() => location.reload());
    },
    removeAssignedProject() {
      const tasks = this.$refs.vuetable.selectedTo.map((studentId) =>
        axios.delete(
          `/room/student/${studentId}/project/${this.$refs.rate.value}`
        )
      );
      Promise.all(tasks).then(() => location.reload());
    },
  },
};
</script>

<style>
button.ui.button {
  padding: 8px 3px 8px 10px;
  margin-top: 1px;
  margin-bottom: 1px;
}

td.small {
  width: 35px;
  vertical-align: middle;
}

th.small {
  width: 35px;
  vertical-align: middle;
}
td.medium {
  width: 150px;
  vertical-align: middle;
}

th.medium {
  width: 150px;
  vertical-align: middle;
}

td.large {
  width: 300px;
  vertical-align: middle;
}

th.large {
  width: 300px;
  vertical-align: middle;
}
.color-aliceblue {
  background-color: aliceblue;
}
.color-blanchedalmond {
  background-color: blanchedalmond;
}
.color-palevioletred {
  background-color: palevioletred;
}
</style>
