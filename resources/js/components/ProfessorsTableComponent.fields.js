import VuetableFieldCheckbox from "vuetable-2/src/components/VuetableFieldCheckbox.vue";

export const getFields = (checkboxVisible) => {
    return [
        {
            name: VuetableFieldCheckbox,
            titleClass: "extra-small",
            dataClass: "extra-small",
            visible: checkboxVisible,
        },
        {
            name: "name",
            sortField: "name",
            titleClass: "medium",
            dataClass: "medium",
        },
        {
            name: "surname",
            sortField: "surname",
            titleClass: "medium",
            dataClass: "medium",
        },
        {
            name: "email",
            sortField: "email",
            titleClass: "large",
            dataClass: "large",
        },
    ];
};
