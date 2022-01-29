import Vue from "vue";
import Vuex from "vuex";

import { courseSegmentsModule } from "./modules/CourseSegments";

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        courseSegmentsModule,
    },
});
