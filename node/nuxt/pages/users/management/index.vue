<script>
import { mapGetters } from 'vuex';
import TableItemManagementMixin from "@/mixins/TableItemManagementMixin.vue";
export default {
    mixins: [TableItemManagementMixin],
    async asyncData({ store }) {
        await store.dispatch('users-management/getUsers');
    },
    data() {
        return {
            labelsRoute: {
                title: 'users.management.title',
                addItemButton: 'users.management.addUser',
                modalCreateTitle:  'users.management.editUser',
                modalEditTitle: 'users.management.addUser',
                modalDeleteText: 'users.management.deleteText',
            }
        };
    },
    computed: {
        ...mapGetters('users-management', {
            items: 'users',
            headers: 'headers',
            itemFields: 'userFields',
            defaultNewItem: 'defaultNewUser',
        }),
    },
    methods: {
        itemToDelete (){
            return this.items[this.deleteIndex] ? this.items[this.deleteIndex]['email'] : '';
        },
        editItem () {
            console.log('Edit item ' + this.editedItem['email']);
        },
        addItem () {
            console.log('Add item ' + this.editedItem['email']);
        },
        deleteItem () {
            console.log('Delete item ' + this.items[this.deleteIndex]['email']);
        },
    }
};
</script>