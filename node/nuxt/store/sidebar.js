export const state = () => ({
    visible: false,
    items: [
        { name: 'users', title: 'sidebar.users', icon: 'mdi-account-group', link: '/users',
            subItems: [
                { name: 'management', title: 'sidebar.management', icon: 'mdi-account-multiple', link: '/users/management',
                    rights:['users_management']
                },
                { name: 'roles', title: 'sidebar.roles', icon: 'mdi-format-list-text', link: '/users/roles',
                    rights:['rights_management']
                },
                { name: 'rights', title: 'sidebar.rights', icon: 'mdi-clipboard-text-outline', link: '/users/rights',
                    rights:['roles_management']
                }
            ],
            rights: ['users_management','rights_management','roles_management']
        },
        { name: 'rooms', title: 'sidebar.rooms', icon: 'mdi-home-city', link: '/rooms', rights:['rooms_management']},
    ],
});

export const getters = {
    visible: state => state.visible,
    items: state => state.items,
};

export const mutations = {
    TOGGLE_VISIBILITY(state) {
        state.visible = !state.visible;
    },
    SET_VISIBILITY(state, visibility) {
        state.visible = visibility;
    },
};

export const actions = {};