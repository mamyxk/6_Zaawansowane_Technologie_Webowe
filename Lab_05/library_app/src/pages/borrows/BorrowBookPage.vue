<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Borrow Book</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-floating mb-3">
                <label for="customer">Select a customer:</label>
                <br>
                <select id="customer" v-model.number="customerId" required class="form-control">
                  <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                    {{ customer.lastName }}, {{ customer.firstName }} (ID: {{ customer.id }})
                  </option>
                </select>
              </div>
              <div class="form-floating mb-3">
                <label for="book">Select a book:</label>
                <br>
                <select id="book" v-model.number="bookId" required class="form-control">
                  <option v-for="book in books" :key="book.id" :value="book.id">
                    "{{ book.name }}" by {{ book.authorName.lastName }}, {{ book.authorName.firstName }} (ID: {{ book.id
                    }})
                  </option>
                </select>
              </div>
              <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Borrow</button>
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
      customerId: null,
      bookId: null,
      customers: [],
      books: []
    };
  },
  async created() {
    const responseC = await fetch('http://localhost:8080/api/customers/get-all');
    this.customers = await responseC.json();

    const responseB = await fetch('http://localhost:8080/api/books/get-all-avail')
    this.books = await responseB.json();
  },
  methods: {
    async handleSubmit() {
      const response = await fetch('http://localhost:8080/api/borrowings/borrow-book', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          bookId: parseInt(this.bookId),
          customerId: this.customerId
        })
      });
      const data = await response.json();
      console.log(data.body);
      if (response.ok) {
        this.$router.push('/');
      }
    }

  }
};
</script>
