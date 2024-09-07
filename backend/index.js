const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const cors = require('cors');

const app = express();
const port = 8081;


const db = mysql.createConnection({
  host: 'newdb.clushmnnhufs.us-west-2.rds.amazonaws.com',
  user: 'admin',
  password: 'admin1234',
  database: 'survey'
});

db.connect(err => {
  if (err) {
    console.error('Error connecting to the database:', err);
    process.exit(1);
  }
  console.log('Connected to the database');
});


const createTableQuery = `
    CREATE TABLE IF NOT EXISTS users (
	          id INT AUTO_INCREMENT PRIMARY KEY,
	          name VARCHAR(255) NOT NULL,
	          age INT NOT NULL,
	          mobile VARCHAR(20) NOT NULL,
	          nationality VARCHAR(50) NOT NULL,
	          language VARCHAR(50) NOT NULL,
	          pin VARCHAR(10) NOT NULL
	        );
  `;

  db.query(createTableQuery, (err, results) => {
	      if (err) {
		            console.error('Error creating table:', err);
		            process.exit(1);
		          }
	      console.log('Table created or already exists');
	    });
});



app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

app.post('/submit', (req, res) => {
  const { name, age, mobile, nationality, language, pin } = req.body;
  const query = 'INSERT INTO users (name, age, mobile, nationality, language, pin) VALUES (?, ?, ?, ?, ?, ?)';
  const values = [name, age, mobile, nationality, language, pin];

  db.query(query, values, (err, results) => {
    if (err) {
      console.error('Error inserting data:', err);
      return res.status(500).send('Internal Server Error');
    }
    res.send('Data added successfully!');
  });
});

app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
