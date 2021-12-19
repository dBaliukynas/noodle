import VuetableFieldCheckbox from "vuetable-2/src/components/VuetableFieldCheckbox.vue";

export const getFields = (actionsVisible, checkboxVisible,) => {
    return [
        {
            name: VuetableFieldCheckbox,
            titleClass: "small",
            dataClass: "small",
            visible: checkboxVisible,
        },
        {
            name: "name",
            sortField: "name",
            titleClass: "medium",
            dataClass: "medium"
        },
        {
            name: "surname",
            sortField: "surname",
            titleClass: "medium",
            dataClass: "medium"
        },
        {
            name: "email",
            sortField: "email",
            titleClass: "large",
            dataClass: "large"
        },
        {
            name: "group.name",
            sortField: "group.name",
            title: "Group",
            titleClass: "medium",
            dataClass: "medium"
        },
        {
            name: "team.name",
            sortField: "team.name",
            title: "Team",
            titleClass: "medium",
            dataClass: "medium"
        },
        {
            name: "project.title",
            sortField: "project.title",
            title: "Project",
            titleClass: "medium",
            dataClass: "medium"
        },
        {
            name: "actions",
            titleClass: "medium",
            dataClass: "medium",
            visible: actionsVisible
        }
    ];
};
