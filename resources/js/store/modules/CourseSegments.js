import Vue from "vue";

export const courseSegmentsModule = {
    namespaced: true,
    state: () => ({
        courseSegments: [],
        show: [],
        blurEnabled: null,
        studentViewEnabled: null,
        checkboxesEnabled: null,
        buttonsEnabled: null,
    }),
    mutations: {
        INIT_SHOW(state, courseSegmentsLength) {
            state.show = Array(courseSegmentsLength).fill(false);
        },
        UPDATE_SHOW(state, payload) {
            Vue.set(state.show, payload.index, payload.value);
        },
        SET_COURSE_SEGMENTS(state, value) {
            state.courseSegments = value;
        },
        SET_SHOW(state, value) {
            Vue.set(state, "show", value);
        },
        SET_BLUR_ENABLED(state, value) {
            state.blurEnabled = value;
        },
        SET_STUDENT_VIEW_ENABLED(state, value) {
            state.studentViewEnabled = value;
        },
        SET_CHECKBOXES_ENABLED(state, value) {
            state.checkboxesEnabled = value;
        },
        SET_BUTTONS_ENABLED(state, value) {
            state.buttonsEnabled = value;
        },
    },
    actions: {
        initShow({ commit }, courseSegmentsLength) {
            commit("INIT_SHOW", courseSegmentsLength);
        },

        updateShow({ commit }, { index, value }) {
            commit({ type: "UPDATE_SHOW", index, value });
        },
        setCourseSegments({ commit }, value) {
            commit("SET_COURSE_SEGMENTS", value);
        },
        setShow({ commit }, value) {
            commit("SET_SHOW", value);
        },
        setBlurEnabled({ commit }, value) {
            commit("SET_BLUR_ENABLED", value);
        },
        setStudentViewEnabled({ commit }, value) {
            commit("SET_STUDENT_VIEW_ENABLED", value);
        },
        setCheckboxesEnabled({ commit }, value) {
            commit("SET_CHECKBOXES_ENABLED", value);
        },
        setButtonsEnabled({ commit }, value) {
            commit("SET_BUTTONS_ENABLED", value);
        },
    },
    getters: {
        courseSegments: (state) => {
            return state.courseSegments;
        },
        show: (state) => {
            return state.show;
        },
        blurEnabled: (state) => {
            return state.blurEnabled;
        },
        studentViewEnabled: (state) => {
            return state.studentViewEnabled;
        },
        checkboxesEnabled: (state) => {
            return state.checkboxesEnabled;
        },
        buttonsEnabled: (state) => {
            return state.buttonsEnabled;
        },
        closedSegmentsIds: (state) => {
            return state.courseSegments.map(
                (courseSegment) => courseSegment.id
            );
        },
    },
};
