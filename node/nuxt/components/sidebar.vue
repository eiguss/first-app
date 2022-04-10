<template>
    <v-navigation-drawer
        v-model="showSidebar"
        absolute
        temporary
    >
        <v-list-item>
            <v-row
                align="center"
                justify="center"
            >
                <v-col cols="3">
                    <v-avatar color="red">
                            <span class="white--text text-h5">{{userAcronym}}</span>
                    </v-avatar>
                </v-col>

                <v-col cols="9">
                    <v-list-item-content>
                        <v-list-item-title>{{userName}}</v-list-item-title>
                        <v-list-item-subtitle>{{userEmail}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-col>
            </v-row>
        </v-list-item>
        <v-divider></v-divider>
        <v-list dense>
            <v-list-item
                v-for="item in items"
                :key="item.title"
                link
            >
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>{{ $t(item.title) }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex';
export default {
    computed:{
        ...mapGetters('sidebar', {
            visible: 'visible',
            items: 'items',
        }),
        ...mapGetters('user', {
            userName: 'name',
            userEmail: 'email',
            userAcronym: 'acronym',
        }),
        showSidebar: {
            get () {
                return this.visible;
            },
            set (visibility) {
                this.setVisibility(visibility);
            }
        }
    },
    methods: {
        ...mapMutations('sidebar',{
            'setVisibility': 'SET_VISIBILITY'
        }),
    }
};
</script>