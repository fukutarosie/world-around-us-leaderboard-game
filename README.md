# The World Around Us - Quiz Game

A simple interactive quiz game built with PHP that tests your knowledge about Animals and Environment topics.

## Prerequisites

- **XAMPP** (or any PHP server like WAMP, MAMP)
- Web browser (Chrome, Firefox, Edge, etc.)

## Installation

1. Clone this repository into your XAMPP `htdocs` folder:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/fukutarosie/world-around-us-leaderboard-game.git
   ```

2. Or download and extract the files into:
   ```
   C:\xampp\htdocs\ISIT307_Assignment1\
   ```

## How to Run

1. Start **XAMPP Control Panel**
2. Start **Apache** server
3. Open your web browser and navigate to:
   ```
   http://localhost/ISIT307_Assignment1/index.php
   ```

## How to Use

1. **Enter Your Name**: Type your name in the input field
2. **Select a Topic**: Choose either "Animals" or "Environment" 
3. **Click "Start Game"**: This will take you to the quiz page
4. **Answer Questions**: Select your answers for each question
5. **Submit**: Click "Submit Answers" when done

## Features

- Session management to track player names
- Multiple quiz topics (Animals, Environment)
- Form validation
- Topic-based routing

## Project Structure

```
├── index.php              # Landing page with topic selection
├── animals_quiz.php       # Animals quiz page
├── environment_quiz.php   # Environment quiz page
├── index.html             # Static HTML page (if needed)
└── README.md              # This file
```

## Technologies Used

- **PHP** - Server-side scripting
- **HTML5** - Structure
- **CSS** - Styling (styles.css)
- **Sessions** - User state management

