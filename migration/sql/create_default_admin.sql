-- Insert default admin user
INSERT INTO Customers (name, email, password, role, status)
VALUES 
    ('admin', 'abdullahifarukadam2001@gmail.com', '$2y$10$Z4w0e80BkhjkxFi7uQHQNyltWqNcPdpOX5g5fgdl0Ubo6p1EqMUtY', 'admin', 'active');
                         