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
        <v-list
            v-for="item in items"
            :key="item.name"
            dense
        >
            <template v-if="item.subItems">
                <v-list-group
                    :value="false"
                    :prepend-icon="item.icon"
                >
                    <template v-slot:activator>
                        <v-list-item-title>{{ $t(item.title) }}</v-list-item-title>
                    </template>
                    <v-list-item
                        v-for="subItem in item.subItems"
                        :key="subItem.name"
                        link
                    >
                        <v-list-item-content class="pl-14">
                            <v-list-item-title @click.stop="$router.push(subItem.link)">{{ $t(subItem.title) }}</v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-icon class="pr-8">
                            <v-icon>{{ subItem.icon }}</v-icon>
                        </v-list-item-icon>
                    </v-list-item>
                </v-list-group>
            </template>
            <template v-else>
                <v-list-item-group
                    color="primary"
                >
                    <v-list-item link>
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title @click.stop="$router.push(item.link)">{{ $t(item.title) }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </template>
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