<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Add Author</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-floating mb-3">
                <label for="first-name" class="form-label">First Name:</label>
                <input type="text" id="first-name" placeholder="First Name" v-model="author.firstName" class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="last-name" class="form-label">Last Name:</label>
                <input type="text" id="last-name" placeholder="Last Name" v-model="author.lastName" class="form-control" />
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
  name: 'AuthorAddPage',
  data() {
    return {
      author: {
        firstName: '',
        lastName: '',
      },
    };
  },
  methods: {
    async handleSubmit() {
      try {
        const response = await fetch('http://localhost:8080/api/authors/add-author', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.author),
        });
        if (!response.ok) {
          throw new Error('Failed to add author');
        }
        // Handle successful response here
      } catch (error) {
        console.error(error);
        // Handle error here
      }
      this.$router.push('/authors/list');
    },
  },
};
</script>
