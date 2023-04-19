<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Add Customer</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-floating mb-3">
                <label for="first-name" class="form-label">First Name:</label>
                <input type="text" id="first-name" placeholder="First Name" v-model="customer.firstName"
                  class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="last-name" class="form-label">Last Name:</label>
                <input type="text" id="last-name" placeholder="Last Name" v-model="customer.lastName"
                  class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" placeholder="Email" v-model="customer.email" class="form-control" />
              </div>
              <div class="form-floating mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" id="dob" placeholder="Date of Birth" v-model="customer.dob" class="form-control" />
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
  name: 'CustomerAddPage',
  data() {
    return {
      customer: {
        firstName: '',
        lastName: '',
        email: '',
        dob: null
      },
    };
  },
  methods: {
    async handleSubmit() {

      const response = await fetch('http://localhost:8080/api/customers/add-customer', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.customer),
      });
      if (!response.ok) {
        throw new Error('Failed to add customer');
      }
      this.$router.push('/customers/list');
      // Handle successful response here

    },
  },
};
</script>