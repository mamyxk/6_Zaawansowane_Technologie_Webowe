package com.example.demo.repository;

import com.example.demo.models.Book;
import com.example.demo.models.BookCustomer;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface BookCustomerRepository extends JpaRepository<BookCustomer, Long> {
    List<BookCustomer> findByBook(Book book);
}