<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
    <title>Books app</title>
</head>

<body class="bg-light">
    <div class="container" id="app" v-cloak>
        <div class="row">
            <div class="col-md-10">
                <h3>Assignment</h3>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex d-flex justify-content-between">
                            <div class="lead">BOOKS</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="" @submit.prevent="onSubmit" class="w-50">
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" v-model="isbn" @change="getApiResult()" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" v-model="name" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" v-model="author" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label for="num_pages">Number of pages</label>
                                <input type="number" v-model="num_pages" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea rows="3" v-model="description" class="form-control" style="resize:none;" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-outline-info mt-1 mb-3">Add Book</button>
                            </div>
                        </form>
                        <div class="text-muted lead text-center" v-if="!books.length">No book found</div>
                        <div class="table table-success table-striped" v-if="books.length">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Isbn</th>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Number of pages</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(book, i) in books" :key="book.isbn">
                                        <td>{{book.isbn}}</td>
                                        <td>{{book.name}}</td>
                                        <td>{{book.author}}</td>
                                        <td>{{book.num_pages}}</td>
                                        <td>{{book.description}}</td>
                                        <td>
                                            <a href="#" @click.prevent="deleteBook(book.isbn)" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <!-- BootstrapVue js -->
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>