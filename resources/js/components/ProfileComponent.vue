<template>
  <div class="jumbotron">
    <h1 class="display-3">{{ auth_user.name }} {{ auth_user.surname }}</h1>
    <h3 class="lead">Welcome to your profile!</h3>
    <hr class="my-4" />
    <h5 v-if="auth_user.group != undefined">
      Group:
      <strong
        ><a :href="`/group/${auth_user.group.id}`">{{
          auth_user.group.name
        }}</a></strong
      >
    </h5>
    <h5 v-else>Group: <strong>[none]</strong></h5>
    <h5 v-if="auth_user.team != undefined">
      Team:
      <strong
        ><a :href="`/team/${auth_user.team.id}`">{{
          auth_user.team.name
        }}</a></strong
      >
    </h5>
    <h5 v-else>Team: <strong>[none]</strong></h5>
    <h5 v-if="auth_user.project != undefined">
      Project:
      <strong
        ><a
          :href="`/forum/t/${auth_user.project_id}-${auth_user.project.title}`"
          >{{ auth_user.project.title }}</a
        ></strong
      >
    </h5>
    <h5 v-else>Project: <strong>[none]</strong></h5>
    <hr class="my-4" />
    <h3>Ratings:</h3>
    <h5 v-if="average_grade != 0">
      Average Grade: <strong>{{ average_grade }}</strong>
    </h5>
    <h5 v-else><strong>No one has rated you yet</strong></h5>
    <h5
      v-bind:style="[
        rating.user.role_id == 1
          ? { 'background-color': 'palevioletred', 'border-radius': '5px' }
          : {},
        rating.user.role_id == 2
          ? { 'background-color': 'blanchedalmond', 'border-radius': '5px' }
          : {},
        rating.user.role_id == 3
          ? { 'background-color': 'ghostwhite', 'border-radius': '5px' }
          : {},
      ]"
      v-for="rating in ratings"
      :key="rating.id"
    >
      <h5 v-if="rating.user.role_id == 1">
        Admin
        <strong>{{ rating.user.name }} {{ rating.user.surname }}</strong> has
        rated you:
      </h5>
      <h5 v-else-if="rating.user.role_id == 2">
        Professor
        <strong>{{ rating.user.name }} {{ rating.user.surname }}</strong> has
        rated you:
      </h5>
      <h5 v-else>
        Student
        <strong>{{ rating.user.name }} {{ rating.user.surname }}</strong> has
        rated you:
      </h5>
      <h5>
        Grade: <strong>{{ rating.grade }}</strong>
      </h5>
      <h5>
        Comment: <strong>{{ rating.comment }}</strong>
      </h5>
    </h5>
    <hr class="my-4" />
    <h3>Liked Forum Threads:</h3>
    <h5 v-if="likes.length == 0">
      <strong>You have not liked any Forum threads yet</strong>
    </h5>
    <h5 v-for="like in likes" :key="like.id">
      Title:
      <strong
        ><a
          :href="`/forum/t/${like.forum_thread.id}-${like.forum_thread.title}`"
          >{{ like.forum_thread.title }}</a
        ></strong
      >
      | Likes:
      <strong> {{ like.forum_thread.likes }} </strong>
      | Category:
      <strong
        ><a
          :href="`/forum/c/${forum_categories_liked.id}-${forum_categories_liked.title}`"
          >{{ forum_categories_liked.title }}</a
        ></strong
      >
    </h5>
  </div>
</template>

<script>
export default {
  props: [
    "auth_user",
    "ratings",
    "average_grade",
    "likes",
    "forum_categories_liked",
  ],
};
</script>

<style>
</style>
