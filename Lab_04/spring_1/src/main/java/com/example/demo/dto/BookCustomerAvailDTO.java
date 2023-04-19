package com.example.demo.dto;

import com.example.demo.models.Book;
import com.example.demo.models.BookCustomer;
import com.example.demo.models.Customer;

import java.util.Date;

public class BookCustomerAvailDTO {
    private Long id;
    private Book book;
    private Customer customer;

    public BookCustomerAvailDTO() {}

    public BookCustomerAvailDTO(BookCustomer bookCustomer) {
        this.id = bookCustomer.getId();
        this.book = bookCustomer.getBook();
        this.customer = bookCustomer.getCustomer();
    }

    // Getters and setters

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Book getBook() {
        return book;
    }

    public void setBook(Book book) {
        this.book = book;
    }

    public Customer getCustomer() {
        return customer;
    }

    public void setCustomer(Customer customer) {
        this.customer = customer;
    }


    // toString method

    @Override
    public String toString() {
        return "BookCustomerActiveDTO{" +
                "id=" + id +
                ", book=" + book +
                ", customer=" + customer +
                '}';
    }
}

