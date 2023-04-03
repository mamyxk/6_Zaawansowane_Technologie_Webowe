package com.example.books.Services;

import com.example.books.Models.Book;

import java.util.Collection;

public interface IBookService {
    public abstract Collection<Book> getBooks();

    public abstract Book checkBook(int id);


}
