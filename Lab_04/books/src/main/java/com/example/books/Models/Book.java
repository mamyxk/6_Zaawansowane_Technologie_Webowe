package com.example.books.Models;

import java.util.List;

public class Book {
    private int id;
    private String title;
    private String author;
    int pages;

    static int next_instance_val = 0;
    int takenInstances;
    List<BookInstance> bInstances;

    public Book(int id, String title, String author, int pages){
        this.id = id;
        this.title = title;
        this.author = author;
        this.pages = pages;
        this.takenInstances = 0;
    }

    public boolean addIntance(){
        bInstances.add(new BookInstance(next_instance_val)) ;
        next_instance_val = next_instance_val + 1;
        return true;
    }



    public int getId() {
        return id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getAuthor() {
        return author;
    }

    public void setAuthor(String author) {
        this.author = author;
    }

    public int getPages() {
        return pages;
    }

    public void setPages(int pages) {
        this.pages = pages;
    }
}
