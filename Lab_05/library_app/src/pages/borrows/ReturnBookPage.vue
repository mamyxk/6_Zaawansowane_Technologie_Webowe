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
                  <select id="borrow" v-model.number="cusomerBookId" required class="form-control">
                    <option v-for="borrow in customersBooks" :key="borrow.id" :value="borrow.id">
                        {{customersBooks.customer.firstName}} {{customersBooks.customer.lastName}}
                        - {{customersBooks.book.author.firstName}} : "{{ customersBooks.book.name }}"
                    </option>
                  </select>
                </div>
              </div>
              <div class="form-floating mb-3">
                <label for="sd">Date of Return:</label>
                <input type="date" class="form-control" id="sd" placeholder="Enter date of return" v-model="dor">
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
      customerBookId: null,
      dor: null,
      customersBooks: []
    };
  },
  async created() {
    const response = await fetch('http://localhost:8080/api/borrowings/book-customers');
    this.customersBooks = await response.json();
  },
  methods: {
    async handleSubmit() {
      const response = await fetch('http://localhost:8080/api/borrowings/hand-back-book', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          endDate: this.dor
        })
      });
      const data = await response.json();
      console.log(data);
    }
  }
};
</script>