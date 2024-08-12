<template>
    <nav class="bg-white ">

        <!-- Logo -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <router-link :to="{ name: 'login' }" active-class="border-b-2 border-indigo-400"
                class="btn btn-outline-primary">
                Login
            </router-link>
            <router-link :to="{ name: 'register' }" active-class="border-b-2 border-indigo-400"
                class="btn btn-primary ms-2 ms-lg-3">
                Register
            </router-link>
        </div>

    </nav>
</template>

<script>
export default {
    name: 'Navbar',
}
</script>
<style scoped>
/* Optional styles for the header */
</style>