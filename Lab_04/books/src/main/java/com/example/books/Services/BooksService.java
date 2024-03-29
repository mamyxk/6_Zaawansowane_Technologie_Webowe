package com.example.books.Services;

import com.example.books.Models.Book;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Collection;
import java.util.List;

@Service
public class BooksService implements IBookService{
    private static List<Book> booksRepo = new ArrayList<>();

    static {
        booksRepo.add(new Book(1, "Potop", "Henryk Sienkiewicz",936));
        booksRepo.add(new Book(2, "Wesele", "Stanisław Reymont",150));
        booksRepo.add(new Book(3, "Dziady", "Adam Mickiewicz",292));
    }

    @Override
    public Collection<Book> getBooks(){
        return booksRepo;
    }

    @Override
    public Book checkBook(int id){
        return booksRepo.stream()
                .filter(b -> b.getId() == id)
                .findAny()
                .orElse(null);
    }
}
