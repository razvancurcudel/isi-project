@echo off

:loop
php artisan sensors:modify
timeout /t 10 > nul
goto loop