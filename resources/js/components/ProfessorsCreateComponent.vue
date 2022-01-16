<template>
  <div>
    <div v-if="auth_user.role_id == 1">
      <h4>Create a professor</h4>
      <button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#courseModal"
        style="
          background: none;
          color: inherit;
          border: none;
          padding: 0px;
          font: inherit;
          cursor: pointer;
          outline: inherit;
        "
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
  transition: 0.15s ease-out;
}
.professors-create-button:hover {
  stroke: #0056b3;
  transition: 0.15s ease-in;
}
</style>
