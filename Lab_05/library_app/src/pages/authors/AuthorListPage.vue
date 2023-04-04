<template>
    <div>
      <h1>Author List</h1>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="author in authors" :key="author.id">
            <td>{{ author.id }}</td>
            <td>{{ author.firstName }}</td>
            <td>{{ author.lastName }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AuthorListPage',
    data() {
      return {
        authors: []
      }
    },
    mounted() {
      this.loadAuthors();
    },
    methods: {
      async loadAuthors() {
        try {
          const response = await fetch('http://localhost:8080/api/authors/get');
          const data = await response.json();
          this.authors = data;
        } catch (error) {
          console.error(error);
        }
      }
    }
  };
  </script>