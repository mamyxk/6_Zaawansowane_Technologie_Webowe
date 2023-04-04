package com.example.demo.repository;

import com.example.demo.models.BookCustomer;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface BookCustomerRepository extends JpaRepository<BookCustomer, Long> {
}