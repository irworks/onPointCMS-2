# Create the users table
CREATE TABLE IF NOT EXISTS users (
  userId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(250) NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL
);

# Create session tables
CREATE TABLE IF NOT EXISTS users_session (
  sessionId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  sessionStr VARCHAR(250) NOT NULL,
  ip VARCHAR(100) NOT NULL,
  logout TINYINT DEFAULT 0,
  idUser INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (idUser) REFERENCES users(userId)
);

# Create the table for the blog
CREATE TABLE IF NOT EXISTS blog(
  postId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  postConent TEXT NOT NULL,
  idUser INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (idUser) REFERENCES users(userId)
);

# Create the table for the html page content
CREATE TABLE IF NOT EXISTS page(
  pageId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  pageConent TEXT NOT NULL,
  idUser INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (idUser) REFERENCES users(userId)
);