<template>
    <nav class="navbar">
        <ul>
            <li><router-link to="/">Home</router-link></li>
        </ul>
    </nav>
</template>
  
<script>
export default {
    name: 'MainNavbar',
};
</script>
  
<style scoped>
.navbar {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 10px;
}

ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

li {
    margin-right: 20px;
}

li:last-child {
    margin-right: 0;
}
</style>
  