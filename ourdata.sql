DROP TABLE IF EXISTS admin_det_reg;
CREATE TABLE admin_det_reg(
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(100),
    eMail VARCHAR(100),
    phoneNumber VARCHAR(12),
    passWord VARCHAR(15),
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions(
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_type VARCHAR(20),
    details TEXT(255),
    description TEXT(255),
    device_type VARCHAR(30),
    ip_address VARCHAR(40),
    payment_method VARCHAR(20),
    reference VARCHAR(60),
    status VARCHAR(20),
    currency VARCHAR(20),
    amount DECIMAL,
    user_id INT(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS cable_plans;
CREATE TABLE cable_plans(
    id INT AUTO_INCREMENT PRIMARY KEY,
    startimes_basic DECIMAL(11),
    startimes_nova DECIMAL(11),
    startimes_smart DECIMAL(11),
    startimes_super DECIMAL(11),
    gotv_jinja DECIMAL(11),
    gotv_jolli DECIMAL(11),
    gotv_max DECIMAL(11),
    gotv_smallie DECIMAL(11),
    dstv_compact DECIMAL(11),
    dstv_great_wall_standalone DECIMAL(11),
    dstv_padi DECIMAL(11),
    dstv_yanga DECIMAL(11),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS data_plans;
CREATE TABLE data_plans(
    id INT AUTO_INCREMENT PRIMARY KEY,
    airtel_five DECIMAL(11),
    airtel_four DECIMAL(11),
    airtel_half DECIMAL(11),
    airtel_one DECIMAL(11),
    airtel_three DECIMAL(11),
    airtel_two DECIMAL(11),
    glo_five DECIMAL(11),
    glo_four DECIMAL(11),
    glo_half DECIMAL(11),
    glo_one DECIMAL(11),
    glo_three DECIMAL(11),
    glo_two DECIMAL(11),
    mobile_five DECIMAL(11),
    mobile_four DECIMAL(11),
    mobile_half DECIMAL(11),
    mobile_one DECIMAL(11),
    mobile_three DECIMAL(11),
    mobile_two DECIMAL(11),
    mtnCG_five DECIMAL(11),
    mtnCG_four DECIMAL(11),
    mtnCG_half DECIMAL(11),
    mtnCG_one DECIMAL(11),
    mtnCG_three DECIMAL(11),
    mtnCG_two DECIMAL(11),
    mtn_five DECIMAL(11),
    mtn_four DECIMAL(11),
    mtn_half DECIMAL(11),
    mtn_one DECIMAL(11),
    mtn_three DECIMAL(11),
    mtn_two DECIMAL(11),

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS wallet_balance;
CREATE TABLE wallet_balance(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    current_balance DECIMAL(11),
    previous_balance DECIMAL(11),
    deduction_amount DECIMAL(11),
    funded_amount DECIMAL(11),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS data_users;
CREATE TABLE data_users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(100),
    pass_word VARCHAR(15),
    gender VARCHAR(10),
    e_mail VARCHAR(60),
    phone_no VARCHAR(12),
    country VARCHAR(40),
    pin VARCHAR(4),
    image VARCHAR(90),
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);