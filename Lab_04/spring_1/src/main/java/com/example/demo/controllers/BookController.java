package com.example.demo.controllers;

import com.example.demo.models.Author;
import com.example.demo.models.Book;
import com.example.demo.repository.AuthorRepository;
import com.example.demo.repository.BookRepository;
import com.example.demo.request.BookRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/books")
public class BookController {

    @Autowired
    private BookRepository bookRepository;

    @Autowired
    private AuthorRepository authorRepository;

    @PostMapping("/add-book")
    public ResponseEntity<Book> createBook(@RequestBody BookRequest bookRequest) {
        var optionalAuthor = authorRepository.findById(bookRequest.getAuthorId());
        if (optionalAuthor.isEmpty()) {
            return ResponseEntity.badRequest().build();
        }
        Author author = optionalAuthor.get();

        Book book = new Book();
        book.setName(bookRequest.getName());
        book.setYear(bookRequest.getYear());
        book.setAuthor(author);

        bookRepository.save(book);

        return ResponseEntity.ok(book);
    }

    @GetMapping("/get-all")
    public ResponseEntity<Object> getAllBooks() {
        List<Book> books = bookRepository.findAll();
        return ResponseEntity.ok(books);
    }
}