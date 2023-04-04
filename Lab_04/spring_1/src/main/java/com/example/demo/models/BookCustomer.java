package com.example.demo.models;

import jakarta.persistence.*;
import java.util.Date;

@Entity
public class BookCustomer {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    private Customer customer;

    @ManyToOne
    private Book book;

    @Column(nullable = false)
    private Date startDate;

    private Date endDate;

    public BookCustomer() {
    }

    public BookCustomer(Customer customer, Book book, Date startDate, Date endDate) {
        this.customer = customer;
        this.book = book;
        this.startDate = startDate;
        this.endDate = endDate;
    }

    // Getters and setters

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Customer getCustomer() {
        return customer;
    }

    public void setCustomer(Customer customer) {
        this.customer = customer;
    }

    public Book getBook() {
        return book;
    }

    public void setBook(Book book) {
        this.book = book;
    }

    public Date getStartDate() {
        return startDate;
    }

    public void setStartDate(Date startDate) {
        this.startDate = startDate;
    }

    public Date getEndDate() {
        return endDate;
    }

    public void setEndDate(Date endDate) {
        this.endDate = endDate;
    }

    // toString method

    @Override
    public String toString() {
        return "CustomerBook{" +
                "id=" + id +
                ", customer=" + customer +
                ", book=" + book +
                ", startDate=" + startDate +
                ", endDate=" + endDate +
                '}';
    }
}

