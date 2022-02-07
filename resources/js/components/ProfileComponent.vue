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
    <div
      class="list-group-item shadow-sm profile-rating-list-item"
      style="margin-bottom: 10px"
      v-for="rating in ratings"
      :key="rating.id"
    >
      <div class="row align-items-center text-center">
        <div class="col-sm text-md-start">
          <h5 class="card-title">
            <div v-if="rating.user != null">
              <h5
                class="profile-rating-dot-text-wrapper"
                v-if="rating.user.role_id == 1"
                style="display: flex; flex-direction: row; align-items: center"
              >
                <div
                  title="Admin"
                  class="profile-rating-dot"
                  style="background-color: palevioletred"
                ></div>
                <div>
                  Admin
                  <strong
                    >{{ rating.user.name }} {{ rating.user.surname }}</strong
                  >
                  has rated you:
                </div>
              </h5>
              <h5
                class="profile-rating-dot-text-wrapper"
                v-else-if="rating.user.role_id == 2"
                style="display: flex; flex-direction: row; align-items: center"
              >
                <div
                  title="Professor"
                  class="profile-rating-dot"
                  style="background-color: lightskyblue"
                ></div>
                <div>
                  Professor
                  <strong
                    >{{ rating.user.name }} {{ rating.user.surname }}</strong
                  >
                  has rated you:
                </div>
              </h5>
              <h5
                class="profile-rating-dot-text-wrapper"
                v-else
                style="display: flex; flex-direction: row; align-items: center"
              >
                <div
                  title="Student"
                  class="profile-rating-dot"
                  style="background-color: darkgray"
                ></div>
                <div>
                  Student
                  <strong
                    >{{ rating.user.name }} {{ rating.user.surname }}</strong
                  >
                  has rated you:
                </div>
              </h5>
              <h5 style="margin-left: 20px" class="profile-rating-grade-text">
                Grade: <strong>{{ rating.grade }}</strong>
              </h5>
              <h5 style="margin-left: 20px" class="profile-rating-comment">
                Comment: <strong>{{ rating.comment }}</strong>
              </h5>
            </div>
            <div v-else>
              <div>
                <strong>[deleted user]</strong>
                has rated you:
              </div>
              <h5 style="margin-left: 20px" class="profile-rating-grade-text">
                Grade: <strong>{{ rating.grade }}</strong>
              </h5>
              <h5 style="margin-left: 20px" class="profile-rating-comment">
                Comment: <strong>{{ rating.comment }}</strong>
              </h5>
            </div>
          </h5>
        </div>
      </div>
    </div>

    <hr class="my-4" />
    <h3>Liked Forum Threads:</h3>
    <h5 v-if="likes.length == 0">
      <strong>You have not liked any Forum threads yet</strong>
    </h5>
    <h5 v-else v-for="like in likes" :key="like.id">
      Title:
      <strong
        ><a
          :href="`/forum/t/${like.forum_thread.id}-${like.forum_thread.title}`"
          >{{ like.forum_thread.title }}</a
        ></strong
      >
      | Likes:
      <strong> {{ like.forum_thread.likes }} </strong>
      | Course:
      <strong
        ><a :href="`/course/${like.forum_thread.category.course.id}`">{{
          like.forum_thread.category.course.name
        }}</a></strong
      >
      | Category:
      <strong
        ><a
          :href="`/forum/c/${like.forum_thread.category_id}-${like.forum_thread.category_id}`"
          >{{ like.forum_thread.category.title }}</a
        ></strong
      >
    </h5>
  </div>
</template>

<script>
export default {
  props: ["auth_user", "ratings", "average_grade", "likes"],
};
</script>

<style>
.profile-rating-dot {
  min-height: 15px;
  min-width: 15px;
  margin-right: 5px;
  border-radius: 50%;
  display: inline-block;
}
@media only screen and (max-width: 800px) {
  .profile-rating-dot {
    margin-bottom: 5px;
  }
  .profile-rating-list-item {
    display: flex;
    justify-content: center;
  }
  .profile-rating-dot-text-wrapper {
    flex-direction: column !important;
  }
  .profile-rating-grade-text {
    margin-left: unset !important;
    text-align: center;
  }
  .profile-rating-comment {
    margin-left: unset !important;
    text-align: center;
  }
}
</style>
