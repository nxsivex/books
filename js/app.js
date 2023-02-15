var app = new Vue({
    el: "#app",
    data: {
        isbn: "",
        name: "",
        author: "",
        num_pages: "",
        description: "",
        books: []
    },
 
    methods: { 
        onSubmit() {
            if (this.isbn !== "" && this.name !== "" && this.author !== "" && this.num_pages !== "" && this.description !== "") {
                var fd = new FormData();
 
                fd.append("isbn", this.isbn);
                fd.append("name", this.name);
                fd.append("author", this.author);
                fd.append("num_pages", this.num_pages);
                fd.append("description", this.description);
 
                axios({
                    url: "insert.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Book Added", "default");
 
                            this.isbn = "";
                            this.name = "";
                            this.author = "";
                            this.num_pages = "";
                            this.description = "";

                            app.getBooks();
                        } else {
                            app.makeToast("Error", "Failed to add record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                alert("All field are required");
            }
        },
 
        getBooks() {
            axios({
                url: "books.php",
                method: "get"
            })
                .then((res) => {
                    this.books = res.data.rows;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        getApiResult() {
            axios({
                url: "https://openlibrary.org/books/" + this.isbn + ".json",
                method: "get",
                validateStatus: false
            })
                .then((res) => {
                    console.log(res.data);
                    this.name = res.data.title;
                    this.num_pages = res.data.number_of_pages;
                    this.description = res.data.first_sentence.value;
                   axios({
                    url: "https://openlibrary.org" + res.data.authors[0].key + ".json",
                    method: "get",
                    validateStatus: false
                })
                    .then((res) => {
                        this.author = res.data.personal_name;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
 
        deleteBook(isbn) {
            if (window.confirm("Delete this book?")) {
                var fd = new FormData();
 
                fd.append("isbn", isbn);
 
                axios({
                    url: "delete.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Book deleted successfully", "default");
                            app.getBooks();
                        } else {
                            app.makeToast("Error", "Failed to delete record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
 
        makeToast(vNodesTitle, vNodesMsg, variant) {
            this.$bvToast.toast([vNodesMsg], {
                title: [vNodesTitle],
                variant: variant,
                autoHideDelay: 1000,
                solid: true,
            });
        }
    },
 
    mounted: function () {
        this.getBooks();
    }
});