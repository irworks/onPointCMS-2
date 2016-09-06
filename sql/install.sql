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
  postTitle VARCHAR(500) NOT NULL,
  postContent TEXT NOT NULL,
  idUser INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (idUser) REFERENCES users(userId)
);

# Create the table for the html page content
CREATE TABLE IF NOT EXISTS page(
  pageId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  postTitle VARCHAR(500) NOT NULL,
  pageContent TEXT NOT NULL,
  pageURI VARCHAR(250) NOT NULL,
  idUser INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (idUser) REFERENCES users(userId)
);

# Create the table for the page => page connection (for child pages
CREATE TABLE IF NOT EXISTS page_child(
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  pageIdParent INT NOT NULL,
  pageIdChild INT NOT NULL,
  createDaTi DATETIME DEFAULT NOW(),
  updateDaTi DATETIME DEFAULT NULL,

  FOREIGN KEY (pageIdParent) REFERENCES page(pageId),
  FOREIGN KEY (pageIdChild) REFERENCES page(pageId)
);

# Create the table for the homepage-slider
CREATE TABLE IF NOT EXISTS slide (
  slideId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  source  VARCHAR(256) NOT NULL,
  target  VARCHAR(256) NOT NULL
);