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
        <a type="submit" name="submit" class="btn btn-dark mt-4" href="/room">
          ← Back to Room
        </a>
        <a type="submit" name="submit" class="btn btn-dark mt-4" href="/teams">
          Go to Teams
        </a>
        <a
          type="submit"
          name="submit"
          class="btn btn-success mt-4"
          data-bs-toggle="modal"
          data-bs-target="#Modal"
          href="#"
        >
          Create Group
        </a>
      </div>
      <div
        v-else
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
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          href="/room"
          style="min-width: 200px"
        >
          ← Back to Room
        </a>
        <a
          type="submit"
          name="submit"
          class="btn btn-dark mt-4"
          href="/teams"
          style="min-width: 200px"
        >
          Go to Teams
        </a>
      </div>
      <p v-if="allGroups.length != 0">
        Total Groups: <strong>{{ allGroups.length }}</strong>
      </p>
      <p v-else>No Groups are created yet</p>

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
              <h5 class="modal-title" id="ModalLabel">Create Group</h5>
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
                  >Group Name:</label
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
                @click="createGroup()"
                href="#"
              >
                Create Group
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="display: flex; margin-top: 20px; justify-content: center">
      <a
        v-for="(group, index) in allGroups"
        :key="group.id"
        type="button"
        class="btn btn-primary group_button"
        style="min-width: 350px; display: flex"
        :href="`/group/${group.id}`"
        ><span class="group-name text-truncate-groups-page"
          >{{ group.name }}
        </span>
        <strong style="margin-left: auto">{{
          all_group_users_count[index]
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
  props: ["groups", "auth_user", "all_group_users_count"],

  data() {
    return {
      allGroups: this.groups,
    };
  },

  methods: {
    createGroup() {
      const data = {
        name: this.$refs.name.value,
      };
      axios
        .post("/groups", data)
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
    },
  },
};
</script>

<style>
.text-truncate-groups-page {
  max-width: 290px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
@media only screen and (max-width: 420px) {
  .group_button {
    min-width: 265px !important;
  }
  .groups-upper-wrapper {
    display: flex !important;
    justify-content: center !important;
  }
  .text-truncate-groups-page {
    max-width: 200px;
  }
}
</style>
