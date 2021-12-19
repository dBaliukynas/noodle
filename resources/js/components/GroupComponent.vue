<template>
  <div>
    <div class="col-md-8 section offset-md-2">
      <div class="panel-heading">
        <h2>
          Group: <strong>{{ group.name }}</strong>
        </h2>
        <p v-if="group.user != null">
          Group's Author:
          <strong>{{ group.user.name }} {{ group.user.surname }}</strong>
        </p>
        <p v-else>
          Group's Author:
          <strong>[deleted user]</strong>
        </p>
      </div>
      <div style="display: flex; align-items: center; flex-direction: column">
        <div
          style="
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
            width: 90%;
            margin-bottom: 10px;
            flex-wrap: wrap;
          "
        >
          <a type="submit" name="submit" class="btn btn-dark mt-4" href="/room">
            ← Back to Room
          </a>
          <a
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/groups"
          >
            ← Back to Groups
          </a>
          <a
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/teams"
          >
            ← Back to Teams
          </a>
          <button
            v-if="auth_user.role_id == 1 || auth_user.role_id == 2"
            type="submit"
            name="submit"
            class="btn btn-danger mt-4"
            data-toggle="modal"
            data-target="#ModalDeleteGroup"
          >
            Delete Group
          </button>
          <div
            class="modal fade"
            id="ModalDeleteGroup"
            tabindex="-1"
            role="dialog"
            aria-labelledby="ModalDeleteGroupLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalDeleteGroupLabel">
                    Delete Group:
                    <strong>{{ group.name }}</strong>
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
                  Are you sure you want to Delete Group:
                  <strong>{{ group.name }}</strong
                  >?
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
                    @click="deleteGroup()"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
          <a
            v-if="auth_user.role_id == 1 || auth_user.role_id == 2"
            type="submit"
            name="submit"
            class="btn btn-success mt-4"
            href="#"
            @click="joinGroup()"
          >
            Join Group
          </a>
          <a
            v-if="auth_user.role_id == 1 || auth_user.role_id == 2"
            type="submit"
            name="submit"
            class="btn btn-danger mt-4"
            href="#"
            @click="leaveGroup()"
          >
            Leave Group
          </a>
        </div>
      </div>
    </div>
    <div style="display: flex; align-items: center; flex-direction: column">
      <div
        v-if="auth_user.role_id != 3"
        style="
          display: flex;
          flex-grow: 1;
          justify-content: space-around;
          width: 55%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a
          v-if="group_users.length == 0"
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
          :href="`/group/${group.id}/users/download`"
        >
          Export List
        </a>

        <button
          type="button"
          class="btn btn-primary mt-4"
          data-toggle="modal"
          data-target="#ModalXl"
        >
          Add Students
        </button>

        <div
          class="modal fade"
          id="ModalXl"
          tabindex="-1"
          aria-labelledby="ModalXlLabel"
          style="display: none"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title h4" id="ModalXlLabel">
                  Add Selected Students to Group:
                  <strong>{{ group.name }}</strong>
                </h5>
                <div>
                  <button
                    v-if="selectedStudentsGroupContext == 0"
                    type="button"
                    class="btn btn-primary disabled"
                  >
                    Add Selected Students
                  </button>
                  <button
                    v-else
                    type="button"
                    class="btn btn-primary"
                    @click="addStudents()"
                  >
                    Add Selected Students
                  </button>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              </div>
              <div class="modal-body">
                <table-component
                  :students="all_students"
                  ref="studentsTableRef"
                  context="group"
                  :auth_user="auth_user"
                ></table-component>
              </div>
            </div>
          </div>
        </div>

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
                  Delete Selected Students from Group:
                  <strong>{{ group.name }}</strong>
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
                Are you sure you want to Delete Selected Students from Group:
                <strong>{{ group.name }}</strong
                >?
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
      <p v-if="group_students.length != 0">
        Total Students: <strong>{{ group_students.length }}</strong>
      </p>
      <p v-if="group_professors.length != 0">
        Total Professors: <strong>{{ group_professors.length }}</strong>
      </p>
      <p v-if="group_admins.length != 0">
        Total Admins: <strong>{{ group_admins.length }}</strong>
      </p>
    </div>
    <div class="table-responsive">
      <vuetable
        ref="vuetable"
        :api-mode="false"
        :fields="fields"
        :data-manager="dataManager"
        :row-class="onRowClass"
      >
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
  props: [
    "group_users",
    "group_students",
    "group_professors",
    "group_admins",
    "all_students",
    "group",
    "auth_user",
    "forum_threads",
  ],

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
    if (this.auth_user.role_id == 1 || this.auth_user.role_id == 2) {
      this.$watch(
        () => {
          return this.$refs.studentsTableRef.$data.selectedStudents;
        },
        (val) => {
          this.selectedStudentsGroupContext = val;
        }
      );
    }
  },

  data() {
    return {
      fields: getFields(false, this.auth_user.role_id != 3),
      selectedStudents: [],
      selectedStudentsGroupContext: [],
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
      if (this.group_users.length < 1) return;

      let local = this.group_users;

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
      const data = this.$refs.vuetable.selectedTo.map((id) => ({
        action: "delete",
        studentId: id,
      }));
      axios
        .post(`/group/${this.group.id}/students`, data)
        .then(() => location.reload());
    },
    addStudents() {
      const data = this.$refs.studentsTableRef.$data.selectedStudents.map(
        (id) => ({ action: "add", studentId: id })
      );
      axios
        .post(`/group/${this.group.id}/students`, data)
        .then(() => location.reload());
    },
    deleteGroup() {
      axios
        .delete(`/group/${this.group.id}`)
        .then(() => location.assign("/groups"));
    },
    joinGroup() {
      const data = [
        {
          action: "add",
          studentId: this.auth_user.id,
        },
      ];
      axios
        .post(`/group/${this.group.id}/students`, data)
        .then(() => location.reload());
    },
    leaveGroup() {
      const data = [
        {
          action: "delete",
          studentId: this.auth_user.id,
        },
      ];
      axios
        .post(`/group/${this.group.id}/students`, data)
        .then(() => location.reload());
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

.modal-xl {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  max-width: 100%;
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
