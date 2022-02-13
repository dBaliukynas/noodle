import Vue from "vue";

export const courseSegmentsModule = {
    namespaced: true,
    state: () => ({
        courseSegments: [],
        closedSegmentIds: [],
        show: [],
        blurEnabled: null,
        studentViewEnabled: null,
        checkboxesEnabled: null,
        buttonsEnabled: true,
        pinnedSegmentsBooleans: [],
        hiddenSegmentsBooleans: [],
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
        INIT_PINNED_SEGMENTS_BOOLEANS(state, courseSegmentsLength) {
            state.pinnedSegmentsBooleans =
                Array(courseSegmentsLength).fill(false);
        },
        UPDATE_PINNED_SEGMENTS_BOOLEANS(state, payload) {
            Vue.set(state.pinnedSegmentsBooleans, payload.index, payload.value);
        },
        INIT_HIDDEN_SEGMENTS_BOOLEANS(state, courseSegmentsLength) {
            state.hiddenSegmentsBooleans =
                Array(courseSegmentsLength).fill(false);
        },
        UPDATE_HIDDEN_SEGMENTS_BOOLEANS(state, payload) {
            Vue.set(state.hiddenSegmentsBooleans, payload.index, payload.value);
        },
        INIT_CLOSED_SEGMENT_IDS(state, courseSegments) {
            state.closedSegmentIds = courseSegments.map(
                (courseSegment) => courseSegment.id
            );
        },
        UPDATE_CLOSED_SEGMENT_IDS(state, value) {
            Vue.set(state, "closedSegmentIds", value);
        },
    },
    actions: {
        initShow({ commit }, value) {
            commit("INIT_SHOW", value);
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
        initPinnedSegmentsBooleans({ commit }, value) {
            commit("INIT_PINNED_SEGMENTS_BOOLEANS", value);
        },
        updatePinnedSegmentsBooleans({ commit }, { index, value }) {
            commit({ type: "SET_PINNED_SEGMENTS_BOOLEANS", index, value });
        },
        initHiddenSegmentsBooleans({ commit }, value) {
            commit("INIT_HIDDEN_SEGMENTS_BOOLEANS", value);
        },
        updateHiddenSegmentsBooleans({ commit }, { index, value }) {
            commit({ type: "SET_HIDDEN_SEGMENTS_BOOLEANS", index, value });
        },
        initClosedSegmentIds({ commit }, value) {
            commit("INIT_CLOSED_SEGMENT_IDS", value);
        },
        updateClosedSegmentIds({ commit }, value) {
            commit("UPDATE_CLOSED_SEGMENT_IDS", value);
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
        closedSegmentIds: (state) => {
            return state.closedSegmentIds;
        },
        pinnedSegmentsBooleans: (state) => {
            return state.pinnedSegmentsBooleans;
        },
        hiddenSegmentsBooleans: (state) => {
            return state.hiddenSegmentsBooleans;
        },
    },
};
