package com.example.demo.repository;

import com.example.demo.models.Author;
import com.example.demo.models.Book;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface AuthorRepository extends JpaRepository<Author, Long> {
//    Optional<Author> findById(Long id){
//
//    }
}