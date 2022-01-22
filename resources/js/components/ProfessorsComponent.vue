<template>
  <div>
    <div
      class="ui container"
      style="
        width: unset !important;
        padding-left: unset !important;
        padding-right: unset !important;
      "
    >
      <div style="display: flex; align-items: center; flex-direction: column">
        <div
          v-if="auth_user.role_id == 1"
          style="
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
            width: 30%;
            margin-bottom: 10px;
            flex-wrap: wrap;
          "
          class="professors-table-button-wrapper"
        >
          <a
            v-if="professors.length == 0"
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
            :href="`/professors/download`"
          >
            Export List
          </a>
          <button
            disabled
            v-if="selectedProfessors.length == 0"
            type="submit"
            name="submit"
            class="btn btn-danger mt-4 disabled"
          >
            Delete Selected Professors
          </button>
          <button
            v-else
            type="submit"
            name="submit"
            class="btn btn-danger mt-4"
            data-bs-toggle="modal"
            data-bs-target="#deleteProfessorsModal"
          >
            Delete Selected Professors
          </button>
          <div
            class="modal fade"
            id="deleteProfessorsModal"
            tabindex="-1"
            aria-labelledby="deleteProfessorsModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteProfessorsModalLabel">
                    Delete Selected Professors
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to Delete Selected Professors?
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
        <p v-if="professors.length != 0">
          Total Professors: <strong>{{ professors.length }}</strong>
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
        </vuetable>
      </div>
    </div>
  </div>
</template>

 <script>
import Vuetable from "vuetable-2";
import axios from "axios";
import _ from "lodash";
import { getFields } from "./ProfessorsTableComponent.fields";

export default {
  props: ["professors", "auth_user"],

  components: {
    Vuetable,
  },

  mounted() {
    this.$watch(
      () => {
        return this.$refs.vuetable.selectedTo;
      },
      (val) => {
        this.selectedProfessors = val;
      }
    );
  },

  data() {
    return {
      fields: getFields(this.auth_user.role_id == 1),
      selectedProfessors: [],
    };
  },

  methods: {
    onRowClass(user, index) {
      if (user.id == this.auth_user.id) {
        return "color-aliceblue";
      } else {
        return "color-lightskyblue";
      }
    },

    dataManager(sortOrder) {
      if (this.professors.length < 1) return;

      let local = this.professors;

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
      const tasks = this.$refs.vuetable.selectedTo.map((professorId) =>
        axios.delete(`/professors/professor/${professorId}`)
      );
      Promise.all(tasks)
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
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
.vuetable-th-gutter {
  width: 0;
}
.color-lightskyblue {
  background-color: lightskyblue;
}
.color-aliceblue {
  background-color: aliceblue;
}
@media only screen and (max-width: 800px) {
  .professors-table-button-wrapper {
    flex-direction: column !important;
    width: auto !important;
  }
}
</style>
