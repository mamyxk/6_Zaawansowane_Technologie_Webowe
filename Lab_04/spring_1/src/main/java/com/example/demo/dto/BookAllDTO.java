package com.example.demo.dto;


import com.example.demo.models.Author;

public class BookAllDTO {
    private Long id;
    private String name;
    private int year;
    private Author author;

    public BookAllDTO() {
    }

    public BookAllDTO(Long id, String name, int year, Author author) {
        this.id = id;
        this.name = name;
        this.year = year;
        this.author = author;
    }

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

    public Author getAuthorName() {
        return author;
    }

    public void setAuthorName(Author author) {
        this.author = author;
    }
}

