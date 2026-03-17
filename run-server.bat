@echo off
cd /d "%~dp0"
echo Starting server at http://localhost:8000
echo Open in browser: http://localhost:8000
echo Press Ctrl+C to stop.
php -S localhost:8000 index.php
