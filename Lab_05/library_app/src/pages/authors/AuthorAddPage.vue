<template>
  <div>
    <h2>Add Author</h2>
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" v-model="author.firstName" class="form-control" />
      </div>
      <div class="form-group">
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" v-model="author.lastName" class="form-control" />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
    },
  },
};
</script>
