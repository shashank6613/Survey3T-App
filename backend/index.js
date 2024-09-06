const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');

const app = express();
const port = 8081;


const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
});

db.connect(err => {
  if (err) {
    console.error('Error connecting to the database:', err);
    process.exit(1);
  }
  console.log('Connected to the database');
});

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
