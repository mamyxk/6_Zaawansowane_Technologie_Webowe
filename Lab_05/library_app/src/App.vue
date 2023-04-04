<template>
  <div>
    <MainNavbar />
    <router-view />
  </div>
</template>

<script>

import MainNavbar from './components/layout/MainNavbar.vue';
export default {
  name: 'App',
  components: {
    MainNavbar
  }
};
</script>

<style>
/* add any global styles you want here */
</style>
