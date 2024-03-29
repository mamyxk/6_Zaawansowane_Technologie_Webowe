package com.example.demo.controllers;

import com.example.demo.dto.BookAllDTO;
import com.example.demo.models.Author;
import com.example.demo.models.Book;
import com.example.demo.models.BookCustomer;
import com.example.demo.repository.AuthorRepository;
import com.example.demo.repository.BookCustomerRepository;
import com.example.demo.repository.BookRepository;
import com.example.demo.request.BookRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/api/books")
public class BookController {

    @Autowired
    private BookRepository bookRepository;

    @Autowired
    private AuthorRepository authorRepository;

    @Autowired
    private BookCustomerRepository bookCustomerRepository;

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

    @GetMapping("/get-all-full")
    public ResponseEntity<Object> getAllBooksFull() {
        List<Book> books = bookRepository.findAll();
        return ResponseEntity.ok(books);
    }

    @GetMapping("/get-all")
    public ResponseEntity<Object> getAllBooks() {
        List<Book> books = bookRepository.findAll();

        List<BookAllDTO> bookDtos = books.stream()
                .filter(book -> !book.getDeleted()) // exclude deleted books
                .map(book -> new BookAllDTO(
                        book.getId(),
                        book.getName(),
                        book.getYear(),
                        book.getAuthor()))
                .collect(Collectors.toList());

        return ResponseEntity.ok(bookDtos);
    }

    @GetMapping("/get-all-avail")
    public ResponseEntity<Object> getAllBooksAvail() {
        List<Book> books = bookRepository.findAll();

        List<BookAllDTO> bookDtos = books.stream()
                .filter(book -> !book.getDeleted()) // exclude deleted books
                .filter(book -> {
                    List<BookCustomer> bookCustomers = bookCustomerRepository.findByBook(book);
                    return bookCustomers.stream().noneMatch(bc -> bc.getStartDate() != null && bc.getEndDate() == null);
                })
                .map(book -> new BookAllDTO(
                        book.getId(),
                        book.getName(),
                        book.getYear(),
                        book.getAuthor()))
                .collect(Collectors.toList());


        return ResponseEntity.ok(bookDtos);
    }

    @DeleteMapping("/delete-book/{id}")
    public ResponseEntity<Object> deleteBook(@PathVariable Long id) {
        Optional<Book> optionalBook = bookRepository.findById(id);
        if (optionalBook.isPresent()) {
            Book book = optionalBook.get();
            book.setDeleted(true);
            bookRepository.save(book);
            return ResponseEntity.ok().build();
        } else {
            return ResponseEntity.notFound().build();
        }
    }

}