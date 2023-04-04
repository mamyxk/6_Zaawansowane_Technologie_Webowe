<template>
    <div class="add-book-form">
      <h2>Add Book</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" id="title" v-model="title" required>
        </div>
        <div class="form-group">
          <label for="year">Year:</label>
          <input type="number" id="year" v-model.number="year" required>
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <select id="author" v-model.number="authorId" required>
            <option value="">Select an author</option>
            <option v-for="author in authors" :key="author.id" :value="author.id">
              {{ author.lastName }}, {{ author.firstName }}
            </option>
          </select>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        title: '',
        year: null,
        authorId: null,
        authors: []
      };
    },
    async created() {
      const response = await fetch('http://localhost:8080/api/authors/get');
      this.authors = await response.json();
    },
    methods: {
      async submitForm() {
        const response = await fetch('http://localhost:8080/api/books/add-book', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            name: this.title,
            year: this.year,
            authorId: this.authorId
          })
        });
        const data = await response.json();
        console.log(data);
        this.title = '';
        this.year = null;
        this.authorId = null;
      }
    }
  };
  </script>
  