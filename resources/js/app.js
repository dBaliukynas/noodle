/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require("vue").default;
window.events = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "file-upload-component",
    require("./components/FileUploadComponent.vue").default
);

Vue.component(
    "table-component",
    require("./components/TableComponent.vue").default
);

Vue.component(
    "notification-component",
    require("./components/NotificationComponent.vue").default
);

Vue.component(
    "groups-component",
    require("./components/GroupsComponent.vue").default
);
Vue.component(
    "teams-component",
    require("./components/TeamsComponent.vue").default
);
Vue.component(
    "professors-component",
    require("./components/ProfessorsComponent.vue").default
);
Vue.component(
    "group-component",
    require("./components/GroupComponent.vue").default
);
Vue.component(
    "team-component",
    require("./components/TeamComponent.vue").default
);
Vue.component(
    "profile-component",
    require("./components/ProfileComponent.vue").default
);
Vue.component(
    "project-component",
    require("./components/ProjectComponent.vue").default
);
Vue.component(
    "home-component",
    require("./components/HomeComponent.vue").default
);
Vue.component(
    "welcome-component",
    require("./components/WelcomeComponent.vue").default
);
Vue.component(
    "about-component",
    require("./components/AboutComponent.vue").default
);
Vue.component(
    "courses-component",
    require("./components/CoursesComponent.vue").default
);
Vue.component(
    "course-component",
    require("./components/CourseComponent.vue").default
);
Vue.component(
    "professors-create-component",
    require("./components/ProfessorsCreateComponent.vue").default
);
Vue.component(
    "students-create-component",
    require("./components/StudentsCreateComponent.vue").default
);
Vue.component("star-rating", require("vue-star-rating").default);

window.showNotification = function (message, type = "alert-primary") {
    window.events.$emit("showNotification", message, type);
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: "#main",
    extractStyles: true,
});
