CREATE TABLE searchFarmerApplicants (
    farmerID INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    gender VARCHAR(50),
    email_address VARCHAR(200),
    current_address VARCHAR(200),
    age INT,
    ideal_timeslot VARCHAR(50),
    last_edited TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);
