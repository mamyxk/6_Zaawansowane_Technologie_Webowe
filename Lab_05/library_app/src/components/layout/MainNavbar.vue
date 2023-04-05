<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">MyBooks</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="authorsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Authors
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="authorsDropdown">
                            <li><router-link class="dropdown-item" to="/authors/add-new">Create Author</router-link></li>
                            <li><router-link class="dropdown-item" to="/authors/list">Author List</router-link></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="booksDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="booksDropdown">
                            <li><router-link class="dropdown-item" to="/books/add-new">Create Book</router-link></li>
                            <li><router-link class="dropdown-item" to="/books/list">Book List</router-link></li>
                            <li><router-link class="dropdown-item" to="/books/delete">Delete Book</router-link></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Client
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><router-link class="dropdown-item" to="/customers/add-new">Create Client</router-link></li>
                            <li><router-link class="dropdown-item" to="/customers/list">Show Clients</router-link></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/borrowings/borrow-book">Borrow</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/borrowings/return-book">Return</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/borrowings/all-borrowings">Borrowings</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
  
<script>


export default {
    name: 'MainNavbar'
};

</script>
