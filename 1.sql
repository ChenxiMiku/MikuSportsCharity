-- 创建 User 表
CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,          -- 自增主键
    username VARCHAR(191) UNIQUE NOT NULL,           -- 唯一用户名
    password VARCHAR(255) NOT NULL,                  -- 密码
    email VARCHAR(191) NOT NULL,                     -- 邮箱
    role ENUM('admin', 'volunteer', 'visitor') NOT NULL,  -- 用户角色
    first_name VARCHAR(50),                          -- 名字
    last_name VARCHAR(50),                           -- 姓氏
    contact_number VARCHAR(20),                      -- 联系电话
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- 创建时间
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- 更新时间
);

-- 创建 CharityPost 表
CREATE TABLE CharityPost (
    post_id INT AUTO_INCREMENT PRIMARY KEY,          -- 自增主键
    title VARCHAR(255) NOT NULL,                     -- 项目标题
    description TEXT,                                -- 项目描述
    funding_goal DECIMAL(10,2),                      -- 目标资金
    current_funding DECIMAL(10,2) DEFAULT 0,         -- 当前资金
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- 创建时间
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- 更新时间
    user_id INT,                                     -- 外键，引用 User 表
    FOREIGN KEY (user_id) REFERENCES User(user_id)   -- 外键约束
);

-- 创建 Donation 表
CREATE TABLE Donation (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,      -- 自增主键
    amount DECIMAL(10,2) NOT NULL,                   -- 捐赠金额
    donor_name VARCHAR(255),                         -- 捐赠者姓名
    donor_email VARCHAR(255),                        -- 捐赠者邮箱
    anonymous BOOLEAN DEFAULT FALSE,                 -- 是否匿名
    donation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- 捐赠时间
    post_id INT,                                     -- 外键，引用 CharityPost 表
    FOREIGN KEY (post_id) REFERENCES CharityPost(post_id) -- 外键约束
);

-- 创建 VolunteerEvent 表
CREATE TABLE VolunteerEvent (
    event_id INT AUTO_INCREMENT PRIMARY KEY,         -- 自增主键
    event_name VARCHAR(255) NOT NULL,                -- 活动名称
    event_date DATE,                                 -- 活动日期
    event_location VARCHAR(255),                     -- 活动地点
    description TEXT,                                -- 活动描述
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- 创建时间
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- 更新时间
);

-- 创建 VolunteerSignUp 表
CREATE TABLE VolunteerSignUp (
    signup_id INT AUTO_INCREMENT PRIMARY KEY,        -- 自增主键
    user_id INT,                                     -- 外键，引用 User 表
    event_id INT,                                    -- 外键，引用 VolunteerEvent 表
    availability VARCHAR(255),                       -- 可用时间
    signup_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- 注册时间
    FOREIGN KEY (user_id) REFERENCES User(user_id),  -- 外键约束
    FOREIGN KEY (event_id) REFERENCES VolunteerEvent(event_id) -- 外键约束
);
