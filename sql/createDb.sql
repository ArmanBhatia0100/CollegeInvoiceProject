CREATE DATABASE invoice_app;
USE invoice_app;

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id VARCHAR(10) NOT NULL,
    due_date DATE NOT NULL,
    client_name VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('paid', 'pending', 'draft') NOT NULL
);

-- Insert sample data
INSERT INTO invoices (invoice_id, due_date, client_name, amount, status) VALUES
('RT3080', '2021-08-19', 'Jensen Huang', 1800.90, 'paid'),
('XM9141', '2021-09-20', 'Alex Grim', 556.00, 'pending'),
('RG0314', '2021-10-01', 'John Morrison', 14002.33, 'paid');