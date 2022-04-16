<template>
    <div v-if="isLoading" class="loading-page">
        <p class="loading-text">
            <v-progress-circular
                indeterminate
                color="grey"
            />
        </p>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters('global', {
            isLoading: 'loading',
        }),
    }
};
</script>

<style scoped>
    .loading-page {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: rgba(255, 255, 255, 0.9);
        text-align: center;
        font-size: 30px;
        font-family: sans-serif;
    }
    .loading-text {
        position: relative!important;
        top: 50%!important;
    }
</style>