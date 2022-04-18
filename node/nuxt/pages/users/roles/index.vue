<script>
import { mapGetters, mapActions  } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await store.dispatch('roles-management/getRoles');
    },
    data() {
        return {
            labelsRoute: {
                title: 'roles.management.title',
                addItemButton: 'roles.management.add',
                modalCreateTitle:  'roles.management.add',
                modalEditTitle: 'roles.management.edit',
                modalDeleteText: 'roles.management.deleteText',
            }
        };
    },
    computed: {
        ...mapGetters('roles-management', {
            items: 'roles',
            headers: 'headers',
            itemFields: 'fields',
            defaultNewItem: 'defaultNew',
            actions: 'actions',
        }),
    },
    methods: {
        ...mapActions('roles-management', {
            addRole: 'addRole',
            editRole: 'editRole',
        }),
        editItem () {
            this.editRole( { role: this.editedItem, index: this.editedIndex} );
        },
        addItem () {
            this.addRole(this.editedItem);
        },
    }
};
</script>