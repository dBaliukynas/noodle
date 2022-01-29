export const courseSegmentsModule = {
    namespaced: true,
    state: () => ({
        count: 0,
    }),
    mutations: {
        increment(state) {
            state.count++;
        },
    },
};
