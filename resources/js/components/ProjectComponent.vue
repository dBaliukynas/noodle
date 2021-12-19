<template>
  <div>
    <div class="jumbotron">
      <h1 class="display-4">{{ auth_user.name }} {{ auth_user.surname }}</h1>
      <div v-if="auth_user.project != undefined">
        <p class="lead">
          You have a project
          <strong>{{ auth_user.project.title }}</strong> assigned
        </p>
        <p v-if="project_member_count == 0">
          There are no other users that have this project assigned.
        </p>
        <p v-else>
          There are
          <strong>{{ project_member_count }}</strong> other users that have this
          project assigned.
        </p>
        <button
          disabled
          v-if="project_member_count == 0"
          type="button"
          class="btn btn-primary mt-4 disabled"
        >
          View Project Members
        </button>
        <button
          v-else
          type="button"
          class="btn btn-primary mt-4"
          data-toggle="modal"
          data-target="#ModalXl"
        >
          View Project Members
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
                  Students that have project
                  <strong>{{ auth_user.project.title }}</strong> assigned to
                  them.
                </h5>
                <div>
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
                  :students="project_members"
                  ref="projectMembersTableRef"
                  context="project"
                  :auth_user="auth_user"
                ></table-component>
              </div>
            </div>
          </div>
        </div>

        <hr class="my-4" />
        <p>Go to your assigned project's page</p>
        <p class="lead">
          <a
            class="btn btn-primary btn-lg"
            :href="`/forum/t/${auth_user.project_id}-${auth_user.project.title}`"
            role="button"
            >{{ auth_user.project.title }}</a
          >
        </p>
      </div>
      <div v-else>
        <p class="lead">You don't have any project assigned yet</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "auth_user",
    "forum_threads",
    "project_members",
    "project_member_count",
  ],
};
</script>
<style>
a {
  background: none;
  color: inherit;
  border: none;
  padding: 0;
  font: inherit;
  cursor: pointer;
  outline: inherit;
}
</style>
