<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Return Book</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <div class="form-floating mb-3">
                  <label for="borrow">Borrow:</label>
                  <br>
                  <select id="borrow" v-model.number="bookCustomerId" required class="form-control">
                    <option v-for="borrow in customersBooks" :key="borrow.id" :value="borrow.id">
                      {{ borrow.book.id }} - {{ borrow.book.name }} - {{ borrow.customer.lastName }} {{
                        borrow.customer.firstName }} - {{ borrow.customer.id }} - {{ borrow.startDate }}
                    </option>
                  </select>
                </div>
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
      bookCustomerId: null,
      customersBooks: []
    };
  },
  async created() {
    const response = await fetch('http://localhost:8080/api/borrowings/book-customers-active');
    this.customersBooks = await response.json();
  },
  methods: {
    async handleSubmit() {
      const selectedBook = this.customersBooks.find(book => book.id === this.bookCustomerId);
      const { id } = selectedBook;
      const response = await fetch('http://localhost:8080/api/borrowings/hand-back-book', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          bookCustomerId: id
        })
      });
      const data = await response.json();
      this.$router.push('/');
      console.log(data);
    }
  }
};
</script>
