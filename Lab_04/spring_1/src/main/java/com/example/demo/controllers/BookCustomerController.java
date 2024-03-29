package com.example.demo.controllers;

import com.example.demo.dto.BookCustomerActiveDTO;
import com.example.demo.models.Author;
import com.example.demo.models.Book;
import com.example.demo.models.BookCustomer;
import com.example.demo.models.Customer;
import com.example.demo.repository.AuthorRepository;
import com.example.demo.repository.BookCustomerRepository;
import com.example.demo.repository.BookRepository;
import com.example.demo.repository.CustomerRepository;
import com.example.demo.request.BookRequest;
import com.example.demo.request.CustomerRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Date;
import java.util.List;
import java.util.Map;
import java.util.Optional;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/api/borrowings")
public class BookCustomerController {

    @Autowired
    private BookCustomerRepository bookCustomerRepository;

    @Autowired
    private BookRepository bookRepository;

    @Autowired
    private CustomerRepository customerRepository;

    @PostMapping("/borrow-book")
    public ResponseEntity<BookCustomer> borrowBook(@RequestBody Map<String, Long> request) {
        Long bookId = request.get("bookId");
        Long customerId = request.get("customerId");
        Optional<Book> optionalBook = bookRepository.findById(bookId);
        Optional<Customer> optionalCustomer = customerRepository.findById(customerId);

        if (!optionalBook.isPresent() || !optionalCustomer.isPresent()) {
            return ResponseEntity.badRequest().build();
        }

        Book book = optionalBook.get();
        Customer customer = optionalCustomer.get();

        BookCustomer bookCustomer = new BookCustomer();
        bookCustomer.setBook(book);
        bookCustomer.setCustomer(customer);
        bookCustomer.setStartDate(new Date());

        bookCustomerRepository.save(bookCustomer);

        return ResponseEntity.ok(bookCustomer);
    }

    @PostMapping("/hand-back-book")
    public ResponseEntity<BookCustomer> handBackBook(@RequestBody Map<String, Long> request){
        Long bookCustomerId = request.get("bookCustomerId");
        Optional<BookCustomer> optionalBookCustomer = bookCustomerRepository.findById(bookCustomerId);

        if (!optionalBookCustomer.isPresent()) {
            return ResponseEntity.badRequest().build();
        }

        BookCustomer bookCustomer = optionalBookCustomer.get();
        bookCustomer.setEndDate(new Date());

        bookCustomerRepository.save(bookCustomer);

        return ResponseEntity.ok(bookCustomer);
    }

    @GetMapping("/book-customers")
    public ResponseEntity<List<BookCustomer>> getAllBookCustomers() {
        List<BookCustomer> bookCustomers = bookCustomerRepository.findAll();
        return ResponseEntity.ok(bookCustomers);
    }

    @GetMapping("/book-customers-active")
    public ResponseEntity<List<BookCustomerActiveDTO>> getAllActiveBookCustomersActive() {
        List<BookCustomer> bookCustomers = bookCustomerRepository.findAll();
        List<BookCustomerActiveDTO> activeBookCustomers = bookCustomers.stream()
                .filter(bookCustomer -> bookCustomer.getEndDate() == null)
                .map(BookCustomerActiveDTO::new)
                .collect(Collectors.toList());
        return ResponseEntity.ok(activeBookCustomers);
    }

}
