package com.example.demo.controllers;

import com.example.demo.models.Author;
import com.example.demo.repository.AuthorRepository;
import com.example.demo.request.AuthorRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/authors")
public class AuthorController {

    @Autowired
    private AuthorRepository authorRepository;

    @PostMapping("/add-author")
    public ResponseEntity<Author> createAuthor(@RequestBody AuthorRequest authorRequest) {
        Author author = new Author(authorRequest.getFirstName(), authorRequest.getLastName());
        authorRepository.save(author);
        return ResponseEntity.ok(author);
    }

    @GetMapping("/get")
    public ResponseEntity<List<Author>> getAllAuthors() {
        List<Author> authors = authorRepository.findAll();
        return ResponseEntity.ok(authors);
    }

}