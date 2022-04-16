<template>
    <v-app>
        <v-main>
            <v-alert
                dense
                text
                type="error"
                border="left"
                class="mx-auto my-6 mt-16"
                max-width="500px"
            >
                404 Page doesn't exists
            </v-alert>
        </v-main>
    </v-app>
</template>
<script>
export default {
    layout() {
        return 'none';
    },
}
</script>