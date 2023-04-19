<template>
  <div>
    <h1 class="text-center mb-4">Author List</h1>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="author in authors" :key="author.id">
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
      await fetch('http://localhost:8080/api/authors/get')
        .then((response) => response.json())
        .then((data) => {
          this.authors = data;
        })
    }
  }
};
</script>