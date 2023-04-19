<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Add Book</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <div class="form-floating mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" placeholder="Title" v-model="title" class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="year" class="form-label">Year:</label>
                <input type="number" id="year" placeholder="Year" v-model="year" class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="author">Author:</label>
                <br>
                <select id="author" v-model.number="authorId" required class="form-control">
                  <option v-for="author in authors" :key="author.id" :value="author.id">
                    {{ author.firstName }} {{ author.lastName }}
                  </option>
                </select>
              </div>
              <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
        // this.title = '';
        // this.year = null;
        // this.authorId = null;
        this.$router.push('/books/list');

      }
    }
  };
</script>
  