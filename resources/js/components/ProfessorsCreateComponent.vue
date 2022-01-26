<template>
  <div>
    <div v-if="auth_user.role_id == 1">
      <h4>Create a professor</h4>
      <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#professorsCreateModal"
        class="no-style-button"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="45"
          height="45"
          viewBox="0 0 24 24"
          fill="none"
          stroke="#0d6efd"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="professors-create-button"
        >
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <line x1="20" y1="8" x2="20" y2="14"></line>
          <line x1="23" y1="11" x2="17" y2="11"></line>
        </svg>
      </button>
    </div>
    <div
      class="modal fade"
      id="professorsCreateModal"
      tabindex="-1"
      aria-labelledby="professorsCreateModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="professorsCreateModalLabel">
              Create a professor
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="panel-body">
              <label style="margin-bottom: 0.5rem">Name</label>
              <input
                required
                type="text"
                class="form-control"
                id="name"
                aria-describedby="nameHelp"
                placeholder="Enter name"
                ref="name"
                style="margin-bottom: 1rem !important"
              />
              <label style="margin-bottom: 0.5rem">Surname</label>
              <input
                required
                type="text"
                class="form-control"
                id="surname"
                aria-describedby="surnameHelp"
                placeholder="Enter surname"
                ref="surname"
                style="margin-bottom: 1rem !important"
              />
              <label style="margin-bottom: 0.5rem" for="email">Email</label>
              <input
                required
                type="email"
                class="form-control"
                id="email"
                aria-describedby="emailHelp"
                placeholder="Enter email"
                ref="email"
                style="margin-bottom: 1rem !important"
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
              @click="uploadProfessors()"
            >
              Create
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

 <script>
export default {
  props: ["auth_user"],

  methods: {
    uploadProfessors() {
      const data = {
        name: this.$refs.name.value,
        surname: this.$refs.surname.value,
        email: this.$refs.email.value,
      };

      axios
        .post("/professors", data)
        .then(() => location.reload())
        .catch((error) => {
          showNotification(error.response.data.message, "alert-danger");
        });
    },
  },
};
</script>

<style>
.professors-create-button {
  transition: 0.1s ease-out;
}
.professors-create-button:hover {
  stroke: #0056b3;
  transition: 0.1s ease-in;
}
</style>
