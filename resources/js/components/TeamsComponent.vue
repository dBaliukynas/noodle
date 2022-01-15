<template>
  <div>
    <div
      style="
        display: flex;
        align-items: center;
        flex-direction: column;
        flex-wrap: wrap;
      "
    >
      <div
        style="
          display: flex;
          flex-grow: 1;
          justify-content: space-around;
          width: 55%;
          margin-bottom: 10px;
          flex-wrap: wrap;
        "
      >
        <a type="submit" name="submit" class="btn btn-dark mt-4" href="/room">
          ← Back to Room
        </a>
        <a type="submit" name="submit" class="btn btn-dark mt-4" href="/groups">
          ← Back to Groups
        </a>
        <a
          type="submit"
          name="submit"
          class="btn btn-success mt-4"
          data-bs-toggle="modal"
          data-bs-target="#Modal"
          href="#"
        >
          Create Team
        </a>
      </div>
      <p v-if="allTeams.length != 0">
        Total Teams: <strong>{{ allTeams.length }}</strong>
      </p>
      <p v-else>No Teams are created yet</p>
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
              <h5 class="modal-title" id="ModalLabel">Create Team</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label"
                  >Team Name:</label
                >
                <input type="text" class="form-control" id="name" ref="name" />
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
                class="btn btn-success"
                @click="createTeam()"
                href="#"
              >
                Create Team
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="display: flex; margin-top: 20px; justify-content: center">
      <a
        v-for="(team, index) in allTeams"
        :key="team.id"
        type="button"
        class="btn btn-primary team_button"
        style="min-width: 350px; display: flex"
        :href="`/team/${team.id}`"
        ><span class="team-name text-truncate-teams-page"
          >{{ team.name }}
        </span>
        <strong style="margin-left: auto">{{
          all_team_users_count[index]
        }}</strong>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="20"
          height="20"
          viewBox="0 0 24 24"
          fill="none"
          stroke="#ffffff"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle></svg
      ></a>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: ["teams", "user", "new_team", "all_team_users_count"],

  data() {
    return {
      allTeams: this.teams,
    };
  },

  methods: {
    createTeam() {
      const data = {
        name: this.$refs.name.value,
      };
      axios
        .post("/teams", data)
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
    },
  },
};
</script>

<style>
.text-truncate-teams-page {
  max-width: 290px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
@media only screen and (max-width: 420px) {
  .team_button {
    min-width: 265px !important;
  }
  .teams-upper-wrapper {
    display: flex !important;
    justify-content: center !important;
  }
  .text-truncate-teams-page {
    max-width: 200px;
  }
}
</style>
