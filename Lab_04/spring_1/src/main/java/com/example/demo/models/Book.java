package com.example.demo.models;

import jakarta.persistence.*;

@Entity
public class Book {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String name;

    @Column(name="`year`", nullable=false)
    private int year;

    @Column(columnDefinition = "BOOLEAN DEFAULT FALSE", nullable = false)
    private boolean deleted;

    @ManyToOne
    private Author author;

    public Book() {
    }

    public Book(String name, int year, Author author) {
        this.name = name;
        this.year = year;
        this.author = author;
        this.deleted = false;
    }

    // Getters and setters

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getYear() {
        return year;
    }

    public void setYear(int year) {
        this.year = year;
    }

    public Author getAuthor() {
        return author;
    }

    public void setAuthor(Author author) {
        this.author = author;
    }

    public boolean getDeleted() {return deleted;}

    public void setDeleted(boolean deleted) {this.deleted = deleted;}

    // toString method

    @Override
    public String toString() {
        return "Book{" +
                "id=" + id +
                ", name='" + name + '\'' +
                ", year=" + year +
                ", author=" + author +
                '}';
    }
}