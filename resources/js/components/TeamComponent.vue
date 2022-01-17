<template>
  <div>
    <div class="col-md-8 section offset-md-2">
      <div class="panel-heading">
        <h2>
          <strong
            ><span class="team-name text-truncate">{{
              team.name
            }}</span></strong
          >
        </h2>
        <p v-if="team.user != null">
          Team's Author:
          <strong>{{ team.user.name }} {{ team.user.surname }}</strong>
        </p>
        <p v-else>Team's Author: <strong>[deleted user]</strong></p>
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
          <a
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/room"
            style="min-width: 100px"
          >
            ← Back to Course
          </a>
          <a
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/groups"
            style="min-width: 100px"
          >
            ← Back to Groups
          </a>
          <a
            type="submit"
            name="submit"
            class="btn btn-dark mt-4"
            href="/teams"
            style="min-width: 100px"
          >
            ← Back to Teams
          </a>
          <a
            type="submit"
            name="submit"
            class="btn btn-danger mt-4"
            href="#"
            style="min-width: 100px"
            @click="leaveTeam()"
          >
            Leave Team
          </a>
          <button
            v-if="
              (team.user != null && auth_user.id == team.user.id) ||
              auth_user.role_id == 1 ||
              auth_user.role_id == 2
            "
            type="submit"
            name="submit"
            class="btn btn-danger mt-4"
            data-bs-toggle="modal"
            data-bs-target="#ModalDeleteTeam"
            style="min-width: 100px"
          >
            Delete Team
          </button>
          <div
            class="modal fade"
            id="ModalDeleteTeam"
            tabindex="-1"
            aria-labelledby="ModalDeleteTeamLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalDeleteTeamLabel">
                    Delete Team:
                    <strong>{{ team.name }}</strong>
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to Delete Team:
                  <strong>{{ team.name }}</strong
                  >?
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
                    @click="deleteTeam()"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>

          <a
            type="submit"
            name="submit"
            class="btn btn-success mt-4"
            href="#"
            style="min-width: 100px"
            @click="joinTeam()"
          >
            Join Team
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
          width: 57%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a
          v-if="team_users.length == 0"
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
          :href="`/team/${team.id}/users/download`"
        >
          Export List
        </a>

        <button
          type="button"
          class="btn btn-primary mt-4"
          data-bs-toggle="modal"
          data-bs-target="#ModalXl"
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
                  Add Selected Students to Team:
                  <strong>{{ team.name }}</strong>
                </h5>
                <div>
                  <button
                    v-if="selectedStudentsTeamContext == 0"
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
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
              </div>
              <div class="modal-body">
                <table-component
                  :students="all_students"
                  ref="studentsTableRef"
                  context="team"
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
          data-bs-toggle="modal"
          data-bs-target="#Modal"
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
          data-bs-toggle="modal"
          data-bs-target="#ModalAssign"
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
          data-bs-toggle="modal"
          data-bs-target="#ModalRemoveAssign"
        >
          Remove Assigned Project
        </button>
        <div
          class="modal fade"
          id="ModalRemoveAssign"
          tabindex="-1"
          aria-labelledby="ModalRemoveAssignLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalRemoveAssignLabel">
                  Remove Selected Students from an Assigned Project
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                Are you sure you want to Remove Selected Students from an
                Assigned Project?
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
          aria-labelledby="ModalAssignLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalAssignLabel">
                  Assign Selected Students to a Project
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
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
                  data-bs-dismiss="modal"
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
          aria-labelledby="ModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                  Delete Selected Students from Team:
                  <strong>{{ team.name }}</strong>
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                Are you sure you want to Delete Selected Students from Team:
                <strong>{{ team.name }}</strong
                >?
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
        v-else-if="team.user != null && team.user.id == auth_user.id"
        style="
          display: flex;
          flex-grow: 1;
          justify-content: space-around;
          width: 35%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a
          v-if="team_users.length == 0"
          type="submit"
          name="submit"
          class="btn btn-success mt-4 disabled"
          style="min-width: 200px"
        >
          Export List
        </a>
        <a
          v-else
          type="submit"
          name="submit"
          class="btn btn-success mt-4"
          style="min-width: 200px"
          :href="`/team/${team.id}/users/download`"
        >
          Export List
        </a>

        <button
          disabled
          v-if="selectedStudents.length == 0"
          type="submit"
          name="submit"
          style="min-width: 200px"
          class="btn btn-danger mt-4 disabled"
        >
          Delete Selected Students
        </button>
        <button
          v-else
          type="submit"
          name="submit"
          class="btn btn-danger mt-4"
          style="min-width: 200px"
          data-bs-toggle="modal"
          data-bs-target="#Modal"
        >
          Delete Selected Students
        </button>
        <div
          class="modal fade"
          id="Modal"
          tabindex="-1"
          aria-labelledby="ModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">
                  Delete Selected Students from Team:
                  <strong>{{ team.name }}</strong>
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                Are you sure you want to Delete Selected Students from Team:
                <strong>{{ team.name }}</strong
                >?
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
                  @click="onDeleteSelected()"
                >
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p v-if="team_students.length != 0">
        Total Students: <strong>{{ team_students.length }}</strong>
      </p>
      <p v-if="team_professors.length != 0">
        Total Professors: <strong>{{ team_professors.length }}</strong>
      </p>
      <p v-if="team_admins.length != 0">
        Total Admins: <strong>{{ team_admins.length }}</strong>
      </p>
    </div>
    <div class="table-responsive-xl">
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
        <div slot="project.title" slot-scope="props">
          <a
            v-if="props.rowData.project != undefined"
            :href="`/forum/t/${props.rowData.project_id}-${props.rowData.project.title}`"
            >{{ props.rowData.project.title }}</a
          >
          <div v-else></div>
        </div>
        <div slot="actions" slot-scope="props">
          <div
            v-if="auth_user.id == props.rowData.id && auth_user.role_id == 1"
          >
            <button
              @click="onRateStudent(props.rowData)"
              class="ui small button"
              data-bs-toggle="modal"
              data-bs-target="#ModalRate"
              data-whatever="@mdo"
              style="background-color: gold"
            >
              <i class="star icon"></i>
            </button>
          </div>
          <div v-else-if="getRating(props.rowData) != null">
            <div>
              <button
                @click="onRateStudent(props.rowData)"
                class="ui small button"
                data-bs-toggle="modal"
                data-bs-target="#ModalRated"
                data-whatever="@mdo"
                style="padding: 5px; background-color: mediumaquamarine"
              >
                Rated
              </button>
            </div>
          </div>
          <div v-else-if="auth_user.id == props.rowData.id"></div>
          <div v-else>
            <button
              @click="onRateStudent(props.rowData)"
              class="ui small button"
              data-bs-toggle="modal"
              data-bs-target="#ModalRate"
              data-whatever="@mdo"
              style="background-color: gold"
            >
              <i class="star icon"></i>
            </button>
          </div>
        </div>
      </vuetable>
    </div>
    <div
      class="modal fade"
      id="ModalRated"
      tabindex="-1"
      aria-labelledby="ModalRatedLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="ModalRatedLabel"
              v-if="studentToBeRated.role_id == 1"
            >
              Rated Admin:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <h5
              class="modal-title"
              id="ModalRatedLabel"
              v-else-if="studentToBeRated.role_id == 2"
            >
              Rated Professor:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <h5 class="modal-title" id="ModalRatedLabel" v-else>
              Rated Student:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div>
                <label class="col-form-label"
                  >Grade:
                  <strong> {{ getGrade(studentToBeRated) }}</strong></label
                >
              </div>
              <div>
                <label class="col-form-label"
                  >Comment: <strong>{{ getComment(studentToBeRated) }}</strong>
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="ModalRate"
      tabindex="-1"
      aria-labelledby="ModalRateLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="ModalRateLabel"
              v-if="studentToBeRated.role_id == 1"
            >
              Rate Admin:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <h5
              class="modal-title"
              id="ModalRateLabel"
              v-else-if="studentToBeRated.role_id == 2"
            >
              Rate Professor:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <h5 class="modal-title" id="ModalRateLabel" v-else>
              Rate Student:
              <strong
                >{{ studentToBeRated.name }} {{ studentToBeRated.surname }}
              </strong>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <star-rating
              :max-rating="10"
              :star-size="20"
              @rating-selected="setRating"
            ></star-rating>
            <div class="form-group">
              <label class="col-form-label">Comment:</label>

              <input
                required
                type="text"
                class="form-control"
                id="comment"
                aria-describedby="nameHelp"
                placeholder="Enter comment"
                ref="comment"
              />
            </div>
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
              class="btn btn-primary"
              @click="rateStudent()"
            >
              Rate
            </button>
          </div>
        </div>
      </div>
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
    "all_students",
    "team_users",
    "team_students",
    "team_professors",
    "team_admins",
    "team",
    "auth_user",
    "ratings",
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
          this.selectedStudentsTeamContext = val;
        }
      );
    }
  },

  data() {
    return {
      fields: getFields(
        this.auth_user.role_id == 1 ||
          this.auth_user.role_id == 2 ||
          this.auth_user.team_id == this.team.id,
        this.auth_user.role_id != 3 ||
          (this.team.user != null && this.auth_user.id == this.team.user.id)
      ),
      selectedStudents: [],
      selectedStudentsTeamContext: [],
      studentToBeRated: {},
      rating: 0,
    };
  },

  methods: {
    onRowClass(user, index) {
      if (user.id == this.auth_user.id) {
        return "color-aliceblue";
      }
      if (user.id == this.team.user.id) {
        return "color-palegreen";
      }
      if (user.role_id == 1) {
        return "color-palevioletred";
      } else if (user.role_id == 2) {
        return "color-blanchedalmond";
      }
    },
    dataManager(sortOrder) {
      if (this.team_users.length < 1) return;

      let local = this.team_users;

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
        .post(`/team/${this.team.id}/students`, data)
        .then(() => location.reload());
    },
    addStudents() {
      const data = this.$refs.studentsTableRef.$data.selectedStudents.map(
        (id) => ({ action: "add", studentId: id })
      );
      axios
        .post(`/team/${this.team.id}/students`, data)
        .then(() => location.reload());
    },
    setRating(rating) {
      this.rating = rating;
    },
    onRateStudent(student) {
      this.studentToBeRated = student;
    },
    rateStudent() {
      const data = {
        studentId: this.studentToBeRated.id,
        grade: this.rating,
        comment: this.$refs.comment.value,
      };
      axios
        .post(
          `/team/${this.team.id}/student/${this.studentToBeRated.id}/rating`,
          data
        )
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
    },
    leaveTeam() {
      const data = [
        {
          action: "delete",
          studentId: this.auth_user.id,
        },
      ];
      axios
        .post(`/team/${this.team.id}/students`, data)
        .then(() => location.reload());
    },
    joinTeam() {
      const data = [
        {
          action: "join",
          studentId: this.auth_user.id,
        },
      ];
      axios
        .post(`/team/${this.team.id}/students`, data)
        .then(() => location.reload());
    },
    deleteTeam() {
      axios
        .delete(`/team/${this.team.id}`)
        .then(() => location.assign("/teams"));
    },
    getRating(student) {
      return this.ratings.find((rating) => rating.user_id == student.id);
    },
    getGrade(student) {
      return this.getRating(student)?.grade;
    },
    getComment(student) {
      return this.getRating(student)?.comment;
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

.filled {
  fill: currentColor;
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
.vuetable-th-gutter {
  width: 0;
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
.color-palegreen {
  background-color: palegreen;
}
.team-name {
  display: block;
}
</style>
