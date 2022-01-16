<template>
  <div>
    <div class="jumbotron">
      <h3>Project</h3>
      <div v-if="auth_user.project != undefined">
        <p class="lead">
          You have a project
          <strong>{{ auth_user.project.title }}</strong> assigned
        </p>
        <p v-if="project_member_count == 0">
          There are no other members that have this project assigned.
        </p>
        <p v-else>
          There are
          <strong>{{ project_member_count }}</strong> other members that have
          this project assigned.
        </p>
        <a
          v-if="project_member_count == 0"
          disabled
          class="btn btn-primary"
          style="margin-bottom: 20px; width: 130px"
          role="button"
        >
          Project members
        </a>
        <a
          v-else
          class="btn btn-primary"
          data-bs-toggle="collapse"
          role="button"
          aria-expanded="false"
          aria-controls="collapseProjectMembers"
          id="collapseProjectMembersButton"
          href="#collapseProjectMembers"
          style="margin-bottom: 20px; width: 130px"
          @click="scrollToElementParent('projectMembersWrapper')"
        >
          Project members
        </a>
        <div class="collapse" id="collapseProjectMembers">
          <div class="card card-body" id="projectMembersWrapper">
            <table-component
              :students="project_members"
              ref="projectMembersTableRef"
              context="project"
              :auth_user="auth_user"
            ></table-component>
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
    "scrollToElementParent"
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
