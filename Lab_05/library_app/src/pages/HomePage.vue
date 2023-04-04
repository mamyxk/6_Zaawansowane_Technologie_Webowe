<template>
    <div class="home-page">
        <MainNavbar />
        <h1>Welcome to my app!</h1>
        <p>This is the home page.</p>
    </div>
</template>
  
<script>
import MainNavbar from '../components/layout/MainNavbar.vue';
export default {
    name: 'HomePage',
    components: {
        MainNavbar
    }
};
</script>
  
<style scoped>
.home-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}
</style>
