<template>

    <div class="form-floating">
        <input type="email" class="form-control" id="email" placeholder="name@example.com"
            required autofocus autocomplete="username">
        <label for="email">Email address</label>
        <!-- Validation Errors -->
        <div class="text-red-600 mt-1 font-6">
            <div v-for="message in validationErrors?.email">
                {{ message }}
            </div>
        </div>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password"
            required>
        <label for="password">Password</label>
        <!-- Validation Errors -->
        <div class="text-red-600 mt-1 text-wrap">
            <div v-for="message in validationErrors?.password">
                {{ message }}
            </div>
        </div>
    </div>


    <div class="flex items-center justify-end mt-4">
        <button
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4"
            :class="{ 'opacity-25': processing }" :disabled="processing">
            Log in
  
          </button>
    </div>

</template>
<script>


export default {
    name: 'LoginFragment',
    data() {
        return {
           

        }
    },
    setup() {
       

        return {  }
    },
    components: {

    },
    methods: {

    }

}
</script>
<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

.b-example-divider {
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}

.form-signin {
    max-width: 330px;
    padding: 15px;
}

.form-signin .form-floating:focus-within {
    z-index: 2;
}

.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.font-6 {
    font-size: 12px;
}
</style>