<script>
import { mapGetters } from 'vuex';
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
                addItemButton: 'roles.management.addUser',
                modalCreateTitle:  'roles.management.editUser',
                modalEditTitle: 'roles.management.addUser',
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
        }),
    },
    methods: {
        itemToDelete (){
            return this.items[this.deleteIndex] ? this.items[this.deleteIndex]['name'] : '';
        },
        editItem () {
            console.log('Edit item ' + this.editedItem['name']);
        },
        addItem () {
            console.log('Add item ' + this.editedItem['name']);
        },
        deleteItem () {
            console.log('Delete item ' + this.items[this.deleteIndex]['name']);
        },
    }
};
</script>